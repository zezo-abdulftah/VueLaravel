<template>
    <div>
        <product-form-component @product-created="fetchProducts"></product-form-component>
        <product-list-component ref="productList"></product-list-component>
    </div>
</template>

<script>
import ProductFormComponent from "./ProductFormComponent.vue";
import ProductListComponent from "./ProductListComponent.vue";

export default {
    components: {
        ProductFormComponent,
        ProductListComponent
    },
    methods: {
        fetchProducts() {
            // Call the fetchProducts method in the product list component
            this.$refs.productList.fetchProducts();
        },
    },
};
</script>

<style scoped>
/* Add any necessary styles here */
</style>
