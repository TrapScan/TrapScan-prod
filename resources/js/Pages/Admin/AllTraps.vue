<template>
    <AdminLayout>

        <div class="flex items-center justify-between mb-6 mx-8 mt-8">
            <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset">
            </search-filter>
        </div>
        <div class=" mx-8 bg-white dark:bg-mirage-500 rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <tr class="text-left font-bold">
                    <th class="pb-4 pt-6 px-6">Project</th>
                    <th class="pb-4 pt-6 px-6">Trap Name</th>
                    <th class="pb-4 pt-6 px-6">NZ ID</th>
                    <th class="pb-4 pt-6 px-6">QR</th>
                    <th class="pb-4 pt-6 px-6 text-center">Actions</th>
                </tr>
                <tr v-for="trap in traps.data" :key="trap.id" class="hover:bg-gray-100 dark:hover:bg-mirage-400 focus-within:bg-gray-100">
                    <td class="border-t">
                        <span class="flex items-center px-6 py-4 focus:text-indigo-500">
                            {{trap.project?.name}}
                        </span>
                    </td>
                    <td class="border-t">
                        <span class="flex items-center px-6 py-4" >

                            {{ trap.name }}
                        </span>
                    </td>
                    <td class="border-t">
                        <span class="flex items-center px-6 py-4" >
                            {{ trap.nz_trap_id}}
                        </span>
                    </td>
                    <td class="border-t">
                        <span class="flex items-center px-6 py-4" >
                            {{ trap.qr_id}}
                        </span>
                    </td>
                    <td class="border-t">
                        <div class="flex w-full justify-center">
                            <button @click="open(trap.nz_trap_id)" class="uppercase p-2 mr-1 rounded-full text-sm text-white font-bold bg-blue-500 hover:bg-blue-800">Print trap</button>
                            <button @click="open(trap.nz_trap_id)" class="uppercase p-2 rounded-full text-white text-sm font-bold bg-niagara-500 hover:bg-green-800">Remap trap</button>

                        </div>
                    </td>
                </tr>
                <tr v-if="traps.data.length === 0">
                    <td class="px-6 py-4 border-t" colspan="4">No found.</td>
                </tr>
            </table>
        </div>
        <pagination class="mt-6" :links="traps.links" />

        <el-dialog
            v-model="dialogVisible"
            title="Install QR for Trap"
            width="20%"
        >
            <div class="flex justify-center">
                <el-select v-model="newQR.qr_id" filterable placeholder="Select" class="w-full">
                    <el-option
                        v-for="item in qrs"
                        :key="item.qr_code"
                        :label="item.qr_code"
                        :value="item.qr_code"
                    />
                </el-select>
            </div>

            <template #footer>
      <span class="dialog-footer">
        <el-button @click="dialogVisible = false">Cancel</el-button>
        <el-button type="primary" @click="submit"
        >Confirm</el-button
        >
      </span>
            </template>
        </el-dialog>

    </AdminLayout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import SearchFilter from '@/Components/SearchFilter.vue'
import Pagination from '@/Components/Pagination.vue'
import {useForm} from "@inertiajs/inertia-vue3";
import pickBy from 'lodash/pickBy'
import { ElMessage } from 'element-plus'

export default {
    name: "AllTraps",
    props: {
        filters: Object,
        qrs: Object,
        traps: Object,
    },
    components: {AdminLayout, SearchFilter, Pagination},
    data() {
        return {
            dialogVisible: false,
            form: {
                search: this.filters.search
            },
            newQR: useForm({
                nz_id:null,
                qr_id:null
            })
        }
    },
    watch: {
        form: {
            deep: true,
            handler: throttle(function () {
                this.$inertia.get(route('admin.unmapped_traps'), pickBy(this.form), { preserveState: true })
            }, 150),
        },
    },
    methods: {
        reset() {
            this.form = mapValues(this.form, () => null)
        },
        submit() {
            this.newQR.post(route('admin.map_trap'),{
                preserveScroll: true,
                preserveState: true,
                onSuccess:() => {
                    ElMessage({
                        message: 'Congrats, trap mapped.',
                        type: 'success',
                    })
                    this.newQR.qr_id = null;
                    this.newQR.nz_id = null;
                    this.dialogVisible = false;
            }
            })
        },
        open(nz_id){
            this.newQR.nz_id = nz_id;
            this.dialogVisible = true;
        }
    }
}
</script>

<style scoped>

</style>
