
<script setup>
import { onMounted, ref } from "vue";
import QrCode from "@/Components/SVG/QrCode.vue";
import ArrowNext from "@/Components/SVG/ArrowNext.vue";
defineProps({
    list:Object,
    modelValue: String,
});

defineEmits(["update:modelValue",'selected']);
const input = ref(null);
onMounted(() => {
    input.value.focus();
});

</script>
<template>
    <div class="border-t_blue_gray-700 border-[1.5px] dark:border-t_blue_gray-300 dark:bg-dark_input_bg rounded-[0.375em] shadow-sm">
        <div class="relative w-full">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.59988 3.2999C4.94892 3.2999 2.7999 5.44894 2.7999 8.0999C2.7999 10.7509 4.94892 12.8999 7.59988 12.8999C10.2508 12.8999 12.3999 10.7509 12.3999 8.0999C12.3999 5.44894 10.2508 3.2999 7.59988 3.2999ZM0.399902 8.0999C0.399902 4.12345 3.62344 0.899902 7.59988 0.899902C11.5763 0.899902 14.7999 4.12345 14.7999 8.0999C14.7999 9.6549 14.3069 11.0948 13.4688 12.2717L19.2484 18.0514C19.717 18.52 19.717 19.2798 19.2484 19.7484C18.7797 20.2171 18.0199 20.2171 17.5513 19.7484L11.7717 13.9688C10.5947 14.807 9.15487 15.2999 7.59988 15.2999C3.62344 15.2999 0.399902 12.0764 0.399902 8.0999Z" fill="#7A9EB8"/>
                </svg>

            </div>
            <input
                class="outline-0 dark:bg-dark_input_bg w-full pl-10 pr-[12px] py-[8px] dark:text-t_white-200 font-fira focus:border-dark_button rounded-t-[0.375em]"
                :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
                ref="input"
                v-on:keyup.enter="$emit('selected', this.list[0].qr_code ?? this.list[0].id)"
            />
        </div>
        <div class="bg-[#F0F5F9] px-2 py-2 rounded-[4px]" >
            <div v-if="list.length > 0" v-for="(item, index) in list" :key="item.id"
                 @click="$emit('selected', item.qr_code ?? item.id)"
                 :class="{'border-2 border-t_purple-500':index === 0}"
                 class="
                 hover:border-2 hover:border-t_purple-500
                 mb-2 h-[44px] p-[10px] w-full overflow-hidden items-center dark:bg-t_black-800 justify-center bg-white px-[16px] py-[16px] border-black flex justify-between rounded-[4px]">
                <div class="justify-center flex items-center rounded-[4px] dark:bg-gray-900 bg-gray-100" >
                    <qr-code/>
                </div>
                <div class="ml-1 w-9/12">
                    <p class="montserrat text-[16px] font-bold dark:text-t_white-200 tracking-[.05em]">{{item.qr_code ?? item.name}}</p>
                </div>
                <div class="ml-3 py-3">
                    <arrow-next/>
                </div>
            </div>
            <span class="text-t_blue_gray-700" v-else>
                No results
            </span>
        </div>
    </div>

</template>

<style scoped>

</style>
