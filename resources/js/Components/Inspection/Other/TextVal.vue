<template>
    <div class="flex ubuntu place-content-center ">
        <div class="flex justify-center py-1.5 align-content-center w-16 h-5 dark:bg-mirage-500 bg-gray-200 rounded-xl h-11">
            <slot name="icon"></slot>
        </div>
        <span class="ml-3 ubuntu dark:text-white font-bold text-xl"><slot></slot></span>
    </div>
</template>
