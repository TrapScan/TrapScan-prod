<template>
    <BreezeAuthenticatedLayout>
        <div class="flex flex-wrap p-4">
            <div class="w-full bg-gray-100 dark:bg-mirage-400 dark:text-white rounded-xl p-4 flex flex-col">
                <div class="flex justify-between w-full mb-3 border-b-2 pb-3">
                    <h1 class="montserrat text-3xl font-bold leading-normal">MY PROJECTS</h1>
                    <svg class="dark:text-white text-gray-500" width="35" height="35" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" color="#000"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path></svg>
                </div>


                <div class="flex justify-between mb-3">

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
