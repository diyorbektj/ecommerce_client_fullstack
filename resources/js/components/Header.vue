<template>
    <header class="bg-green-600 text-white w-full h-auto sticky top-0 z-10">
        <div class="flex justify-between max-w-screen-xl mx-auto text-[1.10rem]">
            <div class="flex items-center">
                <router-link class="font-bold text-2xl py-3" to="/">Ecommerce</router-link>
                <button class="bg-white flex items-center  text-green-600 p-1 ml-6 rounded" form="">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" />
                    </svg>
                    <p>Каталог</p>
                </button>
            </div>

            <div class="flex items-center py-1">
                <div class="search">
                    <div class="mx-4 relative py-2.5">
                        <input type="text" v-model="keyword" class="h-10 w-72 border border-gray-200 rounded-xl p-3 pr-8 bg-gray-100 focus:bg-white focus:outline-none text-black" placeholder="Search..">
                        <button form="">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 absolute top-[16px] right-[0.7rem]" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div v-if='products.length > 0 && keyword !==""' class="absolute top-[3.3rem] bg-white text-black w-72 h-auto p-4 rounded shadow-2xl">

                            <div v-for="product in products" :key="product.id">

                                <router-link class="bg-white hover:bg-gray-300 hover:w-full hover h-auto" :to="`/product/`+product.id">
                                    <div class="flex text-sm border-b border-gray-300 py-3">
                                        <img class="w-12 h-12" :src="product.image" :alt="product.name">
                                        <p class="px-2">{{product.name}}</p>
                                    </div>
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
                <router-link to="/myfavorites">
                    <div class="mx-4 relative"><svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                        <div v-if="favoriteUser > 0" class="absolute top-[-6px] right-[-6px] bg-red-500 min-w-[1.25rem] h-5 flex justify-center items-center rounded-full p-1">{{favoriteUser}}</div>
                    </div>
                </router-link>

                <router-link to="/mybasket">
                    <div class="ml-3 mr-5 relative"><svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                        <div v-if="cartProducts > 0" class="absolute top-[-8px] right-[-6px] bg-red-500 min-w-[1.25rem] h-5 flex justify-center items-center rounded-full p-1">{{ cartProducts }}</div>
                    </div>
                </router-link>


                <div class="text-md">
                    <button v-if="logined" @mouseover="profile = true" @mouseleave="profile = false" form=""><img class="w-8 h-8" :src="user.avatar_url" :alt="user.name">
                        <ul v-if="profile && user" @click="profile = false" class="z-10 absolute top-[3.4rem] right-7 bg-white text-gray-600 text-md p-1.5 rounded-md text-black w-44 h-auto shadow shadow-2xl">
                            <li class="flex p-1.5 border-b border-gray-300 py-2">
                                <p><img class="w-" :src="user.avatar_url" :alt="user.name"></p>
                                <span class="text-sm">{{user.first_name}} {{user.last_name}}</span>
                            </li>
                            <router-link to="/users/profile" class="p-1.5">
                                <span class="px-2">View Profile</span>
                            </router-link>
                            <li v-if="user.role > 1" class="p-1.5 text-red-500" >Admin Page</li>
                            <li class="p-1.5" ><router-link to="/users/orders">My orders</router-link></li>
                            <li class="p-1.5"><router-link to="/myfavorites">My favorites</router-link></li>
                            <li class="p-1.5" >Settings</li>
                            <button @click="logout" class="p-1.5" form="">Logout</button>

                        </ul>
                    </button>
                    <!--Guest--->
                    <button v-if="!logined" class="text-md"><router-link to="/login">Login</router-link></button>


                </div>
            </div>

        </div>
        <div class="search-lg flex justify-between px-1">
            <div class="mx-1 relative py-2.5">
                <input type="text" v-model="keyword" class="h-10 w-[20rem] border border-gray-200 rounded-xl p-3 pr-8 bg-gray-100 focus:bg-white focus:outline-none text-black" placeholder="Search..">
                <button form="">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 absolute top-[16px] right-[0.7rem]" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div v-if='products.length > 0 && keyword !==""' class="absolute top-[3.3rem] bg-white text-black w-72 h-auto p-4 rounded shadow-2xl">

                    <div v-for="product in products" :key="product.id">

                        <router-link class="bg-white hover:bg-gray-300 hover:w-full hover h-auto" :to="`/product/`+product.id">
                            <div class="flex text-sm border-b border-gray-300 py-3">
                                <img class="w-12 h-12" :src="product.image" :alt="product.name">
                                <p class="px-2">{{product.name}} test</p>
                            </div>
                        </router-link>
                    </div>

                </div>
            </div>
        </div>
    </header>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: "Header",
    computed: {
        ...mapGetters(['cartProducts', 'CartItems','getTotalPrice', 'favoriteUser']),
    },
    data(){
        return{
            keyword: null,
            products: [],
            profile: false,
            categories: [],
            user: [],
            logined: false,
            token: localStorage.getItem('token'),
            guid: localStorage.getItem('guid')
        }
    },
    mounted() {
        window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
        axios.get('/sanctum/csrf-cookie').then(response => {
            axios.get('/api/users/profile?guid='+this.guid)
                .then(response => {
                    this.user = response.data.data;
                    this.logined = response.data.logined
                });
        })
        axios.get('/api/category?guid='+this.guid)
            .then(response => {
                this.categories = response.data;
            })
    },
    watch:{
        keyword(after, before) {
            this.Search();
        }
    },
    methods:{
        logout(){
            axios.get('/api/auth/logout?guid='+this.guid).then(response => {
                localStorage.removeItem('token')
                this.$router.go(0)
                this.modal = false
            })
        },
        Search(){
            axios.get("/api/product/search?guid="+this.guid, { params: { search: this.keyword }})
                .then(response => {
                    this.products = response.data.data
                });
        }
    }
}
</script>

<style scoped>
.search{
}
header{
}
.search-lg{

}
@media screen and (max-width: 1024px) {
    .search,p{
        position: absolute;
        top: -123132px;
    }
    header{
        padding-left: 6px;
        padding-right: 6px;
    }
}
@media screen and (min-width: 1024px) {
    .search-lg{
        position: absolute;
        top: -123132px;
    }
}

</style>
