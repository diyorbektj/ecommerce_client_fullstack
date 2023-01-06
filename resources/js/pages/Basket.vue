<template>
    <main class="max-w-screen-xl mx-auto bg-white h-auto m-8 p-8 rounded-md">
        <div class="font-bold text-4xl m-4"><span class="text-green-600">Basket</span> page</div>
    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    <span class="sr-only">Image</span>
                </th>
                <th scope="col" class="py-3 px-6">
                    Product
                </th>
                <th scope="col" class="py-3 px-6">
                    Qty
                </th>
                <th scope="col" class="py-3 px-6">
                    Price
                </th>
                <th scope="col" class="py-3 px-6">
                    Action
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="product in CartItems" :key="product.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="p-4 w-32">
                    <img :src="product.product_image" alt="Iphone 12">
                </td>
                <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                    {{ product.product_name}}
                </td>
                <td class="py-4 px-6">
                    <div class="flex items-center space-x-3">
                        <button @click="$store.dispatch('DECREMENT_PRODUCT', product)" class="inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white rounded-full border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" type="button" form="">
                            <span class="sr-only">Quantity button</span>
                            <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                        </button>
                        <div>
                            <input type="number" id="third_product" class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" :value="product.quantity" required="">
                        </div>
                        <button @click="$store.dispatch('INCREMENT_PRODUCT', product)" class="inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white rounded-full border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" type="button" form="">
                            <span class="sr-only">Quantity button</span>
                            <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>
                </td>
                <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                    ${{product.price}}
                </td>
                <td class="py-4 px-6">
                    <button @click="$store.dispatch('REMOVE_PRODUCT', product)" class="font-medium text-red-600 dark:text-red-500 hover:underline">Remove</button>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="flex justify-end my-4">
            <div>
                <button class="bg-gray-200 w-auto h-auto p-2 rounded" @click="$store.dispatch('RemoveMyBasket')" form="">Clear</button>
            </div>
            <div class="p-2">Total: $ {{ getTotalPrice }}</div>
            <div>
                <button @click="BuyProduct" class="bg-green-600 w-auto h-auto p-2 rounded text-white" form="">Купить</button>
            </div>
        </div>
    </div>
    </main>
</template>

<script>
import {mapGetters} from "vuex";
import router from "../router";
import CryptoJS from "crypto-js";

export default {
    name: "Basket",
    computed:{
        ...mapGetters(["getTotalPrice", "CartItems"])
    },
    methods: {
        BuyProduct(){
            axios.get("/api/order/buyproduct/"+CryptoJS.MD5("basket")).then(res => {
                router.push(`/buyproduct/${CryptoJS.MD5('basket')}`)
            })
        }
    }
}
</script>

<style scoped>

</style>
