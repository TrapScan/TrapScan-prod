<template>
    <span class="px-4 pt-10 pb-5 text-xl font-bold text-lg ">So I rebaited the trap with…</span>
    <div class="grid grid-cols-2 gap-3 mt-4 px-4 mb-5" v-if="!show_all">
        <div v-for="(sp, index) in bait" :key="index" @click="selected({ rebaited: 'Yes', bait_type: sp, words: `so I rebaited it with ${sp}`, step:6 })"
             class="grid grid-cols-1 col-1 w-full mx-auto border rounded-xl dark:border-white border-gray-900 px-5 py-1.5
             justify-items-center bg-white dark:bg-mirage-400 ">
                <span class="ubuntu text-xl w-full font-bold justify-self-start">{{sp}}</span>
                <chocolate class="w-full" v-if="sp === 'Chocolate'"/>
                <peanut-butter class="w-full" v-if="sp=== 'Peanut Butter'"/>
                <whole-egg class="w-full" v-if="sp=== 'Whole egg'"/>
                <dehydrated-rabbit class="w-full" v-if="sp=== 'Dehydrated Rabbit'"/>
                <goodnature-rat class="w-full" v-if="sp=== 'Goodnature Rat and Mouse Lure'"/>

        </div>
        <div @click='show_all = true'
             class="grid grid-cols-1 gap-3 col-1 w-full mx-auto border rounded-xl dark:border-white border-gray-900 px-5 py-1.5
             justify-items-center bg-white dark:bg-mirage-400">
            <span class="ubuntu text-xl font-bold">Something else</span>
            <somthing-else/>
        </div>
    </div>
    <div class="flex flex-col h-full gap-y-3  px-4 mb-5" v-if="show_all">
        <div v-for="(sp, index) in extraBait" :key="index" @click="selected({ rebaited: 'Yes', bait_type: sp, words: `so I rebaited it with ${sp}` , step:6 })"
             class="flex w-full mx-auto border rounded-xl dark:border-white border-gray-900 p-5 justify-between bg-white dark:bg-mirage-400">
            <text-val>
                <template #icon>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mt-1 rotate-180 text-jelly-bean-500 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </template>
                {{sp}}
            </text-val>
            <arrow-next/>
        </div>
        <div class="flex w-6/12 mx-auto">
            <button @click="show_all = false"  class="flex mt-2 items-center justify-center focus:outline-none text-bay-of-many-500 dark:text-mystic-100 dark:border-mystic-100 font-bold text-sm sm:text-base border-2 border-bay-of-many-500 hover:bg-bay-of-many-500 hover:text-white rounded-2xl py-2 w-full transition duration-150 ease-in">
                <span class="uppercase">Show Less Items</span>
            </button>
        </div>
    </div>
    <div class="flex flex-col h-full gap-y-3 mt-5 px-4 mb-5">
        <div @click="selected({rebaited: 'No', words: `and the bait was still good so I didn't rebait it.`, step:6  })" class="flex items-center w-full mx-auto border rounded-xl dark:border-white border-gray-900 p-5 justify-between bg-white dark:bg-mirage-400">
            <text-val><template #icon><good/></template> Bait is still good</text-val>
            <arrow-next/>
        </div>
        <div @click="selected({rebaited: 'No', bait_type: 'None', words: 'and I\'m just letting you know.', upload_to_nz: false, step:6  })" class="flex items-center w-full mx-auto border rounded-xl dark:border-white border-gray-900 p-5 justify-between bg-white dark:bg-mirage-400">
            <text-val><template #icon><man-wit-box class="-mt-1"/></template>
                Just letting you know
                <p class="text-sm font-normal font-weight-light ">that the trap caught something and/or it needs rebaiting.</p>
            </text-val>
            <arrow-next/>
        </div>

    </div>
</template>

<script>
import ArrowNext from "@/Components/SVG/ArrowNext.vue";
import TextVal from "@/Components/Inspection/Other/TextVal.vue";
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
        TextVal,
        ArrowNext,
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
