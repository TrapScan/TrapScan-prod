<template>
    <AdminLayout>

       <div class="flex bg-white rounded-2xl shadow-xl justify-between w-auto dark:bg-mirage-500 p-4 m-4 items-center">
           <div class="flex w-full flex-wrap justify-start">
                <span class="w-full text-2xl dark:text-white">
                    Scrape Trap Data
                </span>
               <span class="w-full mt-3 dark:text-white">
                    This is a dangerous button.
                </span>
               <p class="w-full mt-3 dark:text-white">
                    This will trigger a scrape of TrapNZ data for all projects we have access to.
                    It will create any Traps it does not recognise
                    It will not update data for any Traps it does not recognise
                    Trapline and note data are missing, the CSV has this data for all traps
                </p>
               <p class="w-full mt-3 dark:text-white font-bold">
                   No data is modified. Traps are created
               </p>
               <pre v-if="$page.props.flash.message" class="alert w-full mt-3 dark:text-white font-bold">
                    <el-alert :title="$page.props.flash.message" type="success" show-icon />
               </pre>
           </div>
           <div class="flex w-full justify-end">
                <Link :href="route('admin.start_scrap')" class="bg-red-500 py-2 font-bold rounded-full px-4 hover:bg-red-800 text-white">
                    Scape TrapNZ Data
                </Link>
           </div>
       </div>

    </AdminLayout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Link } from '@inertiajs/inertia-vue3'

export default {
    name: "Index",
    components: {AdminLayout, Link}
}
</script>

<style scoped>

</style>
