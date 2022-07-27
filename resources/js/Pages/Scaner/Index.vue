<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
</script>

<template>
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="container mx-auto max-w-lg bg-spring-wood-500">

            </div>
        </div>
    </BreezeAuthenticatedLayout>

</template>

