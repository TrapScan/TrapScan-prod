<template>
    <Show>
        <template #header>
            <div>
                <Link :href="route('scan')">
                    <svg  xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </Link>
            </div>

            <div>
                <Link :href="route('scan')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </Link>
            </div>
        </template>

        <index v-if="step === 1" :list="projects"/>

    </Show>
</template>

<script>
import Show from '@/Layouts/Show.vue';
import { Link } from '@inertiajs/inertia-vue3'
import Index from "@/Components/Projects/Index.vue";
export default {
    components:{
        Index,
        Link,
        Show
    },
    name: "UserProjects",
    props:{
        projects:Object,
    },
    data() {
        return {
            step:1
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
