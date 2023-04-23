<script setup>
import { onMounted } from 'vue';
import { initFlowbite } from 'flowbite';
import OnlineStoreLayoutHeader from '@/Layouts/Partials/OnlineStoreLayoutHeader.vue';
import OnlineStoreLayoutFooter from '@/Layouts/Partials/OnlineStoreLayoutFooter.vue';

onMounted(() => {
    initFlowbite();
});
</script>

<template>
    <div class="flex flex-col min-h-screen">
        <OnlineStoreLayoutHeader />

        <main class="flex-1 container mx-auto px-4">
            <slot />
        </main>

        <OnlineStoreLayoutFooter />
    </div>
</template>
