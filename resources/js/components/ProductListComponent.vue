<template>
    <div>
        <h2>Product List</h2>

        <!-- Search and Filter Inputs -->
        <div class="filters">
            <input
                type="text"
                v-model="filters.search"
                placeholder="Search by name"
                @input="fetchProducts"
            />
            <input
                type="number"
                v-model="filters.min_price"
                placeholder="Min price"
                @input="fetchProducts"
            />
            <input
                type="number"
                v-model="filters.max_price"
                placeholder="Max price"
                @input="fetchProducts"
            />
        </div>

        <!-- Product Table -->
        <table>
            <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            <tr v-if="products.data.length > 0"  v-for="product in products.data" :key="product.id">
                <td>{{ product.name }}</td>
                <td>{{ product.price }}</td>
                <td>{{ product.description }}</td>
            </tr>
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="pagination">
            <button @click="fetchProducts(products.prev_page_url)" :disabled="!products.prev_page_url">Previous</button>
            <button @click="fetchProducts(products.next_page_url)" :disabled="!products.next_page_url">Next</button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            products: {
                data: [], // Initialize with an empty array for products
                current_page: 1,
                last_page: 1,
                prev_page_url: null,
                next_page_url: null,
            },
            filters: {
                search: '',
                min_price: '',
                max_price: '',
            },
        };
    },
    created() {
        this.fetchProducts();
    },
    methods: {
        async fetchProducts(url = '/api/products') {
            try {
                // Ensure the URL is a string
                if (typeof url !== 'string') {
                    url = '/api/products';
                }

                // Build the params object
                const params = {
                    search: this.filters.search || undefined,
                    min_price: this.filters.min_price || undefined,
                    max_price: this.filters.max_price || undefined,
                };

                // Remove undefined or empty params
                Object.keys(params).forEach(key => {
                    if (params[key] === undefined || params[key] === '') {
                        delete params[key];
                    }
                });

                // Make the API request
                const response = await axios.get(url, { params });
                this.products = response.data;
            } catch (error) {
                console.error('Error fetching products:', error);
                console.error('Error details:', error.response || error.message);
            }
        }
    },
};
</script>

<style scoped>
.filters {
    margin-bottom: 20px;
}
.filters input {
    margin-right: 10px;
    padding: 5px;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}
th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}
th {
    background-color: #f4f4f4;
}
.pagination {
    margin-top: 20px;
}
button {
    margin: 0 5px;
}
</style>
