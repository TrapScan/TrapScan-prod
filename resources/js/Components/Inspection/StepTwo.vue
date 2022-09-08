<template>
    <div class="flex flex-wrap overflow-hidden mx-[24px]">
        <panel  @click='selected(0)' text="Bait is still good">
            <template #svg>
                <good/>
            </template>
        </panel>
        <panel  @click='selected(1)' text=" Bait was old">
            <template #svg>
                <danger/>
            </template>
        </panel>
        <panel  @click='selected(2)' text="Bait was taken">
            <template #svg>
                <circle-dash />
            </template>
        </panel>
        <panel  @click='selected(3)' text="Trap was sprung">
            <template #svg>
                <lines/>
            </template>
        </panel>
    </div>
</template>

<script>
import Good from "@/Components/SVG/Good.vue";
import Danger from "@/Components/SVG/Danger.vue";
import Circle from "@/Components/SVG/CircleDash.vue";
import CircleDash from "@/Components/SVG/CircleDash.vue";
import Lines from "@/Components/SVG/Lines.vue";
import Panel from "@/Components/Panel.vue"

export default {
    name: "StepTwo",
    components: {Lines, CircleDash, Circle, Danger, Good, Panel},
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
