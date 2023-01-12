<template>
    <main class="max-w-screen-xl mx-auto bg-white w-full h-auto m-8 p-8 rounded-md">
        <div class="font-bold text-3xl m-4"><span class="text-green-600">BuyProduct</span></div>

<!--        <div class="border border-gray-300 p-3 rounded my-8">-->
<!--            Addres: Konibodom, Country: Tajikistan, Tel: +9929876544412-->
<!--        </div>-->

        <div v-show="is_page1" class="overflow-x-auto relative shadow-md sm:rounded-lg">
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
                    <button v-if="is_page2 === false" @click="NextProduct" class="bg-green-600 w-auto h-auto p-2 rounded text-white">Далее</button>
                </div>
            </div>
        </div>
        <form @submit.prevent="BuyProduct" multiple="form/data">
            <div id="#adress" class="mt-10" v-show="is_page2">
                <div class="my-4">
                    <div><label class="text-lg">Имя:</label></div>
                    <input required type="text" v-model="address.fullname" class="h-10 w-96 border border-gray-200 rounded-xl p-3 pr-8 bg-gray-100 focus:bg-white focus:outline-none text-black" placeholder="Имя">
                </div>
                <div class="my-4">
                    <div><label class="text-lg">Страна:</label></div>
                    <p>Таджикистан</p>
                </div>
                <div class="my-4">
                    <div><label class="text-lg">Город:</label></div>
                    <input required type="text" v-model="address.city" class="h-10 w-96 border border-gray-200 rounded-xl p-3 pr-8 bg-gray-100 focus:bg-white focus:outline-none text-black" placeholder="Город">
                </div>
                <div class="my-4">
                    <div><label class="text-lg">Адрес:</label></div>
                    <input required type="text" v-model="address.street" class="h-10 w-96 border border-gray-200 rounded-xl p-3 pr-8 bg-gray-100 focus:bg-white focus:outline-none text-black" placeholder="Адрес">
                </div>
                <div class="my-4">
                    <div><label class="text-lg">Телефон:</label></div>
                    <input required type="text" v-model="address.phone_number" class="h-10 w-96 border border-gray-200 rounded-xl p-3 pr-8 bg-gray-100 focus:bg-white focus:outline-none text-black" placeholder="Телефон">
                </div>
                <button class="bg-green-600 w-auto h-auto p-2 rounded text-white">Оформить Заказ</button>
            </div>
        </form>
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
            address: {},
            products: [],
            amount: 0,
            is_page1: true,
            is_page2: false,
            guid: localStorage.getItem('guid')
        }
    },
    created() {
        axios.get("/api/order/buyproduct/"+this.$route.params.hash+"?quantity=1&guid="+this.guid).then(res => {
            this.products = res.data.data
            this.amount = res.data.amount
            console.log(res.data)
        })
    },
    methods: {
        BuyProduct() {
            axios.post("/api/order/store?guid="+this.guid, {products: this.products, total_price: this.amount, fullname: this.address.fullname, phone_number: this.address.phone_number, city: this.address.city, street: this.address.street}).then(response => {
                router.replace({ path: '/successfully' })
            })
        },
        NextProduct(){
            this.is_page1=false
            this.is_page2=true
            router.push({ path: '#adress' })
        }
    }
}
</script>

<style scoped>

</style>
