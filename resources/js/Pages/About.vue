<template>
    <BreezeAuthenticatedLayout>
        <div class="w-full overflow-hidden p-4">
            <div class="mb-10 ">
                <h1 class="font-black dark:text-white text-3xl montserrat font-bold">About</h1>

                <div class="w-full bg-white dark:bg-mirage-400 rounded-xl dark:text-white p-6 flex flex-col mt-6">
                    <div class="flex flex-wrap justify-start w-full">
                        <h1 class="montserrat dark:text-white text-base mb-5">TrapScan is a mobile web application designed by conservation volunteers to simplify their record keeping and reporting workload.</h1>

                        <h1 class="montserrat dark:text-white text-base">TrapScan is in it's first release so if you find any bugs, have ideas or any feedback, we would love to hear from you.
                        </h1>
                    </div>

                </div>


            </div>
        </div>

    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Link } from '@inertiajs/inertia-vue3'
export default {
    components:{
        Link,
        BreezeAuthenticatedLayout
    },
    name: "UserProjects",
    props:{
        projects:Object,
    },
    data() {
        return {
            usr_s:null
        }
    },
    mounted() {

    },
    methods: {

    }
}
</script>
<style scoped>

</style>
