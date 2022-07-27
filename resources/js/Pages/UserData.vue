<template>
    <BreezeAuthenticatedLayout>
        <div class="flex flex-wrap p-4">
            <div v-if="usr_s" class="w-full bg-gray-100 rounded-xl p-4 flex flex-col">
                <div class="flex justify-between w-full mb-3 border-b-2 pb-3">
                    <h1 class="montserrat text-3xl font-bold leading-normal">My Stats</h1>
                    <svg class="text-gray-500" width="35" height="35" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" color="#000"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path></svg>
                </div>

                <span class="ubuntu text-2xl">{{usr_s?.stats_per_day !== null ? "Today's catches" : 'No catches today'}}</span>
                <div class="flex justify-between" v-for="(value, index) in usr_s?.stats_per_day" :key="index">
                    <div class="6/12 font-bold ubuntu">{{index}}:</div>
                    <div class="6/12 ubuntu">{{value}}</div>
                </div>

                <span class="ubuntu text-2xl mb-2 mt-10  ubuntu">My total</span>
                <div class="flex justify-between mb-3">
                    <div class="6/12  font-bold ubuntu">Inspections:</div>
                    <div class="6/12 ubuntu">{{usr_s.inspections}}</div>
                </div>
                <div class="flex justify-between mb-3">
                    <div class="6/12 font-bold ubuntu">Catches:</div>
                    <div class="6/12 ubuntu">{{usr_s.catches}}</div>
                </div>
               </div>

            <div class="w-full bg-gray-100 rounded-xl p-4 flex flex-col mt-6 mb-20">
                <div class="flex justify-between w-full mb-3 border-b-2 pb-3">
                    <h1 class="montserrat text-3xl font-bold leading-normal">Global Stats</h1>
                    <svg class="text-gray-500" width="35" height="35" xmlns="http://www.w3.org/2000/svg"  fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="flex justify-between mb-3">
                    <div class="6/12  font-bold ubuntu">Global Inspections: :</div>
                    <div class="6/12   ubuntu">{{all_data.total_inspections}}</div>
                </div>
                <div class="flex justify-between mb-3">
                    <div class="6/12 font-bold ubuntu">Global Catches:</div>
                    <div class="6/12   ubuntu">{{all_data.total_catches}}</div>
                </div>
                <div class="flex justify-between mb-3">
                    <div class="6/12 font-bold ubuntu">Inspections Per User:</div>
                    <div class="6/12   ubuntu">{{all_data.average_inspections_per_user}}</div>
                </div>
                <div class="flex justify-between mb-3">
                    <div class="6/12 font-bold ubuntu">Catches Per User:</div>
                    <div class="6/12  ubuntu">{{all_data.average_catches_per_user}}</div>
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
    name: "UserData",
    props:{
        user_d:Object,
        all_data:Object,
    },
    data() {
        return {
            usr_s:null
        }
    },
    mounted() {
       console.log(this.user_d)
        this.usr_s = this.user_d.data;
    },
    methods: {

    }
}
</script>
<style scoped>

</style>
