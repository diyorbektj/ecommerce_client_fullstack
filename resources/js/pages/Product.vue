<template>
    <main class="max-width mx-auto bg-white w-full h-auto m-8 p-8 rounded-md">
        <div class="flex justify-between">
            <div class="font-bold text-3xl m-4"><span class="text-green-600">{{ product.category.name }}</span> {{product.name}}</div>
            <div class="m-4 text-green-600">
               <button @click="$store.dispatch('addFavorite', product)" form=""> <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 pr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg></button>
            </div>
        </div>
<div class="grid lg:grid-cols-2 md:grid-cols-1 max-w-4xl mx-auto pt-4">
    <div class="md:mr-8 lg:p-4"><img class="img-product" :src="product.image" :alt="product.name"></div>
        <div class="max-w-buttons" style="">
            <div class="font-bold text-xl lg:m-4">Смартфон {{product.name}}</div>
            <div>
                <div class="grid grid-cols-2 pl-4 pb-2 border-b border-gray-300">
                    <div class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="text-gray-400 px-[0.1rem] h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                    </svg> {{ product.view }}</div>
                    <div class="font-bold text-lg">{{product.price}} c.</div>
                </div>
                <!--table-->
                <div class="table-responsive m-4">
                    <table class="table table-striped table-sm">

                        <tbody>
                            <tr v-for="attribute in product.attributes" :key="attribute.id">
                                <td>{{attribute.attribute}}</td>
                                <td>{{attribute.value}}</td>
                            </tr>

                        </tbody>
                    </table>
            </div>
                </div>

                <div class="flex justify-center">
                    <div class="mx-0.5">
                        <button @click="$store.dispatch('addFavorite', product)" class="bg-green-200 text-green-600 w-[13rem] h-12 m-2 rounded-md" form="">
                            <p class="flex justify-center items-center font-bold"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 pr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    В корзину</p>
                        </button>
                    </div>
                    <div class="mx-0.5">
                        <button @click="BuyProduct(product.id)" class="bg-green-600 text-green-600 w-[13rem] h-12 m-2 rounded-md" form="">
                            <p class="flex justify-center items-center font-bold text-white"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 pr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                                Купить</p>
                        </button>
                    </div>
                </div>
            </div>
    </div>

    </main>
    <div class="lg:max-w-screen-xl mx-auto my-8">
        <div class="xl:flex xl:justify-between">
            <div class="bg-white sm:w-[30rem] lg:w-[25rem] h-auto rounded p-4">
                <h1 class="text-2xl font-bold">Comments</h1>
                <div class="my-4">
                    <div v-if="loggined" class="">
                        <textarea v-model="text" class="w-full h-32 border border-gray-300 rounded-md p-2 placeholder:text-gray-400 focus:outline-none" placeholder="Comment..."></textarea>
                        <div class="flex justify-end">
                            <button @click.prevent="AddComment" class="bg-green-600 text-white p-2 rounded-md" form="">Send</button>
                        </div>
                    </div>
                    <div class="bg-gray-300 w-full h-px my-4"></div>
                    <div v-for="comment in orderedComments">
                        <div class="flex justify-between">
                            <div class="flex items-center">
                                <img class="h-8 w-8 rounded-full" :src="comment.user.avatar_url" alt="">
                                <div class="ml-2">
                                    <div class="font-bold">{{ comment.user.first_name + ' ' + comment.user.last_name }}</div>
                                    <div class="text-gray-600">{{ comment.created_at }}</div>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <button v-if="loggined" @click.prevent="LikeToComment(comment.id)" class="text-gray-600 flex items-center" form="">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                    ({{ comment.like_count }})</button>
                                <button v-else-if="loggined === false" class="text-gray-600 flex items-center" form="">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                    ({{ comment.like_count }})</button>
                                <div v-if="loggined" class="text-gray-600 ml-2">Reply</div>
                            </div>
                        </div>
                        <div class="text-gray-800">
                            <p>{{comment.comment}}</p>
                        </div>
                        <div class="bg-gray-300 w-full h-px my-3"></div>
                    </div>
                    <div class="text-center text-green-600"><router-link to="/">All Comments</router-link></div>
                </div>
            </div>
            <div class="bg-white sm:w-auto lg:w-[53rem] h-auto rounded-md sm:mt-4">
                <h1 class="font-bold text-2xl p-4">Rand Products</h1>
                <div class="grid xl:grid-cols-3 lg:grid-cols-3 sm:grid-cols-2 md:grid-cols-2 flex justify-center px-6">

                    <div v-for="(product, index) in products" :key="index" class="mx-2 w-[15rem] py-4 h-auto rounded-xl shadow-2xl shadow-green-400 hover:shadow-xl hover:shadow-green-300 my-8">
                        <router-link :to="'/product/' + product.id">
                            <div class="flex justify-center my-2">
                                <img class="w-32 h-auto" :src="product.image">
                            </div>
                            <div>
                                <div class="text-md font-bold px-5 flex justify-between">
                                    <div></div>
                                    <div>{{product.price}} c.</div>
                                </div>
                                <div class="h-32">
                                    <p class="text-center px-2">{{product.category.name}} {{product.name}}</p>
                                </div>
                                <div class="flex justify-center m-2 px-4">
                                    <div class="">
                                        <button class="bg-green-200 text-green-600 w-[13rem] h-12 m-2 rounded-md">
                                            <p class="flex justify-center items-center font-bold"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 pr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                                Купить
                                            </p>
                                        </button>

                                        <button class="bg-green-600 text-white w-[13rem] h-12 m-2 rounded-md">
                                            <p class="flex justify-center items-center font-bold"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 pr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                                В избранное
                                            </p>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ProductList from "../components/ProductList.vue";
