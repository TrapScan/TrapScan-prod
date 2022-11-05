<template>
    <div class="w-full">
        <h3
            class="mb-3 text-xl font-semibold dark:text-white"
            v-if="!listOpen && title != ''"
        >
            {{ title }}
        </h3>
        <form
            v-on:focusin="() => (this.listOpen = true)"
        >
            <div class="relative">
                <div
                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"
                >
                    <svg
                        aria-hidden="true"
                        class="h-5 w-5 text-gray-500 dark:text-gray-400"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                        ></path>
                    </svg>
                </div>
                <input
                    v-model="query"
                    type="text"
                    id="default-search"
                    :class="inputClass"
                    placeholder="Search for Trap..."
                    required
                />
            </div>
            <div
                class="flex max-h-80 w-full w-full flex-col content-center overflow-scroll rounded-b-lg border-b-2 border-l-2 border-r-2 border-gray-300 bg-gray-200 py-4 text-gray-900 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:placeholder-gray-400"
                v-if="this.listOpen && this.filteredList.length > 0"
                v-on:focusout="() => (this.listOpen = false)"
            >
                <div v-for="(value, key, index) in projectSortedList">
                    <div>
                        <h1
                            class="ml-3 mt-3 text-xl font-semibold dark:text-white"
                        >
                            {{ key }}
                        </h1>
                        <div
                            class="item mx-2 my-1.5 cursor-pointer rounded-md bg-gray-100 px-5 py-3 hover:bg-gray-500 dark:bg-gray-700 dark:hover:bg-gray-500"
                            v-for="trap in value"
                            :key="trap.nz_trap_id"
                        >
                            <div
                                @click="onSelectPromptConfim(trap)"
                                class="flex w-full items-center justify-between"
                            >
                                <p>
                                    <b>{{ trap.name }}</b>
                                </p>
                                <small class="font-mono"
                                    >#{{ trap.nz_trap_id }}</small
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                v-if="this.listOpen && this.filteredList.length == 0"
                class="flex w-full w-full flex-col rounded-b-lg border-b-2 border-l-2 border-r-2 border-gray-300 bg-gray-100 py-4 pl-3 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
            >
                <p class="dark:text-white">No results</p>
            </div>
        </form>
    </div>
    <el-dialog
        v-model="dialogVisible"
        title="Confirm Trap Mapping"
        width="80%"
        :before-close="handleClose"
    >
        <div class="mb-2 text-lg">
            <p>QR</p>
            <p><b>{{ qrCode }}</b></p>
        </div>
        <div class="text-lg">
            <h3>Trap</h3>
            <p>Name: <b>{{ select.name }}</b></p>
            <p>NZ_ID: <b>{{ select.nz_trap_id }}</b></p>
        </div>
        <template #footer>
            <span class="dialog-footer">
                <el-button @click="dialogVisible = false">Cancel</el-button>
                <el-button type="primary" @click="doSubmit"
                    >Confirm</el-button
                >
            </span>
        </template>
    </el-dialog>
</template>

<script>
const baseClassInput =
    "focus:border-gray-300 focus:ring-0 focus:ring-offset-0 block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white";
const unselectedClassInput = "border rounded-lg";
const selectedClassInput = "border-t-2 border-l-2 border-r-2 rounded-t-lg";

import TsInput from "@/Components/Input.vue";
import { useForm } from "@inertiajs/inertia-vue3";
export default {
    components: {
        TsInput,
    },
    name: "QRRemap",
    props: {
        options: Array,
        qrCode: String,
        onSelect: Function,
        title: String,
    },
    data() {
        return {
            query: "",
            form: useForm({
                query: "",
            }),
            listOpen: false,
            prefilteredList: [],
            dialogVisible: false,
            select: null
        };
    },
    methods: {
        onSelectPromptConfim(trap) {
            this.listOpen = true
            this.dialogVisible = true
            this.select = trap
        },
        handleClose() {
            this.listOpen = false
            this.select = null
        },
        doSubmit() {
            this.dialogVisible = false
            this.onSelect(this.select)
        }
    },
    mounted() {
        this.prefilteredList = this.options.reduce((r, a) => {
            r[a.project.name] = r[a.project.name] || [];
            r[a.project.name].push(a);
            return r;
        }, Object.create(null));
    },
    computed: {
        searchTerm() {
            return this.query.toLowerCase();
        },
        projectSortedList() {
            return this.filteredList.reduce((r, a) => {
                r[a.project.name] = r[a.project.name] || [];
                r[a.project.name].push(a);
                return r;
            }, Object.create(null));
        },
        filteredList() {
            return this.options.filter((element) => {
                if (
                    element.nz_trap_id
                        .toString()
                        .toLowerCase()
                        .search(this.searchTerm) > -1 ||
                    element.name.toLowerCase().search(this.searchTerm) > -1
                ) {
                    return true;
                }
                return false;
            });
        },
        inputClass() {
            const classes = this.listOpen
                ? selectedClassInput
                : unselectedClassInput;
            return classes + " " + baseClassInput;
        },
    },
};
</script>

<style scoped>
input:focus {
    outline: none;
}
</style>
