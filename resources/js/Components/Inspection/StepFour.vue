<template>
    <div class="flex flex-col h-full gap-y-3 mt-24 px-4 mb-5">
        <div @click='selected(0)' class="flex w-full mx-auto border rounded-xl dark:border-white border-gray-900 p-5 justify-between bg-white dark:bg-mirage-400">
            <text-val><template #icon><repair/></template> Needs repair or replacing</text-val>
            <arrow-next/>
        </div>
        <div @click='selected(1)' class="flex w-full mx-auto border rounded-xl dark:border-white border-gray-900 p-5 justify-between bg-white dark:bg-mirage-400">
            <text-val><template #icon><empty-svg/></template> Trap is missing</text-val>
            <arrow-next/>
        </div>
        <div @click='selected(2)' class="flex w-full mx-auto border rounded-xl dark:border-white border-gray-900 p-5 justify-between bg-white dark:bg-mirage-400">
            <text-val><template #icon><wrong-qr class="-mt-1"/></template> QR code needs fixing</text-val>
            <arrow-next/>
        </div>
    </div>
</template>

<script>
import ArrowNext from "@/Components/SVG/ArrowNext.vue";
import TextVal from "@/Components/Inspection/Other/TextVal.vue";
import Repair from "@/Components/SVG/Repair.vue";
import EmptySvg from "@/Components/SVG/EmptySvg.vue";
import WrongQr from "@/Components/SVG/WrongQr.vue";

export default {
    name: "StepFour",
    components:{
        WrongQr,
        Repair,
        TextVal,
        ArrowNext,
        EmptySvg,
    },
    data() {
        return {
            values:[
                {
                    trap_condition: 'Needs maintenance',
                    status: 'Removed for Repair',
                    words: 'The trap or trap box needs repair or replacing.',
                    step:6
                },
                {
                    trap_condition: 'Needs maintenance',
                    status: 'Trap gone',
                    words: 'The trap is missing.',
                    step:6
                },
                {
                    trap_condition: 'Needs maintenance',
                    status: 'Removed for Repair',
                    words: 'The QR code is wrong, missing or not working.',
                    step:6
                }
            ]
        }
    },
    methods:{
        selected (val){
            this.$emit('selected',this.values[val])
        }
    }
}
</script>
