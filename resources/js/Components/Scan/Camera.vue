<template>
    <div class="mx-auto">
        <div class="relative h-screen w-full" v-if="error === null" >
            <qrcode-stream @init="onInit" @decode="onDecode" :torch="torch"/>
            <div class="absolute bottom-24 left-1/2 -translate-x-1/2">
                    <button @click="visible = true" type="button" class="bg-t_black-950 bg-opacity-60 w-full rounded-full px-[32px] py-[8px]">
                        <span class="uppercase montserrat text-[13px] font-bold text-white text-opacity-100">Enter ID instead</span>
                    </button>
            </div>
            <div class="absolute bottom-44 left-1/2 -translate-x-1/2">
                <button @click="torch=!torch" class="bg-t_black-950 bg-opacity-60 rounded-full p-4 px-5">
                    <svg width="17" height="23" viewBox="0 0 17 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.6767 1.66504H16.6767V0.665039L15.6767 0.665039V1.66504ZM15.5055 6.21808L16.2714 6.8611L16.2714 6.8611L15.5055 6.21808ZM12.9006 9.32054L13.6665 9.96356L13.6665 9.96356L12.9006 9.32054ZM4.69935 9.32054L5.4652 8.67752L4.69935 9.32054ZM2.09447 6.21808L2.86032 5.57506H2.86032L2.09447 6.21808ZM1.92334 1.66504L1.92334 0.665039L0.92334 0.665039L0.92334 1.66504L1.92334 1.66504ZM14.6767 1.66504V5.74813H16.6767V1.66504L14.6767 1.66504ZM14.7397 5.57506L12.1348 8.67752L13.6665 9.96356L16.2714 6.8611L14.7397 5.57506ZM11.7295 9.79049V20.6401H13.7295V9.79049H11.7295ZM11.9987 20.3709H5.60134L5.60134 22.3709H11.9987V20.3709ZM5.87048 20.6401L5.87048 9.79049H3.87048L3.87048 20.6401H5.87048ZM5.4652 8.67752L2.86032 5.57506L1.32862 6.8611L3.9335 9.96356L5.4652 8.67752ZM1.92334 2.66504L15.6767 2.66504V0.665039L1.92334 0.665039L1.92334 2.66504ZM2.92334 5.74812L2.92334 1.66504L0.92334 1.66504L0.92334 5.74812H2.92334ZM2.86032 5.57506C2.90103 5.62354 2.92334 5.68482 2.92334 5.74812H0.92334C0.92334 6.15523 1.06684 6.54931 1.32862 6.8611L2.86032 5.57506ZM5.87048 9.79049C5.87048 9.38338 5.72698 8.9893 5.4652 8.67752L3.9335 9.96356C3.89279 9.91508 3.87048 9.8538 3.87048 9.79049H5.87048ZM5.60134 20.3709C5.74998 20.3709 5.87048 20.4914 5.87048 20.6401H3.87048C3.87048 21.596 4.64541 22.3709 5.60134 22.3709L5.60134 20.3709ZM11.7295 20.6401C11.7295 20.4914 11.85 20.3709 11.9987 20.3709V22.3709C12.9546 22.3709 13.7295 21.596 13.7295 20.6401H11.7295ZM12.1348 8.67751C11.873 8.9893 11.7295 9.38338 11.7295 9.79049H13.7295C13.7295 9.8538 13.7072 9.91508 13.6665 9.96356L12.1348 8.67751ZM14.6767 5.74813C14.6767 5.68482 14.699 5.62354 14.7397 5.57506L16.2714 6.8611C16.5332 6.54931 16.6767 6.15523 16.6767 5.74813H14.6767Z" fill="white"/>
                        <path d="M7.59424 9.20605H10.0041V12.1751C10.0041 12.377 9.84053 12.5406 9.63871 12.5406H7.95967C7.75785 12.5406 7.59424 12.377 7.59424 12.1751V9.20605Z" fill="white"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="flex w-full mb-3 justify-center flex-wrap text-center" v-else>
            <div class="w-full px-10 mt-5 dark:text-white text-black font-fira text-[20px]">
              {{error}}
            </div>
            <div class="mt-20">
                <no-camera/>
            </div>
            <div class="w-8/12 mt-20">
                <tertiary @click="visible = true">Enter ID instead</tertiary>
            </div>
        </div>

        <modal-window :showing="visible">
            <template #header>
                <div class="flex items-start justify-between p-5 border-b border-solid border-slate-200 rounded-t">
                    <h3 class="text-xl font-semibold">
                        Enter QR ID
                    </h3>
                </div>
            </template>
            <h1 class=" mb-3">The QR ID is located in the top left of the QR Card</h1>
            <form @submit.prevent="submit_form">
                <div class="relative flex w-full flex-wrap items-stretch mb-8">
                              <span class="z-10 h-full leading-snug font-normal absolute text-center text-slate-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
                              <svg width="28" height="28" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" color="#000"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                              </span>
                    <input v-model="form.qr_id" type="text" class="px-3 py-3 placeholder-slate-300 text-slate-600 relative bg-white bg-white rounded text-lg border-0 shadow outline-none focus:outline-none focus:ring w-full pl-10"/>
                </div>
                <div class="flex">
                    <div class="flex w-5/12 mx-auto">
                        <button  :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit" class="flex mt-2 items-center font-bold justify-center focus:outline-none text-white text-sm sm:text-base bg-bay-of-many-500 hover:bg-bay-of-many-600 rounded-full py-2 w-full transition duration-150 ease-in">
                            <span class="mr-2 uppercase">Check Code</span>
                        </button>
                    </div>
                    <div class="flex w-5/12 mx-auto">
                        <button  @click="visible = false" class="flex mt-2 items-center justify-center focus:outline-none text-bay-of-many-500 dark:text-mystic-100 dark:border-mystic-100 font-bold text-sm sm:text-base border-2 border-bay-of-many-500 hover:bg-bay-of-many-500 hover:text-white rounded-full py-2 w-full transition duration-150 ease-in">
                            <span class="mr-2 uppercase">Cancel</span>
                        </button>
                    </div>
                </div>
            </form>
        </modal-window>

    </div>
