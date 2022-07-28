<template>
    <div class="flex flex-col h-full gap-y-3 mt-5 px-4 mb-24">
        <div class="relative flex w-full flex-wrap items-stretch mb-3">
            <label for="first_name" class="block mb-2 text-xl font-medium text-dark dark:text-gray-300">QR ID</label>
            <input v-model="form.QR_ID" disabled type="text" id="large-input" class="block p-4 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <div class="relative flex w-full flex-wrap items-stretch mb-3">
            <label for="first_name" class="block mb-2 text-xl font-medium text-dark dark:text-gray-300">Inspection date</label>
            <input v-model="form.date_format" type="datetime-local" id="large-input" class="block p-4 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <div class="relative flex w-full flex-wrap items-stretch mb-3">
            <label for="large" class="block mb-2 text-xl font-medium text-gray-900 dark:text-gray-400">Status</label>
            <select v-model="form.status" id="large" class="block py-3 px-4 w-full text-base text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option v-for="st in status" :key="st" :value="st">{{st}}</option>
            </select>
        </div>
        <div class="relative flex w-full flex-wrap items-stretch mb-3">
            <label for="large" class="block mb-2 text-xl font-medium text-gray-900 dark:text-gray-400">Bait type</label>
            <select v-model="form.species_caught" id="large" class="block py-3 px-4 w-full text-base text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option v-for="st in species" :key="st" :value="st">{{st}}</option>
                <option v-for="st in extraSpecies" :key="st" :value="st">{{st}}</option>
            </select>
        </div>
        <div class="relative flex w-full flex-wrap items-stretch mb-3">
            <label for="large" class="block mb-2 text-xl font-medium text-gray-900 dark:text-gray-400">Rebaited</label>
            <select v-model="form.rebaited" id="large" class="block py-3 px-4 w-full text-base text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>
        <div class="relative flex w-full flex-wrap items-stretch mb-3">
            <label for="large" class="block mb-2 text-xl font-medium text-gray-900 dark:text-gray-400">Bait type</label>
            <select v-model="form.bait_type" id="large" class="block py-3 px-4 w-full text-base text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option v-for="st in bait" :key="st" :value="st">{{st}}</option>
                <option v-for="st in extraBait" :key="st" :value="st">{{st}}</option>
            </select>
        </div>
        <div class="relative flex w-full flex-wrap items-stretch mb-3">
            <label for="large" class="block mb-2 text-xl font-medium text-gray-900 dark:text-gray-400">Trap condition</label>
            <select v-model="form.trap_condition" id="large" class="block py-3 px-4 w-full text-base text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option v-for="st in trap_condition" :key="st" :value="st">{{st}}</option>
            </select>
        </div>
        <div class="relative flex w-full flex-wrap items-stretch mb-3">
            <label for="large" class="block mb-2 text-xl font-medium text-gray-900 dark:text-gray-400">Note</label>
            <textarea v-model="form.notes" placeholder="Inspection Note" cols="90" rows="6" class="block py-3 px-4 w-full text-base text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
        </div>

        <div class="flex w-full mx-auto">
            <button @click='selected(0)' class="flex mt-2 items-center font-bold justify-center focus:outline-none text-white text-sm sm:text-base bg-bay-of-many-500 hover:bg-bay-of-many-600 rounded-full py-4 w-full transition duration-150 ease-in">
                <span class="mr-2 uppercase">Yes, submit inspection</span>
            </button>
        </div>
    </div>
</template>

<script>
import ArrowUp from "@/Components/SVG/ArrowUp.vue";
import Note from "@/Components/SVG/Note.vue";
import Pen from "@/Components/SVG/Pen.vue";
import ArrowNext from "@/Components/SVG/ArrowNext.vue";
import TextVal from "@/Components/Inspection/Other/TextVal.vue";

export default {
    name: "EditForm",
    components: {TextVal, ArrowNext, Pen, Note, ArrowUp},
    props:{
        text:String,
        values:Object
    },
    data() {
        return {
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
