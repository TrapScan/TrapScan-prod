<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Link } from '@inertiajs/inertia-vue3'
import Camera from "@/Components/Scan/Camera.vue";
import Location from "@/Components/Scan/Location.vue";

export default {
    components:{
        Location,
        Camera,
        Link,
        BreezeAuthenticatedLayout
    },
    data() {
        return {
            openTab:1
        }
    },
    watch: {

    },
    mounted() {

    },
    methods: {
        toggleTabs: function(tabNumber){
            this.openTab = tabNumber
        }
    }
}
</script>

<template>
    <BreezeAuthenticatedLayout>
        <div class="flex flex-wrap">
            <div class="w-full">
<!--                <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row px-10">-->
<!--                    <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">-->
<!--                        <a class="text-xs font-bold uppercase px-5 py-3  border-b-2 block leading-normal " v-on:click="toggleTabs(1)" v-bind:class="{'dark:text-white text-gray-900 font-bold hover:text-niagara-500  border-gray-400': openTab !== 1, 'text-niagara-500  dark:text-white border-niagara-500 ': openTab === 1}">-->
<!--                            QR Scanner-->
<!--                        </a>-->
<!--                    </li>-->
<!--                    <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">-->
<!--                        <a class="text-xs font-bold uppercase px-5 py-3 border-b-2  block leading-normal" v-on:click="toggleTabs(2)" v-bind:class="{'dark:text-white text-gray-900 font-bold hover:text-niagara-500  border-gray-400': openTab !== 2, 'text-niagara-500  dark:text-white border-niagara-500 ': openTab === 2}">-->
<!--                            Nearby Traps-->
<!--                        </a>-->
<!--                    </li>-->
<!--                </ul>-->
                <div class="relative flex flex-col min-w-0 break-words w-full mb-6 ">
                    <div class="px-4 py-5 flex-auto">
                        <div class="tab-content tab-space">
                            <div v-bind:class="{'hidden': openTab !== 1, 'block': openTab === 1}">
                                <div v-if="$page.props.flash.message" class="alert">
                                       <el-alert :title="$page.props.flash.message" effect="dark"  type="error" />
                                </div>
                                <Camera/>
                            </div>
                            <div v-bind:class="{'hidden': openTab !== 2, 'block': openTab === 2}">
<!--                                <Location/>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </BreezeAuthenticatedLayout>

</template>

