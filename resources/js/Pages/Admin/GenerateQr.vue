<template>
    <AdminLayout>

        <div class="flex items-center justify-between mb-6 mx-8 mt-8">
            <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset">
            </search-filter>

            <form  @submit.prevent="submit">
                <div class="flex items-center">
                    <div class="flex w-full bg-white rounded shadow">
                        <input v-model="newQR.count" class="relative px-6 py-3 w-full rounded-r focus:shadow-outline" autocomplete="off" type="text" name="search" placeholder="Count qr"    />
                    </div>
                    <button class="ml-3 text-gray-500 dark:text-white hover:text-gray-700 focus:text-indigo-500 text-sm" type="submit" >Generate QR</button>
                </div>
            </form>
        </div>
        <div class=" mx-8 bg-white dark:bg-mirage-500 rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <tr class="text-left font-bold">
                    <th class="pb-4 pt-6 px-6">ID</th>
                    <th class="pb-4 pt-6 px-6">QR Code</th>
                    <th class="pb-4 pt-6 px-6">Created At</th>
                </tr>
                <tr v-for="qr in qrs.data" :key="qr.id" class="hover:bg-gray-100 dark:hover:bg-mirage-400 focus-within:bg-gray-100">
                    <td class="border-t">
                        <span class="flex items-center px-6 py-4 focus:text-indigo-500">
                            {{qr.id}}
                        </span>
                    </td>
                    <td class="border-t">
                        <span class="flex items-center px-6 py-4" >

                            {{ qr.qr_code }}
                        </span>
                    </td>
                    <td class="border-t">
                        <span class="flex items-center px-6 py-4" >
                            {{ qr.created_at}}
                        </span>
                    </td>
                </tr>
                <tr v-if="qrs.data.length === 0">
                    <td class="px-6 py-4 border-t" colspan="4">No users found.</td>
                </tr>
            </table>
        </div>
        <pagination class="mt-6" :links="qrs.links" />

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

export default {
    name: "GenerateQr",
    props: {
        filters: Object,
        qrs: Array,
    },
    components: {AdminLayout, SearchFilter, Pagination},
    data() {
        return {
            form: {
                search: this.filters.search
            },
            newQR: useForm({
                count:null
            })
        }
    },
    watch: {
        form: {
            deep: true,
            handler: throttle(function () {
                this.$inertia.get(route('admin.unmapped_codes'), pickBy(this.form), { preserveState: true })
            }, 150),
        },
    },
    methods: {
        reset() {
            this.form = mapValues(this.form, () => null)
        },
        submit() {
            this.newQR.post(route('admin.save'))
        }
    }
}
</script>

<style scoped>

</style>
