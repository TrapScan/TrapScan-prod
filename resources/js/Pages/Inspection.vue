<template>
    <Show>
        <template #header>
            <div @click="back">
                <svg  v-if="step !== 1" width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.39316 12.0653C7.86179 11.5966 7.86179 10.8368 7.39316 10.3682L3.44168 6.41675L7.39316 2.46528C7.86179 1.99665 7.86179 1.23685 7.39316 0.76822C6.92453 0.299591 6.16473 0.299591 5.6961 0.76822L0.896099 5.56822C0.427469 6.03685 0.427469 6.79665 0.896099 7.26528L5.6961 12.0653C6.16473 12.5339 6.92453 12.5339 7.39316 12.0653Z" fill="white"/>
                </svg>

            </div>
            <div>
                <h1 class="text-white font-bold ml-1 text-[16px] font-fira tracking-wide">{{trap_data.qr_id}}</h1>
            </div>
            <div>
                <Link :href="route('scan')">
                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.837327 0.709641C1.22785 0.319117 1.86102 0.319117 2.25154 0.709641L6.54443 5.00253L10.8373 0.709639C11.2279 0.319115 11.861 0.319115 12.2515 0.709639C12.6421 1.10016 12.6421 1.73333 12.2515 2.12385L7.95865 6.41675L12.2515 10.7096C12.6421 11.1002 12.6421 11.7333 12.2515 12.1239C11.861 12.5144 11.2279 12.5144 10.8373 12.1239L6.54443 7.83096L2.25154 12.1239C1.86102 12.5144 1.22785 12.5144 0.837329 12.1239C0.446804 11.7333 0.446804 11.1002 0.837329 10.7096L5.13022 6.41675L0.837327 2.12385C0.446803 1.73333 0.446803 1.10017 0.837327 0.709641Z" fill="white"/>
                    </svg>
                </Link>
            </div>
        </template>
        <template v-if="step === 1" #last>
            <div v-if="step === 1" class="bg-t_white-200 w-full flex justify-center items-end py-[6px]">
                <h6 class="italic text-t_black-800 montserrat text-[12px] " v-if="trap_data.last_checked">
                    Last checked <span class=" font-bold">{{trap_data.last_checked}}</span>
                </h6>
            </div>
        </template>
        <template v-if="!unmapped">

            <div class="w-full mx-[24px]" v-if="step === 7 || step === 8">
                <h1 class="text-[24px] mb-[36px] text-t_black-800 dark:text-t_white-200 font-fira font-semibold" v-if="step === 8">Edit scan</h1>
                <span v-else></span>
            </div>
            <div class="w-full mx-[24px]" v-else>
                <h1 class="text-[18px] text-t_black-800 dark:text-t_white-200 italic font-fira" v-if="step === 5 || step === 6">{{form.words}}</h1>
                <h1 class="text-[24px] mb-[36px] text-t_black-800 dark:text-t_white-200 font-fira font-semibold" v-else>{{form.words}}</h1>
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
            if (this.prev_step.length === 0){
                this.prev_step.push(1)
            }
            if (this.step === 1){
                this.form.words = this.form.words = 'I checked this trap and...'
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
                this.form.words = this.form.words.replace(this.prev_word_5, '')
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
            this.prev_step.push(this.step)

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
