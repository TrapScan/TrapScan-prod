<template>
    <div class="grid grid-cols-2 gap-3 mt-4 px-4 w-full" v-if="!show_all">
        <div v-for="(sp, index) in species" :key="index" @click='selected({ species_caught: sp, words: `${sp}, `, step: 5 })'
             class="grid grid-cols-1 col-1 w-full mx-auto rounded-[4px] dark:bg-t_black-800 px-[10px] py-[8px]
             justify-items-center bg-white relative">
            <span class="justify-self-start text-[18px] font-fira font-medium dark:text-t_white-200">{{sp}}</span>
            <rat class="-mt-[15px]"  v-if="sp === 'Rat'"/>
            <mouse  v-if="sp === 'Mouse'"/>
            <stoat class="absolute mt-4" v-if="sp === 'Stoat'"/>
            <weasel  v-if="sp === 'Weasel'"/>
            <hedgehog v-if="sp === 'Hedgehog'"/>
        </div>
        <div @click='show_all = true'
             class="grid grid-cols-1 col-1 w-full mx-auto rounded-[4px] dark:bg-t_black-800 px-[10px] py-[8px]
             justify-items-center bg-white">
            <span class="text-[18px] font-fira font-medium dark:text-t_white-200 leading-[120%]">Something else</span>
            <somthing-else/>
        </div>
    </div>
    <div class="flex flex-wrap overflow-hidden mx-[24px]" v-if="show_all">
        <panel v-for="(sp, index) in extraSpecies" :key="index" @click='selected({ species_caught: sp, words: `${sp} `, step: 5})' :text="sp"/>

        <div class="mb-3 mx-auto">
            <Tertiary @click="show_all = false" >Show Less Items</Tertiary>
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
import Panel from "@/Components/Panel.vue";
import Tertiary from "@/UI/Buttons/Tertiary.vue";

export default {
    props:{
        sel:String
    },
    name: "StepThree",
    components:{
        Panel,
        Hedgehog,
        Weasel,
        Stoat,
        Mouse,
        Rat,
        SomthingElse,
        Tertiary
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
