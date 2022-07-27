<template>
    <div v-if="showing" class="overflow-x-hidden overflow-y-auto  fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
        <div class="relative w-auto my-6 mx-auto max-w-3xl">
            <!--content-->
            <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white dark:bg-gray-600 dark:text-white outline-none focus:outline-none">
                <slot name="header"></slot>

                <!--body-->
                <div class="relative p-6 flex-auto">
                    <slot/>
                </div>
                <!--footer-->
                <slot name="footer"></slot>
            </div>
        </div>
    </div>
    <div v-if="showing" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
</template>

<script>
export default {
    props: {
        showing: {
            required: true,
            type: Boolean
        },
        title:String
    },
    name: "ModalWindow"
}
</script>

<style scoped>

</style>
