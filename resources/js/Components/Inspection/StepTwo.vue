<template>
    <div class="flex flex-col h-full gap-y-3 mt-24 px-4 mb-5">
        <div @click='selected(0)' class="flex w-full mx-auto border rounded-xl dark:border-white border-gray-900 p-5 justify-between bg-white dark:bg-mirage-400">
            <text-val><template #icon><good/></template> Bait is still good</text-val>
            <arrow-next/>
        </div>
        <div @click='selected(1)' class="flex w-full mx-auto border rounded-xl dark:border-white border-gray-900 p-5 justify-between bg-white dark:bg-mirage-400">
            <text-val><template #icon><danger/></template> Bait was old</text-val>
            <arrow-next/>
        </div>
        <div @click='selected(2)' class="flex w-full mx-auto border rounded-xl dark:border-white border-gray-900 p-5 justify-between bg-white dark:bg-mirage-400">
            <text-val><template #icon><circle-dash /></template> Bait was taken</text-val>
            <arrow-next/>
        </div>
        <div @click='selected(2)' class="flex w-full mx-auto border rounded-xl dark:border-white border-gray-900 p-5 justify-between bg-white dark:bg-mirage-400">
            <text-val><template #icon><lines/></template> Trap was sprung</text-val>
            <arrow-next/>
        </div>
    </div>
</template>

<script>
import Good from "@/Components/SVG/Good.vue";
import Danger from "@/Components/SVG/Danger.vue";
import Circle from "@/Components/SVG/CircleDash.vue";
import CircleDash from "@/Components/SVG/CircleDash.vue";
import Lines from "@/Components/SVG/Lines.vue";
import ArrowNext from "@/Components/SVG/ArrowNext.vue";
import TextVal from "@/Components/Inspection/Other/TextVal.vue";
export default {
    name: "StepTwo",
    components: {Lines, CircleDash, Circle, Danger, Good, ArrowNext, TextVal},
    data() {
        return {
            values:[
                {rebaited:"No", status:"Still set, bait OK", bait_type: "None",words: "it was still set and the bait was good so I didn\'t rebait it.", step:6},
                {status:"Still set, bait bad", words:"it was still set and the bait was bad, ", step:5},
                {status:"Still set, bait missing", words:"it was still set and the bait was missing, ", step:5},
                {status:"Sprung", species_caught:"None", words:"it was sprung, ", step:5},
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
