<template>
    <AdminLayout>

        <div class="flex items-center justify-between mb-6 mx-8 mt-8">
            <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset">
            </search-filter>
        </div>
        <div class=" mx-8 bg-white dark:bg-mirage-500 rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <tr class="text-left font-bold">
                    <th class="pb-4 pt-6 px-6">Name</th>
                    <th class="pb-4 pt-6 px-6">Email</th>
                    <th class="pb-4 pt-6 px-6">Created</th>
                    <th class="pb-4 pt-6 px-6">Projects</th>
                    <th class="pb-4 pt-6 px-6 text-center">Actions</th>
                </tr>
                <tr v-for="(user, index) in users.data" :key="user.id" class="hover:bg-gray-100 dark:hover:bg-mirage-400 focus-within:bg-gray-100">
                    <td class="border-t">
                        <span class="flex items-center px-6 py-4 focus:text-indigo-500">
                            {{user.name}}
                        </span>
                    </td>
                    <td class="border-t">
                        <span class="flex items-center px-6 py-4" >

                            {{ user.email }}
                        </span>
                    </td>
                    <td class="border-t">
                        <span class="flex items-center px-6 py-4" >
                            {{ user.created_at}}
                        </span>
                    </td>
                    <td class="border-t">
                        <span class="flex items-center px-6 py-4" >
                            {{ user.projects_all.length}}
                        </span>
                    </td>
                    <td class="border-t">
                        <div class="flex w-full justify-center">
                            <button @click="open(index)" class="uppercase p-2 mr-1 rounded-full text-sm text-white font-bold bg-blue-500 hover:bg-blue-800">Edit Projects</button>

                        </div>
                    </td>
                </tr>
                <tr v-if="users.data.length === 0">
                    <td class="px-6 py-4 border-t" colspan="4">No found.</td>
                </tr>
            </table>
        </div>
        <pagination class="mt-6" :links="users.links" />

        <el-dialog  width="70%" v-model="dialogVisible" :title="'Edit '+projectData?.name ?? ''">
            <template #default>

                <table class="w-full whitespace-nowrap">
                    <tr class="text-left font-bold">
                        <th class="pb-4 pt-6 px-6">Project</th>
                        <th class="pb-4 pt-6 px-6">Coordinator</th>
                        <th class="pb-4 pt-6 px-6">Notify Catches</th>
                        <th class="pb-4 pt-6 px-6">Notify Inspections</th>
                        <th class="pb-4 pt-6 px-6">Notify Problems</th>
                        <th class="pb-4 pt-6 px-6 text-center">Actions</th>
                    </tr>
                    <tr v-for="pr in users.data[projectData].projects_all" :key="pr.id" class="hover:bg-gray-100 dark:hover:bg-mirage-400 focus-within:bg-gray-100">
                        <td class="border-t">
                                <span class="flex items-center px-6 py-4 focus:text-indigo-500">
                                    {{pr.name}}
                                </span>
                        </td>
                        <td class="border-t">
                                <span class="flex items-center px-6 py-4">
                                     <label :for="'checked-toggle-1-'+pr.id" class="inline-flex relative items-center cursor-pointer">
                                        <input @change="updateCoordinator(pr.id,users.data[projectData].id,'coordinator',pr.pivot.coordinator)" type="checkbox" v-model="pr.pivot.coordinator" :id="'checked-toggle-1-'+pr.id" class="sr-only peer" >
                                        <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                    </label>
                                </span>
                        </td>
                        <td class="border-t">
                             <span class="flex items-center px-6 py-4">
                                     <label :for="'checked-toggle-2-'+pr.id" class="inline-flex relative items-center cursor-pointer">
                                        <input @change="updateCoordinator(pr.id,users.data[projectData].id,'notify_catches',pr.pivot.notify_catches)" type="checkbox" v-model="pr.pivot.notify_catches" :id="'checked-toggle-2-'+pr.id" class="sr-only peer" >
                                        <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                    </label>
                                </span>
                        </td>
                        <td class="border-t">
                             <span class="flex items-center px-6 py-4">
                                     <label :for="'checked-toggle-3-'+pr.id" class="inline-flex relative items-center cursor-pointer">
                                        <input @change="updateCoordinator(pr.id,users.data[projectData].id,'notify_inspections',pr.pivot.notify_inspections)" type="checkbox" v-model="pr.pivot.notify_inspections" :id="'checked-toggle-3-'+pr.id" class="sr-only peer" >
                                        <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                    </label>
                                </span>
                        </td>
                        <td class="border-t">
                             <span class="flex items-center px-6 py-4">
                                     <label :for="'checked-toggle-4-'+pr.id" class="inline-flex relative items-center cursor-pointer">
                                        <input @change="updateCoordinator(pr.id,users.data[projectData].id,'notify_problems',pr.pivot.notify_problems)" type="checkbox" v-model="pr.pivot.notify_problems" :id="'checked-toggle-4-'+pr.id" class="sr-only peer" >
                                        <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                    </label>
                                </span>
                        </td>
                        <td class="border-t">
                            <div class="flex w-full justify-center">
                                <el-button @click="removeFromPr(pr.id,users.data[projectData].id)" type="danger">DELETE</el-button>
                            </div>
                        </td>
                    </tr>
                </table>

                <el-dialog
                    v-model="innerVisible"
                    width="60%"
                    title="Projects"
                    append-to-body
                >
                    <table class="w-full whitespace-nowrap">
                        <tr class="text-left font-bold">
                            <th class="pb-4 pt-6 px-6 w-10/12">Project Name</th>
                            <th class="pb-4 pt-6 px-6 text-center w-2/12">Actions</th>
                        </tr>
                        <tr v-for="pr in projects" :key="pr.id" class="hover:bg-gray-100 dark:hover:bg-mirage-400 focus-within:bg-gray-100">
                            <td class="border-t w-10/12">
                                <span class="flex items-center px-6 py-4 focus:text-indigo-500">
                                    {{pr.name}}
                                </span>
                            </td>
                            <td class="border-t w-2/12">
                                <div class="flex w-full justify-center">
                                    <el-button @click="addToPr(pr.id,users.data[projectData].id)" type="success" round>Add</el-button>
                                </div>
                            </td>
                        </tr>
                    </table>
                </el-dialog>
            </template>

            <template #footer>
                <div class="dialog-footer">
                    <el-button @click="dialogVisible = false">Cancel</el-button>
                    <el-button type="primary" @click="innerVisible = true"
                    >Add Projects</el-button
                    >
                </div>
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
    name: "Users",
    props: {
        filters: Object,
        users: Object,
        projects: Object,
    },
    components: {AdminLayout, SearchFilter, Pagination},
    data() {
        return {
            dialogVisible: false,
            innerVisible: false,
            form: {
                search: this.filters.search
            },
            updateUser: useForm({
                projectId:null,
                userId:null,
            }),
            updateUserSettings: useForm({
                projectId:null,
                userId:null,
                value:null,
                key:null,
            }),
            projectData:null
        }
    },
    watch: {
        form: {
            deep: true,
            handler: throttle(function () {
                this.$inertia.get(route('admin.users'), pickBy(this.form), { preserveState: true })
            }, 150),
        },
    },
    methods: {
        reset() {
            this.form = mapValues(this.form, () => null)
        },
        open(pr_data){
            this.projectData = pr_data;
            this.dialogVisible = true;
        },
        removeFromPr(pr_id, user_id){
            this.updateUser.userId = user_id
            this.updateUser.projectId = pr_id
            this.updateUser.post(route('admin.remove_from_pr'))
        },
        addToPr(pr_id, user_id){
            this.updateUser.userId = user_id
            this.updateUser.projectId = pr_id
            this.updateUser.post(route('admin.add_to_pr'))
        },
        updateCoordinator(pr_id, user_id, key, value){
            this.updateUserSettings.userId = user_id
            this.updateUserSettings.projectId = pr_id
            this.updateUserSettings.value = value
            this.updateUserSettings.key = key
            this.updateUserSettings.put(route('admin.update_user_pr_settingsr'))
        }
    }
}
</script>

<style scoped>

</style>
