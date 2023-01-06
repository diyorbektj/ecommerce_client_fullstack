export const getters = {
    cartProducts(state) {
        return state.baskets.length;
    },
    favoriteUser(state) {
        return state.favorites.length;
    },
    CartItems: state => state.baskets,
    CartFavorites: state=> state.favorites,
    getTotalPrice: state => {
        let total = 0;
        state.baskets.forEach(item => {
            total += item.price * item.quantity;
        });
        return total;
    }
};
