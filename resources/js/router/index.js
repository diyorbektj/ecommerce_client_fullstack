import {createWebHistory, createRouter} from "vue-router";
import Home from "../components/Home.vue";
import Login from "../pages/Login.vue";
import Register from "../pages/Register.vue";
import Category from "../pages/Category.vue";
import Product from "../pages/Product.vue";
import AddProduct from "../pages/AddProduct.vue";
import Favorites from "../pages/Favorites.vue";
import Basket from "../pages/Basket.vue";
import BuyProduct from "../pages/BuyProduct.vue";
import Successfully from "../pages/Successfully.vue";
import Profile from "../pages/users/Profile.vue";
import Orders from "../pages/users/Orders.vue";
import UpdateProfile from "../pages/users/UpdateProfile.vue";

function loggedIn(to, from, next){
    window.axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`
    axios.get("/api/auth/logined").then(res => {
        if (res.data.message === true){
            return next()
        }else{
            router.push("/")
        }
    })
}
function Nologged(to, from, next){
    window.axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`
    axios.get("/api/auth/logined").then(res => {
        if (res.data.message === true){
            router.push("/")
            console.log(res.data)
        }
        return next()
    })
}

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home,
    },
    {
        name: 'login',
        path: '/login',
        component: Login,
        beforeEnter: [Nologged]
    },
    {
        name: 'register',
        path: '/register',
        component: Register,
        beforeEnter: [Nologged]
    },
    {
        name: 'category',
        path: '/category/:id',
        component: Category,
    },
    {
        name: 'getproduct',
        path: '/product/:id',
        component: Product,
    },
    {
        name: 'addproduct',
        path: '/addproduct',
        component: AddProduct,
    },
    {
        name: 'myfavorites',
        path: '/myfavorites',
        component: Favorites,
        // beforeEnter: [loggedIn]
    },
    {
        name: 'mybasket',
        path: '/mybasket',
        component: Basket
    },
    {
        name: 'buyproduct',
        path: '/buyproduct/:hash',
        component: BuyProduct
    },
    {
        name: 'successfully',
        path: '/successfully',
        component: Successfully
    },
    {
        name: 'user.profile',
        path: '/users/profile',
        component: Profile
    },
    {
        name: 'user.orders',
        path: '/users/orders',
        component: Orders
    },
    {
        name: 'user.updateprofile',
        path: '/users/update',
        component: UpdateProfile
    }

];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
