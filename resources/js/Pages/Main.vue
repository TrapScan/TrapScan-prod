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
                <div class="relative flex flex-col min-w-0 break-words w-full mb-6 ">
                    <div class="flex-auto">
                        <div class="tab-content tab-space h-screen">
                            <div v-bind:class="{'hidden': openTab !== 1, 'block': openTab === 1}">
                                <div v-if="$page.props.flash.message" class="alert mb-3">
                                       <el-alert :title="$page.props.flash.message" effect="dark"  type="error" />
                                </div>
                                <Camera/>
                            </div>
                            <div v-bind:class="{'hidden': openTab !== 2, 'block': openTab === 2}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </BreezeAuthenticatedLayout>

</template>

