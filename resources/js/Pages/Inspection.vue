<template>
    <Show>
        <template #header>
            <div @click="back">
                <svg v-if="step !== 1"  xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 dark:text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </div>
            <div>
                <Link :href="route('scan')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 dark:text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </Link>
            </div>
        </template>
        <div class="px-4 pt-4 pb-2 w-full border-b-4 border-niagara-500 flex justify-between items-end" v-if="step === 1">
            <h1 class="text-2xl w-6/12 text-gray-500 font-bold montserrat">{{trap_data.qr_id}}</h1>
            <h6 class="font-italic text-gray-500 " v-if="trap_data.last_checked">
                Last checked <span class="font-bold">{{trap_data.last_checked}}</span>
            </h6>
        </div>
        <div class="p-4 w-full mt-5">
            <h1 class="text-2xl pl-4 w-full dark:text-white text-black font-bold montserrat border-l-4 border-mystic-800">{{form.words}}</h1>
        </div>
        <step-one @selected="setStepOne" v-if="step === 1"/>
        <step-two @selected="setStepTwo" v-if="step === 2"/>
        <step-three @selected="setStepThree" v-if="step === 3"/>
        <step-four @selected="setStepFour" v-if="step === 4"/>
        <step-five @selected="setStepFive" v-if="step === 5"/>
        <step-six @selected="setStepSix" v-if="step === 6"/>
        <add-note @selected="setNote" :text="form.notes" v-if="step === 7"/>
        <edit-form @selected="setEdit" v-if="step === 8"/>
    </Show>
</template>

<script>
import {useForm} from "@inertiajs/inertia-vue3";
import Show from "@/Layouts/Show.vue";
import { Link } from '@inertiajs/inertia-vue3'
import StepOne from "@/Components/Inspection/StepOne.vue";
import StepTwo from "@/Components/Inspection/StepTwo.vue";
import StepSix from "@/Components/Inspection/StepSix.vue";
import StepThree from "@/Components/Inspection/StepThree.vue";
import StepFive from "@/Components/Inspection/StepFive.vue";
import StepFour from "@/Components/Inspection/StepFour.vue";
import AddNote from "@/Components/Inspection/AddNote.vue";
import EditForm from "@/Components/Inspection/EditForm.vue";
const dateOb = new Date()

const day = ('0' + dateOb.getDate()).slice(-2)
const month = ('0' + (dateOb.getMonth() + 1)).slice(-2)
const year = dateOb.getFullYear()
const hours = ('0' + (dateOb.getHours())).slice(-2)
const minutes = ('0' + (dateOb.getMinutes())).slice(-2)
const seconds = ('0' + (dateOb.getSeconds())).slice(-2)

const dateS = year + '-' + month + '-' + day
const timeS = hours + ':' + minutes + ':' + seconds
export default {
    components:{
        EditForm,
        AddNote,
        StepFour,
        StepFive,
        StepThree,
        StepSix,
        StepTwo,
        StepOne,
        Show,
        Link
    },
    name: "Inspection",
    props:{
        trap_data:Object,
        unmapped: Boolean
    },
    data() {
        return {
            step:1,
            form:useForm({
                QR_ID: this.trap_data.qr_id,
                code: 'test',
                date: dateS,
                time: timeS,
                date_format: dateS + ' ' + timeS,
                recorded_by: null,
                strikes: null,
                species_caught: null,
                status: null,
                rebaited: null,
                bait_type: null,
                trap_condition: null,
                notes: '',
                words: 'I checked this trap and...',
                trap_last_checked: null,
                upload_to_nz: true
            })
        }
    },
    methods:{
        back(){
            this.step = this.step - 1;
        },
        setStepOne(data) {
            this.form.strikes = data.strikes ?? 0;
            this.form.status = data.status ?? null;
            this.form.species_caught = data.species_caught ?? 'None';
            this.form.words = data.words;
            this.form.trap_condition = data.trap_condition ?? 'None';
            this.step = data.step
        },
        setStepTwo(data){
            this.form.rebaited = data.rebaited ?? null;
            this.form.status = data.status ?? null;
            this.form.bait_type = data.bait_type ?? null;
            this.form.species_caught = data.species_caught ?? null;
            this.form.words = this.form.words + data.words ?? null;
            this.step = data.step
        },
        setStepThree(data){
            this.form.words = this.form.words + data.words;
            this.form.species_caught = data.species_caught;
            this.step = data.step
        },
        setStepFive(data){
            this.form.rebaited = data.rebaited;
            this.form.bait_type = data.bait_type ?? null;
            this.form.words = this.form.words + data.words ?? null;
            this.form.upload_to_nz = data.upload_to_nz ?? true;
            this.step = data.step
        },
        setStepFour(data){
            this.form.status = data.status ?? null;
            this.form.words = data.words;
            this.form.trap_condition = data.trap_condition ?? 'None';
            this.step = data.step
        },
        setStepSix(data){
            if (data === 0){
                return this.submitInspection();
            }
            this.step = data
        },
        setNote(data){
            this.form.notes = data.notes ?? null;
            if (data.step === 0){
                return this.submitInspection();
            }
            this.step = data.step
        },
        setEdit(data){

            return this.submitInspection();
        },
        submitInspection(){
            this.form.post(route('inspection.save'))
        }
    }
}
</script>

<style scoped>

</style>
