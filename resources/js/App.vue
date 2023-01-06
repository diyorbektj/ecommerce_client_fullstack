<template>
    <!---Header-->
    <Header />
<!---Header-->


    <!--Menu-->

       <router-view />

    <!---Menu-->

    <!---Footer-->
   <Footer />
    <!--Footer-->

    <transition name="fade">
        <button id="pagetop" class="fixed right-12 bottom-12 bg-green-200 w-16 h-16 flex justify-center items-center rounded-full" v-show="scY > 300" @click="toTop">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-10" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
        </button>
    </transition>
</template>

<script>

import Header from './components/Header.vue'
import Footer from "./components/Footer.vue";
import axios from "axios";

export default {
    components:{
        Footer,
        Header
    },
    data() {
        return {
            scTimer: 0,
            scY: 0,
        }
    },
    created() {
        this.$store.dispatch("GET_FAVORITES");
        this.$store.dispatch("GET_BASKETS");
    },
    mounted() {
        window.addEventListener('scroll', this.handleScroll);
        if (!localStorage.getItem('guid')){
            axios.get('/api/generate-guid').then(response => {
                localStorage.setItem('guid', response.data.guid)
            }).catch(error => {
                console.log(error)
            })
        }
    },
    methods: {
        handleScroll: function () {
            if (this.scTimer) return;
            this.scTimer = setTimeout(() => {
                this.scY = window.scrollY;
                clearTimeout(this.scTimer);
                this.scTimer = 0;
            }, 100);
        },
        toTop: function () {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        },
    }
}
</script>

<style scoped>
li{
    padding-bottom: 4px;
    padding-top: 4px;
}
.v-enter-active,
.v-leave-active {
    transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>
