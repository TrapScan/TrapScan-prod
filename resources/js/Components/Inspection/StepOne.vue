<template>
    <div class="flex flex-col h-full gap-y-3 mt-24 px-4 mb-5">
        <div @click='selected(0)' class="flex w-full mx-auto border rounded-xl dark:border-white border-gray-900 p-5 justify-between bg-white dark:bg-mirage-400">
            <text-val><template #icon><empty-svg/></template> It was empty</text-val>
            <arrow-next/>
        </div>
        <div @click='selected(1)' class="flex w-full mx-auto border rounded-xl dark:border-white border-gray-900 p-5 justify-between bg-white dark:bg-mirage-400">
            <text-val><template #icon><in-it/></template> Something was in it</text-val>
            <arrow-next/>
        </div>
        <div @click='selected(2)' class="flex w-full mx-auto border rounded-xl dark:border-white border-gray-900 p-5 justify-between bg-white dark:bg-mirage-400">
            <text-val><template #icon><wrong/></template> Something's wrong</text-val>
            <arrow-next/>
        </div>
    </div>
</template>

<script>
import EmptySvg from "@/Components/SVG/EmptySvg.vue";
import InIt from "@/Components/SVG/InIt.vue";
import Wrong from "@/Components/SVG/Wrong.vue";
import ArrowNext from "@/Components/SVG/ArrowNext.vue";
import TextVal from "@/Components/Inspection/Other/TextVal.vue";
export default {
    props:{
        sel:String
    },
    name: "StepOne",
    components:{
        TextVal,
        ArrowNext,
        Wrong,
        InIt,
        EmptySvg,
    },
    data() {
        return {
            values:[
                {strikes:0,species_caught:"None",trap_condition: "Ok",words: "The trap caught nothing, ", step:2},
                {
                    strikes: 0,
                    status: 'Sprung',
                    trap_condition: 'Ok',
                    words: 'The trap caught a ',
                    step:3
                },
                {
                    strikes: 0,
                    species_caught: 'None',
                    rebaited: 'No',
                    bait_type: 'None',
                    words: "Something is wrong with it…",
                    step:4
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

<style scoped>

</style>
