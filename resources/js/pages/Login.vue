<template>
<main class="max-w-screen-xl mx-auto bg-white m-8 p-8 rounded-md">
    <div class="font-bold text-4xl m-4"><span class="text-green-600">Login</span> page</div>
    <div class="flex justify-center items-center">
        <div class="w-full max-w-xl">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" @submit.prevent="login">
                <div class="mb-4">
                    <label class="block text-gray-700 text-md font-bold mb-2" for="username">
                        Email
                    </label>
                    <input class="shadow shadow-green-200 appearance-none border rounded w-full h-12 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="email" placeholder="Username" v-model="email">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-md font-bold mb-2" for="password">
                        Password
                    </label>
                    <input class="shadow appearance-none bg-green-100 border border-red-500 rounded w-full h-12 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************" v-model="password">
                    <p class="text-red-500 text-xs italic">Please choose a password.</p>
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-5 rounded focus:outline-none focus:shadow-outline" type="button" @click.prevent="login">
                        Sign In
                    </button>
                    <a class="inline-block align-baseline font-bold text-md text-green-600 hover:text-blue-800" href="#">
                        Forgot password?
                    </a>
                </div>
            </form>
        </div>
    </div>
</main>
</template>

<script>
import router from "../router";
import axios from "axios";

export default {
    name: "Login",
    data() {
        return {
            email: "",
            password: "",
            guid: localStorage.getItem('guid')
        }
    },
    methods: {
        login() {
            axios.post("/api/auth/login?guid="+this.guid, {
                email: this.email,
                password: this.password,
            }).then(response => {
                localStorage.setItem('token', response.data.token)
                this.$router.go('/')
            }).catch(err => {
                console.log(err);
            });
        }
    }
}
</script>

<style scoped>

</style>
