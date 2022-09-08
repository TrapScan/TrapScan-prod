<template>
    <div class="flex flex-wrap overflow-hidden mx-[24px]">
        <panel  @click='selected(0)' text="Needs repair or replacing">
            <template #svg>
                <repair/>
            </template>
        </panel>
        <panel  @click='selected(1)' text="Trap is missing">
            <template #svg>
                <empty-svg/>
            </template>
        </panel>
        <panel  @click='selected(2)' text="QR code needs fixing">
            <template #svg>
                <wrong-qr/>
            </template>
        </panel>
    </div>
</template>

<script>
import Panel from "@/Components/Panel.vue"
import Repair from "@/Components/SVG/Repair.vue";
import EmptySvg from "@/Components/SVG/EmptySvg.vue";
import WrongQr from "@/Components/SVG/WrongQr.vue";

export default {
    name: "StepFour",
    components:{
        WrongQr,
        Repair,
        Panel,
        EmptySvg,
    },
    data() {
        return {
            values:[
                {
                    trap_condition: 'Needs maintenance',
                    status: 'Removed for Repair',
                    words: 'The trap or trap box needs repair or replacing.',
                    step:6
                },
                {
                    trap_condition: 'Needs maintenance',
                    status: 'Trap gone',
                    words: 'The trap is missing.',
                    step:6
                },
                {
                    trap_condition: 'Needs maintenance',
                    status: 'Removed for Repair',
                    words: 'The QR code is wrong, missing or not working.',
                    step:6
                }
            ]
        }
    },
    methods:{
        selected (val){
            this.$emit('selected',this.values[val])
        }
    }
}
</script>
