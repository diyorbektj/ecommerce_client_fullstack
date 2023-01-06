<template>
    <main class="max-w-screen-xl mx-auto bg-white w-full h-auto m-8 p-8 rounded-md">
        <div class="font-bold text-3xl m-4"><span class="text-green-600">BuyProduct</span></div>

        <div class="border border-gray-300 p-3 rounded my-8">
            Addres: Konibodom, Country: Tajikistan, Tel: +9929876544412
        </div>

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
                </tr>
                </thead>
                <tbody>
                <tr v-for="product in products" :key="product.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="p-4 w-32">
                        <img :src="product.product_image" alt="Iphone 12">
                    </td>
                    <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                        {{ product.product_name}}
                    </td>
                    <td class="py-4 px-6">
                        <div class="flex items-center space-x-3">
                            {{product.quantity}}
                        </div>
                    </td>
                    <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                        ${{product.price}}
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="flex justify-end my-4">
                <div class="p-2">Total: $ {{ amount }}</div> <br />
                <div>
                    <button @click="BuyProduct" class="bg-green-600 w-auto h-auto p-2 rounded text-white">Оформить Заказ</button>
                </div>
            </div>
        </div>

    </main>
</template>

<script>
import {mapGetters} from "vuex";
import CryptoJS from "crypto-js";
import router from "../router";

export default {
    name: "BuyProduct",
    data(){
        return{
            products: [],
            amount: 0,
        }
    },
    created() {
        axios.get("/api/order/buyproduct/"+this.$route.params.hash+"?quantity=1").then(res => {
            this.products = res.data.data
            this.amount = res.data.amount
            console.log(res.data)
        })
    },
    methods: {
        BuyProduct() {
            axios.post("/api/order/store", {products: this.products, total_price: this.amount}).then(response => {
                router.replace({ path: '/successfully' })
            })
        }
    }
}
</script>

<style scoped>

</style>
