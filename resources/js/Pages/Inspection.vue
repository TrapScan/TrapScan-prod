<template>
    <Show>
        <template #header>
            <div @click="back">
                <svg v-if="step !== 1"  xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </div>
            <div>
                <h1 class="text-xl w-full text-white font-bold montserrat">{{trap_data.qr_id}}</h1>
            </div>
            <div>
                <Link :href="route('scan')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </Link>
            </div>
        </template>
        <template v-if="!unmapped">
            <div v-if="step === 1" class="px-4 pt-4 pb-2 w-full border-b-4 border-niagara-500 flex justify-center items-end">
                <h6 class="font-italic text-gray-500 " v-if="trap_data.last_checked">
                    Last checked <span class="font-bold">{{trap_data.last_checked}}</span>
                </h6>
            </div>
            <div class="p-4 w-full mt-5" v-if="step === 7 || step === 8">
                <h1 class="text-2xl pl-4 w-full dark:text-white text-black font-bold montserrat">{{step === 7 ? 'Add a note to this inspection' : 'Edit inspection'}}</h1>
            </div>
            <div class="p-4 w-full mt-5" v-else>
                <h1 class="text-2xl pl-4 w-full dark:text-white text-black font-bold montserrat border-l-4 border-mystic-800">{{form.words}}</h1>
            </div>
            <step-one @selected="setStepOne"  @remap="remap" :qrs="qrs" :coordinator="coordinator" v-if="step === 1"/>
            <step-two @selected="setStepTwo" v-if="step === 2"/>
            <step-three @selected="setStepThree" v-if="step === 3"/>
            <step-four @selected="setStepFour" v-if="step === 4"/>
            <step-five @selected="setStepFive" v-if="step === 5"/>
            <step-six @selected="setStepSix" v-if="step === 6"/>
            <add-note @selected="setNote" :text="form.notes" v-if="step === 7"/>
            <edit-form @selected="setEdit" :values="form" v-if="step === 8"/>
        </template>
        <template v-else>
            <div class="flex flex-wrap justify-center p-4">
                <label for="small" class="mt-12 block mb-2 text-2xl font-bold text-gray-900 dark:text-gray-400">Map Code</label>
                <select v-model="newQR.nz_id" id="small" class=" block p-4 mb-4 w-full text-md text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option v-for="item in projects" :value="item.nz_trap_id">
                           {{ item.name }} - {{ item.project.name }}
                    </option>
                </select>
                <button type="button" @click="submit(1)" class="flex items-center justify-center focus:outline-none text-white text-lg bg-bay-of-many-500 hover:bg-bay-of-many-600 rounded-full py-4 w-full transition duration-150 ease-in">
                    Map QR
                </button>
            </div>
        </template>

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
import {ElMessage} from "element-plus";
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
        unmapped: Boolean,
        coordinator: Boolean,
        projects: Object,
        qrs: Object,
    },
    data() {
        return {
            step:1,
            newQR: useForm({
                qr_id:null,
                nz_id:null,
                type:'redir'
            }),
            prev_step:[1],
            prev_word_1:null,
            prev_word_2:null,
            prev_word_3:null,
            prev_word_4:null,
            prev_word_5:null,
            form:useForm({
                QR_ID: this.trap_data.qr_id,
                code: 'test',
                date_format: dateS +' ' + timeS,
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
            this.step = this.prev_step.pop();
            if (this.step === 1){
                this.form.words = this.form.words = 'The trap caught nothing, '
            }
            if (this.step === 2){
                this.form.words = this.form.words.replace(this.prev_word_2, '')
            }
            if (this.step === 3){
                this.form.words = this.form.words.replace(this.prev_word_3, '')
            }
            if (this.step === 4){
                this.form.words = this.form.words.replace(this.prev_word_4, '')
            }
            if (this.step === 5){
                this.form.words = this.form.words.replace(this.prev_word_3, '')
            }
        },
        setStepOne(data) {
            this.form.strikes = data.strikes ?? 0;
            this.form.status = data.status ?? null;
            this.form.species_caught = data.species_caught ?? 'None';
            this.form.words = data.words;
            this.form.trap_condition = data.trap_condition ?? 'None';
            this.step = data.step
            this.prev_step.push(this.step)
            this.prev_word_1 = data.words;
        },
        setStepTwo(data){
            this.form.rebaited = data.rebaited ?? null;
            this.form.status = data.status ?? null;
            this.form.bait_type = data.bait_type ?? null;
            this.form.species_caught = data.species_caught ?? 'None';
            this.form.words = this.form.words + data.words ?? null;
            this.step = data.step
            this.prev_word_2 = data.words;
            this.prev_step.push(this.step)

        },
        setStepThree(data){
            this.form.words = this.form.words + data.words;
            this.form.species_caught = data.species_caught;
            this.step = data.step
            this.prev_word_3 = data.words;
            this.prev_step.push(this.step)

        },
        setStepFive(data){
            this.form.rebaited = data.rebaited;
            this.form.bait_type = data.bait_type ?? null;
            this.form.words = this.form.words + data.words ?? null;
            this.form.upload_to_nz = data.upload_to_nz ?? true;
            this.step = data.step
            this.prev_word_5 = data.words;
            this.prev_step.push(this.step)

        },
        setStepFour(data){
            this.form.status = data.status ?? null;
            this.form.words = data.words;
            this.form.trap_condition = data.trap_condition ?? 'None';
            this.step = data.step
            this.prev_word_4 = data.words;
            this.prev_step.push(this.step)

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
            this.form.date_format = data.date_format;
            this.form.species_caught = data.species_caught;
            this.form.status = data.status;
            this.form.rebaited = data.rebaited;
            this.form.bait_type = data.bait_type;
            this.form.trap_condition = data.trap_condition;
            this.form.notes = data.notes;
            return this.submitInspection();
        },
        submitInspection(){
            this.form.post(route('inspection.save'))
        },
        remap(val){
          this.newQR.qr_id = val
          this.submit(2)
        },
        generateWords(){
            if (this.form.species_caught === 'None' && this.form.status === 'Still set, bait OK'){
                this.form.words = 'The trap caught nothing, it was still set and the bait was good so I didn\'t rebait it. '
            }

            if (this.form.species_caught === 'None' && this.form.status === 'Still set, bait missing'){
                this.form.words = 'The trap caught nothing, it was still set and the bait was missing, '
            }
            if (this.form.species_caught === 'None' && this.form.status === 'Still set, bait missing' && this.rebaited === 'No' && this.bait_type === 'None'){
                this.form.words = 'The trap caught nothing, it was still set and the bait was missing, and I\'m just letting you know.'
            }
            if (this.form.species_caught === 'None' && this.form.status === 'Still set, bait missing' && this.rebaited === 'No'){
                this.form.words = 'The trap caught nothing, it was still set and the bait was missing, and the bait was still good so I didn\'t rebait it.'
            }
            if (this.form.species_caught === 'None' && this.form.status === 'Still set, bait missing' && this.rebaited === 'No' && this.bait_type === 'None'){
                this.form.words = 'The trap caught nothing, it was still set and the bait was missing, and I\'m just letting you know.'
            }


            if (this.form.species_caught === 'None' && this.form.status === 'Sprung'){
                this.form.words = 'The trap caught nothing, it was sprung, '
            }
            if (this.form.species_caught === 'None' && this.form.status === 'Sprung' && this.rebaited === 'No' && this.bait_type === 'None'){
                this.form.words = 'The trap caught nothing, it was sprung, and I\'m just letting you know.'
            }
            if (this.form.species_caught === 'None' && this.form.status === 'Sprung' && this.rebaited === 'No'){
                this.form.words = 'The trap caught nothing, it was sprung, and the bait was still good so I didn\'t rebait it.'
            }
            if (this.form.species_caught === 'None' && this.form.status === 'Sprung' && this.rebaited === 'Yes'){
                this.form.words = 'The trap caught nothing, it was sprung, so I rebaited it with '+ this.form.bait_type
            }

            if (this.form.species_caught === 'None' && this.form.status === 'Still set, bait bad'){
                this.form.words = 'The trap caught nothing, it was still set and the bait was bad, '
            }
            if (this.form.species_caught === 'None' && this.form.status === 'Still set, bait bad' && this.rebaited === 'No' && this.bait_type === 'None'){
                this.form.words = 'The trap caught nothing, it was still set and the bait was bad, and I\'m just letting you know.'
            }
            if (this.form.species_caught === 'None' && this.form.status === 'Still set, bait bad' && this.rebaited === 'Yes'){
                this.form.words = 'The trap caught nothing, it was still set and the bait was bad, so I rebaited it with '+ this.form.bait_type
            }


            if (this.form.species_caught === 'None' && this.form.status === 'Still set, bait bad' && this.rebaited === 'Yes'){
                this.form.words = 'The trap caught nothing, it was still set and the bait was bad, so I rebaited it with '+ this.form.bait_type
            }


        },
        submit(type) {
            if (type === 1){
                this.newQR.qr_id = this.trap_data.qr_id
            }else{
                this.newQR.nz_id = this.trap_data.nz_trap_id
            }
            this.newQR.post(route('inspection.map_trap'),{
                preserveScroll: true,
                preserveState: true,
                onSuccess:() => {
                    ElMessage({
                        message: 'Congrats, trap mapped.',
                        type: 'success',
                    })

                }
            })
        },
    }
}
</script>

<style scoped>

</style>
