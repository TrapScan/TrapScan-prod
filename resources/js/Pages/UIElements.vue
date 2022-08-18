<template>
    <div class="dark:bg-dark_app_bg h-screen">
        <div class="w-full flex flex-wrap space-x-3 m-3">
            <div class="w-full md:w-2/12 bg-brand_green">
                <button @click="toggleDarkMode" id="theme-toggle" type="button" class="text-gray-500 p-2.5">
                    <svg v-if="them !== 'dark'" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.0008 6.38306C10.2494 6.38306 6.38379 10.2487 6.38379 15.0001C6.38379 19.7515 10.2494 23.6172 15.0008 23.6172C19.7523 23.6172 23.6179 19.7515 23.6179 15.0001C23.6179 10.2487 19.7523 6.38306 15.0008 6.38306ZM15.0008 21.7023C11.3053 21.7023 8.2987 18.6957 8.2987 15.0001C8.2987 11.3045 11.3053 8.29796 15.0008 8.29796C18.6964 8.29796 21.703 11.3045 21.703 15.0001C21.703 18.6957 18.6964 21.7023 15.0008 21.7023Z" fill="white" fill-opacity="0.5"/>
                        <path d="M14.9999 4.90478C15.5287 4.90478 15.9573 4.47611 15.9573 3.94735V0.957424C15.9573 0.428673 15.5287 0 14.9999 0C14.4712 0 14.0425 0.428673 14.0425 0.957424V3.9473C14.0425 4.47605 14.4712 4.90478 14.9999 4.90478Z" fill="white" fill-opacity="0.5"/>
                        <path d="M14.9999 25.0952C14.4712 25.0952 14.0425 25.5239 14.0425 26.0526V29.0425C14.0425 29.5713 14.4712 29.9999 14.9999 29.9999C15.5287 29.9999 15.9573 29.5713 15.9573 29.0425V26.0526C15.9573 25.5239 15.5287 25.0952 14.9999 25.0952Z" fill="white" fill-opacity="0.5"/>
                        <path d="M6.50788 7.86114C6.88171 8.23503 7.48798 8.23503 7.86193 7.86114C8.23582 7.48731 8.23582 6.88104 7.86193 6.50709L5.74774 4.39296C5.37391 4.01908 4.76764 4.01908 4.3937 4.39296C4.01981 4.76679 4.01981 5.37306 4.3937 5.74701L6.50788 7.86114Z" fill="white" fill-opacity="0.5"/>
                        <path d="M23.4924 22.1388C23.1185 21.7649 22.5123 21.765 22.1383 22.1388C21.7644 22.5126 21.7644 23.1189 22.1383 23.4928L24.2525 25.607C24.6263 25.981 25.2326 25.981 25.6065 25.607C25.9804 25.2332 25.9804 24.6269 25.6065 24.253L23.4924 22.1388Z" fill="white" fill-opacity="0.5"/>
                        <path d="M4.90478 15.0004C4.90478 14.4716 4.47611 14.043 3.94735 14.043H0.957424C0.428673 14.043 0 14.4716 0 15.0004C0 15.5291 0.428673 15.9578 0.957424 15.9578H3.9473C4.47605 15.9578 4.90478 15.5291 4.90478 15.0004Z" fill="white" fill-opacity="0.5"/>
                        <path d="M29.0425 14.043H26.0526C25.5239 14.043 25.0952 14.4716 25.0952 15.0004C25.0952 15.5291 25.5239 15.9578 26.0526 15.9578H29.0425C29.5713 15.9578 29.9999 15.5291 29.9999 15.0004C29.9999 14.4716 29.5713 14.043 29.0425 14.043Z" fill="white" fill-opacity="0.5"/>
                        <path d="M6.50929 22.1389L4.39516 24.253C4.02127 24.627 4.02127 25.2331 4.39516 25.6071C4.76899 25.981 5.37526 25.9811 5.74921 25.6071L7.86333 23.4929C8.23722 23.119 8.23722 22.5128 7.86333 22.1389C7.48945 21.7649 6.88318 21.7649 6.50929 22.1389Z" fill="white" fill-opacity="0.5"/>
                        <path d="M23.4924 7.8612L25.6065 5.74701C25.9804 5.37312 25.9804 4.76691 25.6065 4.39296C25.2327 4.01908 24.6264 4.01908 24.2525 4.39296L22.1383 6.50715C21.7644 6.88104 21.7644 7.48725 22.1383 7.8612C22.5122 8.23508 23.1185 8.23514 23.4924 7.8612Z" fill="white" fill-opacity="0.5"/>
                    </svg>
                    <svg v-else width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.37381 3.79444C7.37381 2.4477 7.64521 1.16752 8.1368 0C3.46672 1.13168 0 5.33577 0 10.3489C0 16.2275 4.77249 21 10.6511 21C15.6642 21 19.8683 17.5333 21 12.8632C19.8325 13.3548 18.5472 13.6262 17.2056 13.6262C11.7776 13.6262 7.37381 9.22238 7.37381 3.79444Z" fill="#101A23" fill-opacity="0.5"/>
                    </svg>

                </button>
            </div>
            <div class="w-full md:w-2/12">
                <primary>
                    Primary
                </primary>
            </div>
            <div class="w-full md:w-2/12">
                <secondary>
                    Secondary
                </secondary>
            </div>
            <div class="w-full md:w-2/12">
                <tertiary>
                    Tertiary
                </tertiary>
            </div>
            <div class="w-full md:w-2/12">
                <destructive>
                    Destructive
                </destructive>
            </div>
            <div class="w-full md:w-2/12 text-center mt-5 flex justify-center ">
                <text_hq>
                    Heading_H1
                </text_hq>
            </div>
            <div class="w-full md:w-2/12  max-h-25 flex mt-5 flex flex-wrap">
                <ts-label value="Label - Field name"/>
                <ts-input v-model="usr_s"/>
            </div>

            <div class="w-full md:w-2/12 text-left mt-5 flex justify-center   ">
                <div class="flex ubuntu justify-between items-center bg-light_interface dark:bg-dark_menu_bar_bg px-3 py-3 dark:border-b-0 border-b-2 rounded-lg w-full">
                    <div class="flex justify-center py-1.5 align-content-center w-16 h-5 dark:bg-mirage-500 bg-gray-200 rounded-xl h-11" >
                        <man-wit-box class="-mt-1"/>
                    </div>
                    <div class="flex flex-wrap">
                        <span class="ml-3 montserrat dark:text-text-dark text-text-light font-bold text-xl w-full">
                            Selector title
                        </span>
                        <span class="ml-3 montserrat dark:sub_text-dark text-sub_text-light font-bold text-md w-full">
                            P2 - Subtext
                        </span>
                    </div>
                    <div>
                        <arrow-next/>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-2/12 text-left mt-5 flex justify-center">
                <div class="w-full flex ubuntu justify-between  items-center bg-light_interface dark:bg-dark_menu_bar_bg px-3 py-3 dark:border-b-0 border-b-2 rounded-lg">
                    <div class="flex flex-wrap">
                        <span class="ml-3 montserrat dark:text-text-dark text-text-light font-bold text-xl w-full">
                            Selector title
                        </span>
                    </div>
                    <div>
                        <arrow-next/>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-2/12  h-25 flex mt-5 flex flex-wrap">

            </div>
            <div class="w-full md:w-2/12  h-25 flex mt-5 flex flex-wrap">
                <ts-label value="Label - Field name"/>
                <ts-text-area v-model="usr_s"/>
            </div>
        </div>

    </div>
