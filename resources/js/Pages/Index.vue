<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import OnlineStoreLayout from '@/Layouts/OnlineStoreLayout.vue';
import Cart from '@/Components/Cart.vue';
import Pagination from '@/Components/Pagination.vue';

const $cart = ref(null);

defineProps({
    products: Object,
});

const addProductToCart = (product) => {
    if (localStorage.getItem(product.id) === null) {
        localStorage.setItem(product.id, JSON.stringify(product));
        $cart.value.loadProducts();
    } else {
        alert('Product already was added');
    }
};
</script>

<template>
    <OnlineStoreLayout>

        <Head :title="$t('pages.home')" />

        <section class="flex">
            <h1 class="text-lg font-bold mb-4">{{ $t('Products') }}</h1>
            <Cart ref="$cart" />
        </section>

        <section class="mb-6">
            <div v-if="products.data.length > 0" class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div v-for="product in products.data" :key="product.id"
                    class="p-6 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <h2 class="mb-2 text-xl font-bold tracking-tight text-gray-800 dark:text-white">
                        <a :href="'/products/' + product.id">{{ product.name }}</a>
                    </h2>
                    <div class="font-normal text-gray-700 dark:text-gray-400"><a
                            :href="`/?category=${product.category.id}`">{{ product.category.name }}</a></div>
                    <button type="button"
                        class="w-full sm:w-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                        @click="addProductToCart(product)">{{ $t('Add to cart') }}</button>
                </div>
            </div>
            <p v-else>{{ $t('Products is not found.') }}</p>
        </section>

        <Pagination :next-page-url="products.next_page_url" :prev-page-url="products.prev_page_url"
            :links="products.links" />
    </OnlineStoreLayout>
</template>
