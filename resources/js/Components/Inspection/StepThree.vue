<template>
    <div class="grid grid-cols-2 gap-3 mt-4 px-4 mb-5" v-if="!show_all">
        <div v-for="(sp, index) in species" :key="index" @click='selected({ species_caught: sp, words: `${sp}, `, step: 5 })'
             class="grid grid-cols-1 col-1 w-full mx-auto border rounded-xl dark:border-white border-gray-900 px-5 py-1.5
             justify-items-center bg-white dark:bg-mirage-400 ">
            <span class="ubuntu text-xl font-bold justify-self-start">{{sp}}</span>
            <rat  v-if="sp === 'Rat'"/>
            <mouse v-if="sp === 'Mouse'"/>
            <stoat v-if="sp === 'Stoat'"/>
            <weasel class="mt-8" v-if="sp === 'Weasel'"/>
            <hedgehog v-if="sp === 'Hedgehog'"/>
        </div>
        <div @click='show_all = true'
             class="grid grid-cols-1 gap-3 col-1 w-full mx-auto border rounded-xl dark:border-white border-gray-900 px-5 py-1.5
             justify-items-center bg-white dark:bg-mirage-400">
            <span class="ubuntu text-xl font-bold">Something else</span>
            <somthing-else/>
        </div>
    </div>
    <div class="flex flex-col h-full gap-y-3 mt-4 px-4 mb-5" v-if="show_all">
        <div v-for="(sp, index) in extraSpecies" :key="index" @click='selected({ species_caught: sp, words: `${sp} `, step: 5})'
            class="flex w-full items-center mx-auto border rounded-xl dark:border-white border-gray-900 p-5 justify-between bg-white dark:bg-mirage-400">
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
</template>

<script>
import SomthingElse from "@/Components/SVG/SomthingElse.vue";
import Rat from "@/Components/SVG/Animals/Rat.vue";
import Mouse from "@/Components/SVG/Animals/Mouse.vue";
import Stoat from "@/Components/SVG/Animals/Stoat.vue";
import Weasel from "@/Components/SVG/Animals/Weasel.vue";
import Hedgehog from "@/Components/SVG/Animals/Hedgehog.vue";
import ArrowNext from "@/Components/SVG/ArrowNext.vue";
import TextVal from "@/Components/Inspection/Other/TextVal.vue";
import { ref, reactive } from 'vue'

export default {
    props:{
        sel:String
    },
    name: "StepThree",
    components:{
        TextVal,
        ArrowNext,
        Hedgehog,
        Weasel,
        Stoat,
        Mouse,
        Rat,
        SomthingElse

    },
    data() {
        return {
            show_all:false,
            species: ['Rat', 'Mouse', 'Stoat', 'Weasel', 'Hedgehog'],
            extraSpecies: ['Rat - Kiore', 'Rat - Norway', 'Unspecified', 'Bird', 'Rat - Ship', 'Cat', 'Deer', 'Dog', 'Ferret', 'Goat', 'Hare', 'Magpie', 'Peafowl', 'Pig', 'Possum', 'Rabbit', 'Turkey', 'None'],
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
