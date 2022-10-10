<template>
  <div class="w-full">
    <h3 class="text-xl dark:text-white mb-3 font-semibold" v-if="!listOpen && title != ''">
        {{ title }}
    </h3>
    <form v-on:focusin="() => this.listOpen = true"
                v-on:focusout="() => this.listOpen = false">
        <div class="relative">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input
                v-model="query"
                type="text" id="default-search"
                :class="inputClass"
                placeholder="Search for Trap..." required>
        </div>
        <div
            class="flex flex-col w-full max-h-80 overflow-scroll content-center py-4 w-full text-gray-900 bg-gray-100 rounded-b-lg border-b-2 border-l-2 border-r-2 border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
            v-if="this.listOpen && this.filteredList.length > 0">
            <div @click="onSelect(project)" class="item px-5 py-3 mx-2 my-1.5 bg-gray-700 rounded-md cursor-pointer hover:bg-gray-500 dark:hover:bg-gray-500" v-for="project in filteredList" :key="project.nz_trap_id">
                <div class="flex justify-between items-center w-full">
                    <p><b>{{ project.name }}</b></p>
                    <small class="font-mono">#{{ project.nz_trap_id }}</small>
                </div>
            </div>
        </div>
        <div v-if="this.listOpen && this.filteredList.length == 0" class="flex flex-col w-full pl-3 py-4 w-full text-gray-900 bg-gray-100 rounded-b-lg border-b-2 border-l-2 border-r-2 border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
            <p class="dark:text-white">No results</p>
        </div>
    </form>
  </div>
</template>

<script>
const baseClassInput = 'focus:ring-0 focus:ring-offset-0 block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white'
const unselectedClassInput = 'border rounded-lg'
const selectedClassInput = 'border-t-2 border-l-2 border-r-2 rounded-t-lg'

import TsInput from "@/Components/Input.vue";
import { useForm } from "@inertiajs/inertia-vue3";
export default {
  components: {
    TsInput,
  },
  name: "Searchable",
  props: {
    options: Array,
    onSelect: Function,
    title: String
  },
  data() {
    return {
      query: "",
      form: useForm({
        query: "",
      }),
      listOpen: false,
    };
  },
  methods: {
    filterList(query) {

    },
  },
  computed: {
    searchTerm() {
        return this.query.toLowerCase()
    },
    filteredList() {
        return this.options.filter(element => {
            if(element.nz_trap_id.toString().toLowerCase().search(this.searchTerm) > -1 || element.name.toLowerCase().search(this.searchTerm) > -1) {
                return true
            }
            return false
        })
    },
    inputClass() {
        const classes = this.listOpen ? selectedClassInput : unselectedClassInput
        return classes + ' ' + baseClassInput
    }
  },
};
</script>

<style scoped>
input:focus {
  outline: none;
}
</style>
