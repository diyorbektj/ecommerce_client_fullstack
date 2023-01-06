<template>
    <!--Register-->
    <main class="max-w-screen-xl mx-auto bg-white m-8 p-8 rounded-md">
        <div class="font-bold text-4xl m-4"><span class="text-green-600">AddProduct</span> page</div>
        <div class="flex justify-center items-center">
            <div class="w-full max-w-4xl">
                <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" @submit.prevent="AddProduct"  enctype="multipart/form-data">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-md font-bold mb-2" for="username">
                            Name Product
                        </label>
                        <input v-model="name" class="shadow shadow-green-200 appearance-none border rounded w-full h-12 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Name">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-md font-bold mb-2" for="username">
                            Description Product
                        </label>
                        <textarea v-model="description" class="w-full h-52 border border-gray-300 rounded focus:outline-none p-4"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-md font-bold mb-2" for="username">
                            Category Product
                        </label>
                        <select v-model="category" class="w-full h-12 bg-white rounded p-2 border border-gray-300 focus:outline-none">
                            <option v-for="category in categories" :key="category.id" value="1">{{category.name}}</option>

                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-md font-bold mb-2" for="username">
                            Image Product
                        </label>
                        <input @change="uploadImage" ref="image" type="file" class="shadow shadow-green-200 appearance-none border rounded w-full h-12 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="mb-4 mr-2">
                            <label class="block text-gray-700 text-md font-bold mb-2" for="username">
                                Quantity
                            </label>
                            <input v-model="quantity" class="shadow shadow-green-200 appearance-none border rounded w-full h-12 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" placeholder="Name">
                        </div>
                        <div class="mb-4 ml-2">
                            <label class="block text-gray-700 text-md font-bold mb-2" for="username">
                                Price
                            </label>
                            <input v-model="price" class="shadow shadow-green-200 appearance-none border rounded w-full h-12 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" placeholder="Price">
                        </div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="mb-4 mr-2">
                            <label class="block text-gray-700 text-md font-bold mb-2" for="username">
                                Memory Product
                            </label>
                            <input v-model="attribute[2].value" class="shadow shadow-green-200 appearance-none border rounded w-full h-12 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" placeholder="Memory">
                        </div>
                        <div class="mb-4 ml-2">
                            <label class="block text-gray-700 text-md font-bold mb-2" for="username">
                                Brand
                            </label>
                            <select v-model="brand" class="shadow shadow-green-200 appearance-none border rounded w-full h-12 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option v-for="brand in brands" :key="brand.id" :value="brand.id">{{brand.name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="mb-4 mr-2">
                            <label class="block text-gray-700 text-md font-bold mb-2" for="username">
                                Color Product
                            </label>
                            <select v-model="attribute[0].value" class="shadow shadow-green-200 appearance-none border rounded w-full h-12 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="Red">Red</option>
                                <option value="Blue">Blue</option>
                                <option value="Black">Black</option>
                                <option value="White">White</option>
                            </select>
                        </div>
                        <div class="mb-4 ml-2">
                            <label class="block text-gray-700 text-md font-bold mb-2" for="username">
                                OZU
                            </label>
                            <input v-model="attribute[1].value" class="shadow shadow-green-200 appearance-none border rounded w-full h-12 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" placeholder="OZU">
                        </div>
                    </div>
                    <div class="flex items-center justify-end">
                        <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-5 rounded focus:outline-none focus:shadow-outline" type="submit">
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



export default {
    name: "AddProduct",
    data() {
        return {

            name: null,
            description: null,
            category: null,
            images: [],
            quantity: null,
            price: null,
            brand: null,
            attribute: [
                {
                    value: '',
                    attribute_id: 1
                },
                {
                    value: '',
                    attribute_id: 2
                },
                {
                    value: '',
                    attribute_id: 3
                },
            ],
            categories: [],
            brands: [],
        }
    },
    mounted() {
        axios.get('/api/category')
            .then(response => {
                this.categories = response.data;
            })
            .catch(error => {
                console.log(error);
            });
        axios.get('/api/brands')
            .then(response => {
                this.brands = response.data;
            })
            .catch(error => {
                console.log(error);
            });
    },
    methods: {
        uploadImage(e) {
            this.images[0] = e.target.files[0];
           // alert("Ishlamadi!")
        },
        AddProduct() {

            const formData = new FormData();
            formData.append('name', this.name);
            formData.append('description', this.description);
            formData.append('category', this.category);
            formData.append('images[0]', this.images[0]);
            formData.append('quantity', this.quantity);
            formData.append('price', this.price);
            formData.append('brand', this.brand);
            formData.append('attribute', JSON.stringify(this.attribute));
            axios.post('/api/product/create', formData)
                .then(response => {
                    console.log(response);
                    alert("Product created success!!!")
                })
                .catch(error => {
                    console.log(error);
                });

        }
    },
    created() {

    }


}
</script>

<style scoped>

</style>
