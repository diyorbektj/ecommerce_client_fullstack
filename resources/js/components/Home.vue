<template>
<main class="max-w-screen-xl mx-auto bg-white h-auto m-8 p-8 rounded-md">
    <div class="flex justify-between">
        <div v-if="filter===false" class="font-bold text-4xl m-4"><span class="text-green-600">Home</span> page</div>
        <div v-if="filter===true" class="font-bold text-4xl m-4"><span class="text-green-600">Filter</span> page</div>
        <button @click="filter=true" v-if="filter===false" class="flex items-center text-xl text-green-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
            Filter
        </button>
        <button @click="filter=false" v-if="filter===true" class="flex items-center text-xl text-green-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
            </svg>
            Filter
        </button>
    </div>
    <Transition name="slide-fade">
    <div v-if="filter" class="w-full h-auto m-4 shadow-xl shadow-green-200 p-6">
    <div>
        <ul class="grid xl:grid-cols-4 md:grid-cols-1">
            <li>
                <label class="text-xl font-bold">Цена:</label>
                <div class="max-w-[20rem]">
                    <input type="number" v-model="min" class="focus:outline-none border border-gray-300 h-10 rounded-xl px-2 my-2.5" placeholder="От:">
                    <input type="number" v-model="max" class="focus:outline-none border border-gray-300 h-10 rounded-xl px-2 my-2.5" placeholder="До:">
                </div>
            </li>
            <li>
                <label class="text-xl font-bold">Сортировка:</label>
                <div class="text-xl">
                    <p class="py-1.5"><input v-model="order_type" value="new" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="radio" name="order_by"> Новые</p>
                    <p class="py-1.5"><input v-model="order_type" value="old" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="radio" name="order_by"> Старые</p>
                    <p class="py-1.5"><input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="radio" name="order_by"> По рейтингу</p>
                </div>
            </li>
            <li>
                <label class="text-xl font-bold">Цветы:</label>
                <div class="text-xl">
                    <p class="py-1.5"><input type="checkbox" v-model="color" value="Black" name="black" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"> Black</p>
                    <p class="py-1.5"><input type="checkbox" v-model="color" value="White" name="white" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"> White</p>
                    <p class="py-1.5"><input type="checkbox" v-model="color" value="Blue" name="blue" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"> Blue</p>
                    <p class="py-1.5"><input type="checkbox" v-model="color" value="Red" name="blue" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"> Red</p>
                </div>
            </li>
            <li>
                <label class="text-xl font-bold">Категория:</label>
                <div class="text-xl">
                    <p class="py-1.5"><input v-model="category" value="all" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="radio" name="category"> Все категории</p>
                    <p class="py-1.5"><input v-model="category" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="radio" name="category"> Телефон</p>
                    <p class="py-1.5"><input v-model="category" value="2"  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="radio" name="category"> Компютер</p>
                    <p class="py-1.5"><input v-model="category" value="3" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="radio" name="category"> Наушники</p>
                </div>
            </li>
        </ul>
    </div>

    </div>
    </Transition>
    <ProductList :products="products" />

</main>
</template>

<script>
import ProductList from "./ProductList.vue";
import axios from "axios";

export default {
    name: "Home",
    components:{
        ProductList
    },
    data() {
        return {
            order_type: null,
            min: null,
            max: null,
            color: [],
            category: null,
            products: [],
            filter: false,
            guid: localStorage.getItem('guid')
        }
    },
    created() {
        axios.get('/api/product?guid='+this.guid)
            .then(response => {
                this.products = response.data.data;
            })
            .catch(error => {
                console.log(error);
            })
    },
    watch:{
        order_type: function (val){
            this.filterProducts();
        },
        min: function(val){
            this.filterProducts();
        },
        max: function(val){
            this.filterProducts();
        },
        color: function(val){
            this.filterProducts();
        },
        category: function(val){
            this.filterProducts();
        }
    },
    methods:{
        filterProducts() {
            axios.get('/api/product/filter?guid='+this.guid, {params: {order_type: this.order_type, price_min: this.min, price_max: this.max, color: this.color, category_id: this.category}})
                .then(res => this.products = res.data.data)
                .catch(error => {
                    console.log(error)
                });
        }
    }
}
</script>

<style scoped>
.slide-fade-enter-active {
    transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
    transition: all 0.3s ease-out;
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateT(20px);
    opacity: 0;
}

</style>
