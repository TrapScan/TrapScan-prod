<template>
    <span class="w-full px-6  mb-[36px] text-[24px] text-t_black-800 dark:text-t_white-200 font-fira font-semibold">So I rebaited the trap with…</span>
    <div class="grid grid-cols-2 gap-3 mt-4 px-4" v-if="!show_all">
        <div v-for="(sp, index) in bait" :key="index" @click="selected({ rebaited: 'Yes', bait_type: sp, words: `so I rebaited it with ${sp}`, step:6 })"
             class="grid grid-cols-1 col-1 w-full mx-auto rounded-[4px] dark:bg-t_black-800 px-[10px] py-[8px]
             justify-items-center bg-white">
            <span class="justify-self-start text-[18px] font-fira font-medium dark:text-t_white-200">{{sp}}</span>
                <chocolate class="w-full" v-if="sp === 'Chocolate'"/>
                <peanut-butter class="w-full" v-if="sp=== 'Peanut Butter'"/>
                <whole-egg class="w-full" v-if="sp=== 'Whole egg'"/>
                <dehydrated-rabbit class="w-full" v-if="sp=== 'Dehydrated Rabbit'"/>
                <goodnature-rat class="w-full" v-if="sp=== 'Goodnature Rat and Mouse Lure'"/>

        </div>
        <div @click='show_all = true'
             class="grid grid-cols-1 col-1 w-full mx-auto rounded-[4px] dark:bg-t_black-800 px-[10px] py-[8px]
             justify-items-center bg-white">
            <span class="text-[18px] font-fira font-medium dark:text-t_white-200">Something else</span>
            <somthing-else/>
        </div>
    </div>
    <div class="flex flex-wrap overflow-hidden mx-[24px]" v-if="show_all">
        <panel v-for="(sp, index) in extraBait" :key="index" @click="selected({ rebaited: 'Yes', bait_type: sp, words: `so I rebaited it with ${sp}` , step:6 })" :text="sp"/>
        <div class="mb-3 mx-auto">
            <Tertiary @click="show_all = false" >Show Less Items</Tertiary>
        </div>
    </div>
    <div class="flex flex-col h-full mt-[24px] px-4 ">
        <panel @click="selected({rebaited: 'No', words: `and the bait was still good so I didn't rebait it.`, step:6  })"  text="Bait is still good">
            <template #svg>
                <good/>
            </template>
        </panel>
        <panel @click="selected({rebaited: 'No', bait_type: 'None', words: 'and I\'m just letting you know.', upload_to_nz: false, step:6  })" text="Just letting you know" small_text="that the trap caught something and/or it needs rebaiting.">
            <template #svg>
                <man-wit-box class="-mt-1"/>
            </template>
        </panel>
    </div>
</template>

<script>
import Panel from "@/Components/Panel.vue";
import Tertiary from "@/UI/Buttons/Tertiary.vue";
import SomthingElse from "@/Components/SVG/SomthingElse.vue";
import Chocolate from "@/Components/SVG/Foods/Chocolate.vue";
import PeanutButter from "@/Components/SVG/Foods/PeanutButter.vue";
import WholeEgg from "@/Components/SVG/Foods/WholeEgg.vue";
import DehydratedRabbit from "@/Components/SVG/Foods/DehydratedRabbit.vue";
import GoodnatureRat from "@/Components/SVG/Foods/GoodnatureRat.vue";
import Good from "@/Components/SVG/Good.vue";
import ManWitBox from "@/Components/SVG/ManWitBox.vue";
export default {
    name: "StepFive",
    components:{
        ManWitBox,
        Good,
        GoodnatureRat,
        DehydratedRabbit,
        WholeEgg,
        PeanutButter,
        Chocolate,
        Panel,
        Tertiary,
        SomthingElse

    },
    data() {
        return {
            show_all:false,
            bait: ['Peanut Butter', 'Goodnature Rat and Mouse Lure', 'Dehydrated Rabbit', 'Whole egg', 'Chocolate'],
            extraBait: ['Carrot', 'Cereal', 'Cheese', 'Dried fruit', 'Ferret Bedding', 'Fresh Fruit', 'Fresh Meat', 'Fresh Possum', 'Fresh Rabbit', 'Golf ball', '​Goodnature Stoat Lure', 'Lure', 'Lure-it Salmon Spray', 'Mayo', 'Mustelid and Cat Lure', 'Nut', 'Nutella', 'Possum Dough', 'Rat and Possum Lure', 'Rat oil', 'Salted meat', 'Salted Possum', 'Salted Rabbit', 'Smooth', 'Terracotta Lures', 'Tinned Sardines', 'None']

        }
    },
    methods:{
        selected (val){
            this.$emit('selected',val)
        }
    }
}
</script>

<style scoped>

</style>