</template>

<script>
import Primary from "@/UI/Buttons/Primary.vue";
import Secondary from "@/UI/Buttons/Secondary.vue";
import Tertiary from "@/UI/Buttons/Tertiary.vue";
import Destructive from "@/UI/Buttons/Destructive.vue";
import Text_hq from "@/UI/Text/Heading_H1.vue"
import TsInput from "@/Components/Input.vue"
import TsTextArea from "@/Components/Textarea.vue"
import TsLabel from "@/Components/Label.vue"
import TextVal from "@/Components/Inspection/Other/TextVal.vue";
import ManWitBox from "@/Components/SVG/ManWitBox.vue";
import ArrowNext from "@/Components/SVG/ArrowNext.vue";

export default {
    components:{
        TextVal,
        Primary,
        Secondary,
        Tertiary,
        Destructive,
        Text_hq,
        TsInput,
        ManWitBox,
        ArrowNext,
        TsLabel,
        TsTextArea
    },
    name: "UserProjects",
    props:{
        projects:Object,
    },
    data() {
        return {
            usr_s:null,
            them:localStorage.getItem('color-theme')

        }
    },
    mounted() {
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    },
    methods: {
        toggleDarkMode() {
            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                    this.them = 'dark';
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                    this.them = 'light';
                }

            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                    this.them = 'light';
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                    this.them = 'dark';

                }
            }
        }
    }
}
</script>
<style scoped>

</style>
