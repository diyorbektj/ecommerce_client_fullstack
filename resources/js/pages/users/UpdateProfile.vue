<template>
    <main class="max-w-screen-xl mx-auto bg-white h-auto m-8 p-8 rounded-md">
        <div class="grid grid-cols-2">
            <div class="flex justify-center">
                <img class="w-44 h-44" :src="user.avatar_url" :alt="user.last_name">
<!--                <button form=""><input class="outline" type="file">Edit</button>-->
            </div>
            <div>
                <div class="m-4">
                    <label class="font-bold">Login:</label>
                    <div>
                        <input class="w-96 h-10 border border-gray-300 rounded p-2" type="text" :value="user.login">
                    </div>
                </div>
                <div class="m-4">
                    <label class="font-bold">Last name:</label>
                   <div>
                       <input class="w-96 h-10 border border-gray-300 rounded p-2" type="text" :value="user.last_name">
                   </div>
                </div>
                <div class="m-4">
                    <label class="font-bold">First name:</label>
                    <div>
                        <input class="w-96 h-10 border border-gray-300 rounded p-2" type="text" :value="user.first_name">
                    </div>
                </div>
                <div class="m-4">
                    <label class="font-bold">Email:</label>
                    <div>
                        <input class="w-96 h-10 border border-gray-300 rounded p-2" type="text" :value="user.email">
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-end">
            <button class="bg-green-600 w-auto h-auto p-2 rounded text-white" form="">Submit</button>
        </div>
    </main>
</template>

<script>
export default {
    name: "UpdateProfile",
    data(){
        return{
            token: localStorage.getItem("token"),
            user: {},
        }
    },
    created() {
        window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
        axios.get('/sanctum/csrf-cookie').then(response => {
            axios.get('/api/users/profile')
                .then(response => {
                    this.user = response.data.data;
                });
        })
    }
}
</script>

<style scoped>

</style>
