<template>
    <main class="max-w-screen-xl mx-auto bg-white h-auto m-8 p-8 rounded-md">
        <div class="flex justify-end">
            <button class="bg-gray-200 w-auto h-auto px-2 py-1 rounded" form="">Edit</button>
            <button class="bg-red-500 text-white w-auto h-auto px-2 py-1 rounded mx-2" form="">Ban</button>
        </div>
        <div class="bg-gray-200 w-full h-px my-4"></div>
        <div class="flex justify-between">
            <div class="flex items-center">
                <div><img class="w-44 h-44" :src="user.avatar_url"></div>
                <div class="mx-4">
                    <p class="">First name: {{ user.first_name }}</p>
                    <p class="">Last name: {{ user.last_name }}</p>
                    <p class="">Email: {{ user.email }}</p>
                </div>
            </div>
            <div class="bg-gray-200 w-96 rounded p-4">
                <ul>
                    <li>Country: {{address.country}}</li>
                    <li>Region: {{address.region}}</li>
                    <li>City: {{ address.city}}</li>
                    <li>Phone: {{address.phone_number}}</li>
                    <li>Postcode: {{address.postcode}}</li>
                    <li>Street: {{address.street}}</li>
                </ul>
            </div>
        </div>
    </main>
</template>

<script>
export default {
    name: "Profile",
    data(){
        return{
            user: {},
            address: {},
            token: localStorage.getItem('token')
        }
    },
    created() {
        window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
        axios.get('/sanctum/csrf-cookie').then(response => {
            axios.get('/api/users/profile')
                .then(response => {
                    this.user = response.data.data;
                    this.logined = response.data.logined
                });
        })
        axios.get('/api/addresses/get')
            .then(response => {
                this.address = response.data.data;
            });
    }
}
</script>

<style scoped>
ul, li{
    padding: 2px;
}
</style>
