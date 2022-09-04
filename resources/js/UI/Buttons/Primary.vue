


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
    text-t_white-200
    dark:bg-t_purple-500
    py-[8px]
    px-[32px]
    flex
    justify-center
    items-center
    font-extrabold
    text-[13px]
    montserrat
    hover:bg-opacity-80
    uppercase
    h-[50px]
">
            <slot />
        </button>
    </template>
