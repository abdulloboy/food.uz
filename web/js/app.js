Vue.createApp({
    data() {
        return {
            found_foods: [],
            ingredients: []
        }
    },
    mounted() {
        this.found_foods=JSON.parse(this.$el.parentElement.getAttribute("found_foods"));
        this.ingredients=JSON.parse(this.$el.parentElement.getAttribute("ingredients"));
    }
}).mount('#app')