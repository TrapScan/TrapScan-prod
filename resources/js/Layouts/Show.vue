<script>
export default {
    components:{

    },
    data() {
        return {
            them:localStorage.getItem('color-theme')
        }
    },
    watch: {

    },
    mounted() {
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    },
}
</script>

<template>
    <div class="min-h-screen h-full bg-t_blue_gray-100  dark:bg-t_black-900 ">
        <nav class="bg-t_green-800 h-[44px] flex items-center justify-between flex-wrap w-full shadow-2xl px-4">
            <!-- Primary Navigation Menu -->
            <slot name="header"></slot>
        </nav>
        <slot name="last"/>
        <!-- Page Content -->
        <main class="h-full max-w-lg flex flex-wrap w-full mx-auto justify-center overflow-auto mt-[32px]">
            <slot />
        </main>

    </div>
</template>

