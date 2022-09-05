<template>
    <BreezeAuthenticatedLayout>
        <index :list="projects" :projects_all="projects_all"/>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Link } from '@inertiajs/inertia-vue3'
import Index from "@/Components/Projects/Index.vue";
export default {
    components:{
        Index,
        Link,
        BreezeAuthenticatedLayout
    },
    name: "UserProjects",
    props:{
        projects:Object,
        projects_all:Object,
    },
    data() {
        return {
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
