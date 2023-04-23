<script setup>
import OnlineStoreLayout from '@/Layouts/OnlineStoreLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    product: Object,
});
</script>

<template>
    <OnlineStoreLayout>

        <Head :title="`${$t('Product')}-${product.name}`"></Head>

        <h1 class="text-lg text-center font-bold mb-4">Product</h1>

        <section class="w-full sm:w-3/4 max-w-lg mx-auto">
            <h2>{{ product.name }}</h2>
            <div>{{ product.category.name }}</div>
        </section>
    </OnlineStoreLayout>
</template>
