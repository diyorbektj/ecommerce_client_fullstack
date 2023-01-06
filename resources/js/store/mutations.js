import axios from "axios";

export const mutations = {
    INCREMENT_BASKET_ITEM: function (state, payload) {
        let productInCart = state.baskets.find(item => item.id === payload.id);
        if(productInCart){
            productInCart.quantity += 1;
            return;
        }
        state.baskets.push(payload)
    },
    DECREMENT_BASKET_ITEM: function (state, payload) {
        let productInCart = state.baskets.find(item => item.id === payload.id);
        if(productInCart.quantity === 1){
            state.baskets = state.baskets.filter(item => {
                axios.delete("/api/basket/delete", {params: {id: payload.id}});
                return item.id !== payload.id
            });
        }
        if(productInCart){
            productInCart.quantity -= 1;
            return;
        }
        state.baskets = payload
    },
    DELETE_BASKET_ITEM: function (state, payload) {
        state.baskets = state.baskets.filter(item => {
            axios.delete("/api/basket/delete", {params: {id: payload.id}});
            return item.id !== payload.id
        });
    },
    UPDATE_FAVORITE_ITEM: function (state, payload) {
        let productInCart = state.favorites.find(item => item.id === payload.id);
        if(productInCart){
            productInCart.quantity += 1;
            return;
        }
        state.favorites.push(payload)
    },
    SET_FAVORITES: function (state, payload) {
        state.favorites = payload;
    },
    SET_BASKETS: function (state, payload) {
        state.baskets = payload;
    },
    INCREMENT_QUANTITY: function (state, payload) {
        state.quantity = payload;
    },
    CLEAR_FAVORITE: function (state, payload) {
        state.favorites = [];
    },
    CLEAR_BASKET: function (state) {
        state.baskets = [];
    }
};
