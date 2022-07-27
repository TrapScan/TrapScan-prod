<template>
    <Show>
        <template #header>
            <div @click="back">

            </div>
            <div>
                <Link :href="route('scan')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 dark:text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </Link>
            </div>
        </template>
        <div class="py-16 flex justify-center w-full bg-limeade-500">
            <svg class="stroke-green-800" width="60" height="60" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13 24.5155C14.3073 25.4706 15.5461 26.4724 16.673 27.5889C17.297 28.2072 17.9924 28.7561 18.6398 29.3539C18.7594 29.4643 19.1408 29.9861 19.346 29.9998C19.4349 30.0057 19.4458 29.8702 19.4787 29.7982C19.7224 29.2651 19.622 29.4595 19.9858 28.745C21.5815 25.6107 23.3733 22.5504 25.3886 19.6031C26.8349 17.488 27.9316 15.5423 29.5 13.5C29.8643 13.0256 30.5 12 31 11.5"  stroke-width="3" stroke-linecap="round"/>
            </svg>
        </div>
        <div class="flex justify-center flex-col w-full mt-6">
            <h1 class="text-3xl font-bold text-black dark:text-white ubuntu text-center">Success</h1>
            <h4 class="font-bold text-black dark:text-white ubuntu text-center mt-2">Your inspection has been recorded</h4>
            <div class="mt-6 p-4">
                <p v-if="trap?.last_checked && trap?.last_checked_by" class="ubuntu mb-3">
                    This trap was last checked
                    <b>{{ trap.last_checked }}</b> by
                    <b>{{ trap.last_checked_by }}</b>
                </p>
                <p v-if="trap?.last_caught" class="ubuntu mb-3">
                    The trap last caught a
                    <b>{{ trap.last_caught }}</b>
                </p>
                <p class="ubuntu mb-3">Total catches on this before this: {{ trap.total_catches ?? 0 }}</p>
            </div>
        </div>
    </Show>
</template>

<script>
import Show from "@/Layouts/Show.vue";
import { Link } from '@inertiajs/inertia-vue3'

export default {
    components:{
        Show,
        Link
    },
    name: "InspectionDone",
    props:{
        trap_data:String,
        inspection: Object,
        trap: Object
    },
    data() {
        return {

        }
    },
    methods:{

    }
}
</script>

<style scoped>

</style>