import axios from "axios";
import CryptoJS from "crypto-js"
import router from "../router";

export default {
    name: "GetProduct",
    components:{
        ProductList
    },
    computed: {
        orderedComments: function () {
            return _.orderBy(this.comments, 'created_at', 'desc').slice(0,13)
        },

    },
    data() {
        return {
            product: {},
            products: [],
            comments: [],
            text: "",
            loggined: false,
            quantity: 1,
            guid: localStorage.getItem('guid')
        }
    },
    created() {
        axios.get("/api/auth/logined").then(res => {
            this.loggined = res.data.message
        })
        axios.get('/api/product/' + this.$route.params.id + '?guid='+this.guid)
            .then(response => {
                this.product = response.data.data;
                console.log(CryptoJS.MD5(this.product.name).toString())
            })
            .catch(error => {
                console.log(error);
            });
        axios.get('/api/product?guid='+this.guid).then(response =>{
                this.products = response.data.data.slice(0,9);
            }).catch(error =>{
                console.log(error)
            })
        axios.get('/api/comments/get/' + this.$route.params.id+'?guid='+this.guid).then(response =>{
            this.comments = response.data.data;
        }).catch(error =>{
            console.log(error)
        })
    },
    methods: {
        BuyProduct(id) {
            axios.get("/api/order/buyproduct/" + CryptoJS.MD5(id) + '?guid='+this.guid).then(res => {
                this.$store.dispatch('INCREMENT_QUANTITY', this.quantity)
                router.push(`/buyproduct/${CryptoJS.MD5(this.$route.params.id)}`)
            })
        },
        AddComment()
        {
            axios.post('/api/comments/add/' + this.$route.params.id + '?guid='+this.guid, {text: this.text})
                .then(response =>{
                this.comments.push(response.data.data);
                this.text = ""
                console.log(response.data)
            }).catch(error =>{
                console.log(error)
            })
        },
        LikeToComment(id)
        {
            axios.post('/api/comments/like/'+id + '?guid='+this.guid).then(response => {
                alert("Liked")
            }).catch(error =>{
                console.log(error)
            })
        },
    }
}
</script>

<style scoped>
tr{
    border-bottom: 1px solid #e0e0e0;
    font-size: 18px;
}
tr,td{
    padding: 0.65rem;
}
@media screen and (max-width: 1024px) {
    .img-product{
        width: 200px;
    }
    .max-width{
    width: 450px;
    }
    .max-w-buttons{
        max-width: 400px;
    }
}
@media screen and (min-width: 1024px) {
    .img-product{
        width: 300px;
    }
    .max-width{
        width: 1240px;
    }
}
</style>
