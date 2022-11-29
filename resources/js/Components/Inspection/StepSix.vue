<template>
    <span class="w-full px-6 text-[24px] mb-[36px] text-t_black-800 mt-3 dark:text-t_white-200 font-fira font-semibold">Is this correct?</span>
    <div class="flex flex-wrap overflow-hidden mx-[24px]">
        <panel  @click='selected(0)' text="Yes" >
            <template #svg>
                <good/>
            </template>
        </panel>
        <panel  @click='selected(7)' text="Add note first">
            <template #svg>
                <edit/>
            </template>
        </panel>
        <panel  @click='selected(8)' text="No" small_text="Let me edit">
            <template #svg>
                <no/>
            </template>
        </panel>
    </div>
</template>

<script>
import ArrowUp from "@/Components/SVG/ArrowUp.vue";
import Note from "@/Components/SVG/Note.vue";
import Panel from "@/Components/Panel.vue"
import No from  "@/Components/SVG/No.vue";
import Edit from "@/Components/SVG/Edit.vue";
import Good from "@/Components/SVG/Good.vue";

export default {
    name: "StepSix",
    components: {Edit, Panel, No, Note, ArrowUp,Good},
    data() {
        return {

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
