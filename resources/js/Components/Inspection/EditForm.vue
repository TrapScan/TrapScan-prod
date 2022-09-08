<template>
    <div class="flex flex-wrap overflow-hidden mx-[24px]">
        <div class="relative flex w-full flex-wrap items-stretch">
            <ts-input v-model="form.QR_ID" label="QR ID" :disabled="true"/>
        </div>
        <div class="relative flex w-full flex-wrap items-stretch ">
            <ts-input v-model="form.date_format" label="Inspection date" type="datetime-local"/>
        </div>
        <div class="relative flex w-full flex-wrap items-stretch mb-5">
            <ts-label value="Status"/>
            <select v-model="form.status" id="large" :class="select_class">
                <option v-for="st in status" :key="st" :value="st">{{st}}</option>
            </select>
        </div>
        <div class="relative flex w-full flex-wrap items-stretch mb-5">
            <ts-label value="Species caught"/>
            <select v-model="form.species_caught" id="large" :class="select_class">
                <option v-for="st in species" :key="st" :value="st">{{st}}</option>
                <option v-for="st in extraSpecies" :key="st" :value="st">{{st}}</option>
            </select>
        </div>
        <div class="relative flex w-full flex-wrap items-stretch mb-5">
            <ts-label value="Rebaited"/>
            <select v-model="form.rebaited" id="large" :class="select_class">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>
        <div class="relative flex w-full flex-wrap items-stretch mb-5">
            <ts-label value="Bait type"/>
            <select v-model="form.bait_type" id="large" :class="select_class">
                <option v-for="st in bait" :key="st" :value="st">{{st}}</option>
                <option v-for="st in extraBait" :key="st" :value="st">{{st}}</option>
            </select>
        </div>
        <div class="relative flex w-full flex-wrap items-stretch mb-5">
            <ts-label value="Trap condition"/>
            <select v-model="form.trap_condition" id="large" :class="select_class">
                <option v-for="st in trap_condition" :key="st" :value="st">{{st}}</option>
            </select>
        </div>
        <div class="relative flex w-full flex-wrap items-stretch mb-5">
            <ts-label value="Note"/>
            <ts-text-area v-model="form.notes"/>

        </div>

        <div class="flex w-full mx-auto">
            <primary @click='selected(0)'>SUBMIT INSPECTION</primary>
        </div>
    </div>
</template>

<script>
import ArrowUp from "@/Components/SVG/ArrowUp.vue";
import Note from "@/Components/SVG/Note.vue";
import Pen from "@/Components/SVG/Pen.vue";
import ArrowNext from "@/Components/SVG/ArrowNext.vue";
import TextVal from "@/Components/Inspection/Other/TextVal.vue";
import Primary from "@/UI/Buttons/Primary.vue";
import TsTextArea from "@/Components/Textarea.vue"
import TsLabel from "@/Components/Label.vue"
import TsInput from "@/Components/Input.vue"


export default {
    name: "EditForm",
    components: {TextVal, ArrowNext, Pen, Note, ArrowUp, TsInput, TsLabel, TsTextArea, Primary},
    props:{
        text:String,
        values:Object
    },
    data() {
        return {
            select_class:'border-t_blue_gray-700 border-[3px] dark:border-t_blue_gray-300 dark:bg-dark_input_bg w-full px-[16px] py-[13px] dark:text-t_white-200 font-fira focus:border-dark_button dark:focus:border-dark_button rounded-md shadow-sm',
            form:{
                QR_ID: this.values.QR_ID,
                date_format: this.values.date_format,
                species_caught: this.values.species_caught,
                status: this.values.status,
                rebaited: this.values.rebaited,
                bait_type: this.values.bait_type,
                trap_condition: this.values.trap_condition,
                notes: this.values.notes,
            },
            status: [
                'Sprung',
                'Removed for Repair',
                'Trap Replaced',
                'Still set, bait OK',
                'Still set, bait missing',
                'Still set, bait bad',
                'Trap gone',
                'Trap interfered by stock'
            ],
            trap_condition: [
                'Ok',
                'Needs maintenance',
                'Repaired',
                'Regassed',
                'Relured',
                'Battery charge'
            ],
            bait: ['Peanut Butter', 'Goodnature Rat and Mouse Lure', 'Dehydrated Rabbit', 'Whole egg', 'Chocolate'],
            extraBait: ['Carrot', 'Cereal', 'Cheese', 'Dried fruit', 'Ferret Bedding', 'Fresh Fruit', 'Fresh Meat', 'Fresh Possum', 'Fresh Rabbit', 'Golf ball', '​Goodnature Stoat Lure', 'Lure', 'Lure-it Salmon Spray', 'Mayo', 'Mustelid and Cat Lure', 'Nut', 'Nutella', 'Possum Dough', 'Rat and Possum Lure', 'Rat oil', 'Salted meat', 'Salted Possum', 'Salted Rabbit', 'Smooth', 'Terracotta Lures', 'Tinned Sardines', 'None'],
            species: ['Rat', 'Mouse', 'Stoat', 'Weasel', 'Hedgehog'],
            extraSpecies: ['Rat - Kiore', 'Rat - Norway', 'Unspecified', 'Bird', 'Rat - Ship', 'Cat', 'Deer', 'Dog', 'Ferret', 'Goat', 'Hare', 'Magpie', 'Peafowl', 'Pig', 'Possum', 'Rabbit', 'Turkey', 'None'],
        }
    },
    mounted() {

    },
    methods:{
        selected (){
            this.$emit('selected',this.form)
        }
    }
}
</script>

<style scoped>

</style>
