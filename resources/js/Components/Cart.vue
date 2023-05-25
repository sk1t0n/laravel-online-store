<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';

const $products = ref([]);
const $productsCount = ref(0);
const $btnCloseModal = ref(null);

const loadProducts = () => {
    axios.get('/cart/loadProducts')
        .then(response => {
            $products.value = response.data.products;
            $productsCount.value = response.data.count;
        })
        .catch(error => {
            $products.value = [];
            $productsCount.value = 0;
            console.error(error);
        });
};

const clearCart = () => {
    axios.get('/cart/clear')
        .then(response => {
            $products.value = [];
            $productsCount.value = 0;
            $btnCloseModal.value.click();
            console.log(response.data.message);
        })
        .catch(error => console.error(error));
};

onMounted(() => loadProducts());

defineExpose({
    loadProducts
})
</script>

<template>
    <!-- Modal toggle -->
    <button data-modal-target="modalCart" data-modal-toggle="modalCart" class="relative w-5 h-5 m-1" type="button"
        @click="loadProducts">
        <svg aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"
                stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
        <span class="sr-only">{{ $t('Notifications') }}</span>
        <div
            class="absolute inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-3 -right-3 dark:border-gray-900">
            {{ $productsCount }}</div>
    </button>

    <!-- Modal -->
    <div id="modalCart" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-6 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{ $t('Cart') }}
                    </h3>
                    <button ref="$btnCloseModal" type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="modalCart">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">{{ $t('Close modal') }}</span>
                    </button>
                </div>
                <div v-if="$products">
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <div v-for="product in $products" :key="product.id">
                            <div>{{ product.name }} <span>{{ product.price }} $</span></div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="modalCart" type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            @click="clearCart">{{ $t('Clear cart') }}</button>
                    </div>
                </div>
                <div v-else class="p-6">{{ $t('Cart is empty.') }}</div>
            </div>
        </div>
    </div>
</template >
