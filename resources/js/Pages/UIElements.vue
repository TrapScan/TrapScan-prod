<template>
    <div class="w-full flex flex-wrap space-x-3 m-3">
        <div class="w-2/12">
            <primary>
                Primary
            </primary>
        </div>
        <div class="w-2/12">
            <secondary>
                Secondary
            </secondary>
        </div>
        <div class="w-2/12">
            <tertiary>
                Tertiary
            </tertiary>
        </div>
        <div class="w-2/12">
            <destructive>
                Destructive
            </destructive>
        </div>
        <div class="w-2/12 text-center flex justify-center ">
            <text_hq>
                Heading_H1
            </text_hq>
        </div>
    </div>
</template>

<script>
import Primary from "@/UI/Buttons/Primary.vue";
import Secondary from "@/UI/Buttons/Secondary.vue";
import Tertiary from "@/UI/Buttons/Tertiary.vue";
import Destructive from "@/UI/Buttons/Destructive.vue";
import Text_hq from "@/UI/Text/Heading_H1.vue"

export default {
    components:{
        Primary,
        Secondary,
        Tertiary,
        Destructive,
        Text_hq
    },
    name: "UserProjects",
    props:{
        projects:Object,
    },
    data() {
        return {
            usr_s:null
        }
    },
    mounted() {

    },
    methods: {

    }
}
</script>
<style scoped>

</style>
