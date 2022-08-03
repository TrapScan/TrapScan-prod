<script>
import { ElMessage} from "element-plus";

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
        Echo.channel('messages')
            .listen('.newMessage', (message) => {console.log(message)
                this.messages.push(message);
                ElMessage({
                    showClose: true,
                    message: message,
                    type: 'success',
                })
            });
        Echo.private('App.Models.User.' + this.$page.props.auth.user.id ?? 0)
            .notification((notification) => {
                ElMessage({
                    showClose: true,
                    message: notification.message,
                    type: 'success',
                })
            });
    },
}
</script>

<template>
    <div class="min-h-screen h-full bg-mystic-500 dark:bg-mirage-500 dark:text-gray-300 ">
        <nav class="bg-niagara-500 min-h-[64px] h-auto shadow-2xl">
            <!-- Primary Navigation Menu -->
            <div class="max-w-lg mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 py-5">
                    <slot name="header"></slot>
                </div>
            </div>

        </nav>
        <!-- Page Content -->
        <main class="container mx-auto h-full max-w-lg mb-auto overflow-auto">
            <slot />
        </main>

    </div>
</template>

