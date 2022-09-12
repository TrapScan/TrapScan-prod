<script>
import Show from '@/Layouts/Show.vue';
import { useForm, Link } from '@inertiajs/inertia-vue3';
import SomthingElse from "@/Components/SVG/SomthingElse.vue";
import Rat from "@/Components/SVG/Animals/Rat.vue";
import Mouse from "@/Components/SVG/Animals/Mouse.vue";
import Stoat from "@/Components/SVG/Animals/Stoat.vue";
import Weasel from "@/Components/SVG/Animals/Weasel.vue";
import Hedgehog from "@/Components/SVG/Animals/Hedgehog.vue";
import ArrowNext from "@/Components/SVG/ArrowNext.vue";
import TextVal from "@/Components/Inspection/Other/TextVal.vue";
import { ref } from 'vue'
import EmptySvg from "@/Components/SVG/EmptySvg.vue";
import Panel from "@/Components/Panel.vue";
import Tertiary from "@/UI/Buttons/Tertiary.vue";

export default {
    props: {
        trap_data: Object
    },
    components: {
        Tertiary,
        Panel,
        Show, SomthingElse, Rat, Mouse, Stoat, Weasel, Hedgehog, ArrowNext, TextVal, Link, EmptySvg
    },
    setup(props) {
        const trap_data = props.trap_data
        const submit = (val) => {
            form.QR_ID = trap_data.qr_id
            form.species_caught = val
            form.post(route('anon_form.store'));
        };
        const form = useForm({
            QR_ID:null,
            species_caught:null
        })
        const show_all = ref(false)

        const species = ['Rat', 'Mouse', 'Stoat', 'Weasel', 'Hedgehog']
        const extraSpecies = ['Rat - Kiore', 'Rat - Norway', 'Unspecified', 'Bird', 'Rat - Ship', 'Cat', 'Deer', 'Dog', 'Ferret', 'Goat', 'Hare', 'Magpie', 'Peafowl', 'Pig', 'Possum', 'Rabbit', 'Turkey', 'None']

        return {
            form,
            submit,
            show_all,
            extraSpecies,
            species,
            trap_data
        }
    }
}
</script>


<template>
    <Show>
        <template #header>
            <div >
                <Link :href="route('index')">
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.39316 12.0653C7.86179 11.5966 7.86179 10.8368 7.39316 10.3682L3.44168 6.41675L7.39316 2.46528C7.86179 1.99665 7.86179 1.23685 7.39316 0.76822C6.92453 0.299591 6.16473 0.299591 5.6961 0.76822L0.896099 5.56822C0.427469 6.03685 0.427469 6.79665 0.896099 7.26528L5.6961 12.0653C6.16473 12.5339 6.92453 12.5339 7.39316 12.0653Z" fill="white"/>
                    </svg>
                </Link>
            </div>
            <div>
                <h1 class="text-white font-bold ml-1 text-[16px] font-fira tracking-wide">{{trap_data.qr_id}}</h1>
            </div>
            <div>
                <Link :href="route('index')">
                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.837327 0.709641C1.22785 0.319117 1.86102 0.319117 2.25154 0.709641L6.54443 5.00253L10.8373 0.709639C11.2279 0.319115 11.861 0.319115 12.2515 0.709639C12.6421 1.10016 12.6421 1.73333 12.2515 2.12385L7.95865 6.41675L12.2515 10.7096C12.6421 11.1002 12.6421 11.7333 12.2515 12.1239C11.861 12.5144 11.2279 12.5144 10.8373 12.1239L6.54443 7.83096L2.25154 12.1239C1.86102 12.5144 1.22785 12.5144 0.837329 12.1239C0.446804 11.7333 0.446804 11.1002 0.837329 10.7096L5.13022 6.41675L0.837327 2.12385C0.446803 1.73333 0.446803 1.10017 0.837327 0.709641Z" fill="white"/>
                    </svg>
                </Link>
            </div>
        </template>
        <template #last>
            <div class="bg-t_white-200 w-full flex justify-center items-end py-[6px]">
                <h6 class="italic text-t_black-800 montserrat text-[12px] " v-if="trap_data.last_checked">
                    Last checked <span class=" font-bold">{{trap_data.last_checked}}</span>
                </h6>
            </div>
        </template>
        <div class="grid grid-cols-2 gap-3 mx-[24px]" v-if="!show_all">
            <div v-for="(sp, index) in species" :key="index" @click='submit(sp)'
                 class="grid grid-cols-1 col-1 w-full mx-auto rounded-[4px] dark:bg-t_black-800 px-[10px] py-[8px]
             justify-items-center bg-white relative">
                <span class="justify-self-start text-[18px] font-fira font-medium dark:text-t_white-200 leading-[120%]">{{sp}}</span>
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
                <tertiary @click="show_all = false" >Show Less Items</tertiary>
            </div>
        </div>

                <div class="flex flex-wrap overflow-hidden mx-[24px] w-full mt-[24px]">
                    <panel  @click='submit("None")' text="It was empty">
                        <template #svg>
                            <empty-svg/>
                        </template>
                    </panel>
                </div>


    </Show>
</template>
