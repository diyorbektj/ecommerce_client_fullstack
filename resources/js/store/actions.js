import axios from "axios";

const actions = {
    GET_FAVORITES: function ( {commit} ) {
        axios.get('/sanctum/csrf-cookie').then(response => {
            window.axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
            axios.get('/api/favorite/get/1').then(response => {
                commit('SET_FAVORITES', response.data);
            })
        })
    },
    GET_BASKETS: function ( {commit} ) {
        axios.get('/sanctum/csrf-cookie').then(response => {
            window.axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
            axios.get('/api/basket/get').then(response => {
                commit('SET_BASKETS', response.data);
            })
        })
    },
    addToBasket({ commit }, product) {
        axios.get(`/api/basket/create`, {params: {id: product.id}})
            .then(response => {
                commit('INCREMENT_BASKET_ITEM', response.data)
            })
            .catch(error => {
                console.log(error);
            })
    },
    addFavorite({ commit }, product) {
        axios.get('/sanctum/csrf-cookie').then(response => {
            axios.get(`/api/favorite/create`, {params: {product_id: product.id}})
                .then(response => {
                    commit('UPDATE_FAVORITE_ITEM', response.data)
                })
                .catch(error => {
                    console.log(error);
                })
        })
    },
    RemoveMyFavorite({ commit }, product) {
        window.axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`
        axios.delete(`/api/favorite/clean_favorite` )
            .then(response => {
                commit("CLEAR_FAVORITE", product)
            })
            .catch(error => {
                console.log(error);
            })
    },
    RemoveMyBasket({ commit }) {
        window.axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`
         axios.delete(`/api/basket/clean_basket` )
             .then(response => {
                commit("CLEAR_BASKET")
             })
             .catch(error => {
                 console.log(error);
             })
    },
    INCREMENT_PRODUCT({ commit }, product) {
        axios.get('/sanctum/csrf-cookie').then(response => {
            window.axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`
            axios.get(`/api/basket/create`, {params: {id: product.product_id}})
                .then(response => {
                    commit('INCREMENT_BASKET_ITEM', product)
                })
                .catch(error => {
                    console.log(error);
                })
        })
    },
    DECREMENT_PRODUCT({ commit }, product) {
        axios.get('/sanctum/csrf-cookie').then(response => {
            window.axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`
            axios.get(`/api/basket/decrement`, {params: {id: product.id}})
                .then(response => {
                    commit('DECREMENT_BASKET_ITEM', product)
                })
                .catch(error => {
                    console.log(error);
                })
        })
    },
    REMOVE_PRODUCT({ commit }, product) {
        axios.get('/sanctum/csrf-cookie').then(response => {
            window.axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`
            axios.get(`/api/basket/delete`, {params: {id: product.id}})
                .then(response => {
                    commit('DELETE_BASKET_ITEM', product)
                })
                .catch(error => {
                    console.log(error);
                })
        })
    },
    INCREMENT_QUANTITY( {commit}, quantity){
        commit("INCREMENT_QUANTITY", quantity)
    }
};

export default actions;
