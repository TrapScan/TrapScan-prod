<template>
    <div class="mx-auto px-14">
        <div class="flex">
            <div class="flex w-5/12 mx-auto">
                <button @click="visible = true" type="submit" class="flex mt-5 items-center font-bold justify-center focus:outline-none text-white text-sm sm:text-base bg-bay-of-many-500 hover:bg-bay-of-many-600 rounded-2xl py-2 w-full transition duration-150 ease-in">
                    <span class="mr-2 uppercase">Manual Entry</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import {useForm} from "@inertiajs/inertia-vue3";
import ModalWindow from "@/Components/ModalWindow.vue";

export default {
    components:{
        ModalWindow,
    },
    name: "Location",
    data () {
        return {
            visible:false,
            form:useForm({
                qr_id:null
            })
        }
    },
    methods: {
        onDecode(url) {
            console.log(url)
        },
    }
}
</script>

<style scoped>

</style>