</template>

<script>
import {useForm} from "@inertiajs/inertia-vue3";
import ModalWindow from "@/Components/ModalWindow.vue";
import { QrcodeStream } from 'vue3-qrcode-reader';
import NoCamera from "@/Components/SVG/NoCamera.vue";
import Tertiary from "@/UI/Buttons/Tertiary.vue";

export default {
    components:{
        ModalWindow,
        QrcodeStream,
        NoCamera,
        Tertiary
    },
    name: "Camera",
    data () {
        return {
            loading: false,
            error: null,
            decodedString: '',
            torch: false,
            read:true,
            visible:false,
            form:useForm({
                qr_id:null
            })
        }
    },
    methods: {
        submit_form(){
            this.$inertia.get(route('inspection.index') + '/'+this.form.qr_id)
        },
        async onInit( promise ) {
            this.loading = true
            try {
                const { capabilities } = await promise
                // successfully initialized
            } catch (error) {
                if (error.name === 'NotAllowedError') {
                    this.error = "Give TrapScan access to your phone’s camera so you can scan"
                } else if (error.name === 'NotFoundError') {
                    this.error = "no suitable camera device installed"
                } else if (error.name === 'NotSupportedError') {
                    this.error = "page is not served over HTTPS (or localhost)"
                } else if (error.name === 'NotReadableError') {
                    this.error = "maybe camera is already in use"
                } else if (error.name === 'OverconstrainedError') {
                    this.error = " did you requested the front camera although there is none?"
                } else if (error.name === 'StreamApiNotSupportedError') {
                    this.error = "browser seems to be lacking features"
                }
            } finally {
                // hide loading indicator
                this.loading = false

            }
        },
        onDecode(decodedString) {
            this.form.qr_id = decodedString;
            this.submit_form()
        }
    }
}
</script>

<style>
.qrcode-stream-camera{
}
</style>
