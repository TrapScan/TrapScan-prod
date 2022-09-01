


<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

    <template>

        <button :type="type" class="
    w-full
    rounded-full
    bg-t_purple-700
    text-text-dark
    dark:bg-t_purple-500
    py-4
    flex
    justify-center
    items-center
    font-bold
    montserrat
    hover:bg-opacity-80
    uppercase
">
            <slot />
        </button>
    </template>
