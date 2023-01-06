<template>
    <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-2 flex justify-center px-6">

        <div v-for="(product, index) in products" :key="index" class="mx-2 w-[17rem] py-4 h-[27rem] rounded-xl shadow-2xl shadow-green-400 hover:shadow-xl hover:shadow-green-300 my-8">
            <router-link :to="'/product/' + product.id">
                <div class="flex justify-center my-2">
                    <img class="w-32 h-[10rem]" :src="product.image">
                </div>
            </router-link>
                <div>
                    <div class="text-md font-bold px-5 flex justify-between">
                        <div></div>
                        <div>{{product.price}} c.</div>
                    </div>
                    <p class="text-center px-2">{{product.category.name}} {{product.name}}</p>
                    <div class="flex justify-center items-center m-2 px-4">
                        <div class="">
                            <button @click="$store.dispatch('addToBasket', product)" class="bg-green-200 text-green-600 w-[15rem] h-12 m-2 rounded-md">
                                <p class="flex justify-center items-center font-bold"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 pr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                    Купить
                                </p>
                            </button>

                            <button @click="$store.dispatch('addFavorite', product)" class="bg-green-600 text-white w-[15rem] h-12 m-2 rounded-md" form="">
                                <p class="flex justify-center items-center font-bold"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 pr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                    В избранное
                                </p>
                            </button>
                        </div>

                    </div>
                </div>

        </div>
    </div>
</template>

<script>

export default {
    name: "ProductList",
    props: {
        products: {
            type: Array,
            required: true
        }
    },
    data() {
        return {

            test: 0,
        }
    },

}
</script>

<style scoped>

</style>
