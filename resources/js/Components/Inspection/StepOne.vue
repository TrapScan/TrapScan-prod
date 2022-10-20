<template>
    <div class="flex flex-wrap overflow-hidden mx-[24px]">
        <panel  @click='selected(0)' text="It was empty">
            <template #svg>
                <empty-svg/>
            </template>
        </panel>
        <panel @click='selected(1)' text="Something was in it">
            <template #svg>
                <in-it/>
            </template>
        </panel>
        <panel  @click='selected(2)' text="Something's wrong">
            <template #svg>
                <wrong/>
            </template>
        </panel>
        <panel  v-if="coordinator" @click='dialogVisible = !dialogVisible' text="Re-map QR">
            <template #svg>
                <remap/>
            </template>
        </panel>

    </div>
    <el-dialog
        v-model="dialogVisible"
        title="Install QR for Trap"
        width="90%"
    >
        <div class="flex justify-center">
            <Autocomplate
                :lists="qrs"
                @selected="selectedData"
                :clearInputWhenClicked="false"
                :inputClass="[
                    'block',
                    'p-4',
                    'mb-4',
                    'w-full',
                    'text-md',
                    'text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
                  ]"
                placeholder="Please write a qr name"
            >

            </Autocomplate>
        </div>

        <template #footer>
      <span class="dialog-footer">
        <el-button @click="dialogVisible = false">Cancel</el-button>
        <el-button type="primary" @click="remap"
        >Confirm</el-button
        >
      </span>
        </template>
    </el-dialog>
</template>

<script>
import EmptySvg from "@/Components/SVG/EmptySvg.vue";
import InIt from "@/Components/SVG/InIt.vue";
import Wrong from "@/Components/SVG/Wrong.vue";
import Remap from "@/Components/SVG/Remap.vue";
import Panel from "@/Components/Panel.vue"
import Autocomplate from "@/Components/Autocomplate.vue";

export default {
    props:{
        qrs:Object,
        coordinator:Boolean
    },
    name: "StepOne",
    components:{
        Panel,
        Wrong,
        InIt,
        EmptySvg,
        Remap,
        Autocomplate
    },
    data() {
        return {
            dialogVisible: false,
            val:null,
            values:[
                {strikes:0,species_caught:"None",trap_condition: "Ok",words: "The trap caught nothing, ", step:2},
                {
                    strikes: 0,
                    status: 'Sprung',
                    trap_condition: 'Ok',
                    words: 'The trap caught a ',
                    step:3
                },
                {
                    strikes: 0,
                    species_caught: 'None',
                    rebaited: 'No',
                    bait_type: 'None',
                    words: "Something is wrong with it…",
                    step:4
                }
            ]
        }
    },
    methods:{
        selectedData(value) {
            this.val = value.id;
            console.log(value);
        },
        selected (val){
            this.$emit('selected',this.values[val])
        },
        remap(){
            this.$emit('remap',this.val)
            this.dialogVisible = false
        }
    }
}
</script>

<style scoped>

</style>
