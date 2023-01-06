<template>
<!--Register-->
<main class="max-w-screen-xl mx-auto bg-white m-8 p-8 rounded-md">
    <div class="font-bold text-4xl m-4"><span class="text-green-600">Register</span> page</div>
    <div class="flex justify-center items-center">
        <div class="w-full max-w-xl">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" @submit.prevent="register">
                <div class="mb-4">
                    <label class="block text-gray-700 text-md font-bold mb-2" for="username">
                        Login
                    </label>
                    <input class="shadow shadow-green-200 appearance-none border rounded w-full h-12 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Login" v-model="login">
                </div>
                <div class="grid grid-cols-2">
                    <div class="mb-4 mr-2">
                        <label class="block text-gray-700 text-md font-bold mb-2" for="username">
                            First name
                        </label>
                        <input v-model="first_name" class="shadow shadow-green-200 appearance-none border rounded w-full h-12 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="First name...">

                    </div>
                    <div class="mb-4 ml-2">
                        <label class="block text-gray-700 text-md font-bold mb-2" for="username">
                            Last name
                        </label>
                        <input v-model="last_name" class="shadow shadow-green-200 appearance-none border rounded w-full h-12 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Last name...">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-md font-bold mb-2" for="username">
                        Email
                    </label>
                    <input class="shadow shadow-green-200 appearance-none border rounded w-full h-12 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="email" placeholder="Email" v-model="email">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-md font-bold mb-2" for="password">
                        Password
                    </label>
                    <input class="shadow appearance-none border border-red-500 rounded w-full h-12 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" type="password" placeholder="******************" v-model="password">
                    <p class="text-red-500 text-xs italic">Please choose a password.</p>
                </div>
                <div class="flex items-center justify-end">
                    <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-5 rounded focus:outline-none focus:shadow-outline" type="button" @click.prevent="register">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
</template>

<script>
import axios from "axios";
import router from "../router";

export default {
    name: "Register",
    data() {
        return {
            login: "",
            first_name: "",
            last_name: "",
            email: "",
            password: "",
        }
    },
    methods: {
        register() {
            axios.post("/api/auth/register", {
                login: this.login,
                first_name: this.first_name,
                last_name: this.last_name,
                email: this.email,
                password: this.password,
            }).then(res => {
                router.push('/login')
            }).catch(err => {
                console.log(err);
            });
        }
    },
    created() {

    }


}
</script>

<style scoped>

</style>
