<template>
    <div>
        <h2>Product Form</h2>
        <form @submit.prevent="submitForm">
            <div>
                <label for="name">Product Name:</label>
                <input type="text" id="name" v-model="form.name" required>
            </div>
            <div>
                <label for="price">Price:</label>
                <input type="number" id="price" v-model="form.price" required>
            </div>
            <div>
                <label for="description">Description:</label>
                <textarea id="description" v-model="form.description" required></textarea>
            </div>
            <button type="submit">Submit</button>
        </form>

        <div v-if="message" :class="messageClass">
            {{ message }}
        </div>
    </div>
</template>

<script>
import axios from 'axios'; // Import Axios

export default {
    data() {
        return {
            form: {
                name: '',
                price: '',
                description: '',
            },
            message: '',
            messageClass: '',
        };
    },
    methods: {
        async submitForm() {
            try {
                const response = await axios.post('/api/products/store', this.form);
                this.message = 'Product created successfully!';
                this.messageClass = 'success';
                this.resetForm();
                this.$emit('product-created');  // Emit the event here
            } catch (error) {
                this.message = 'Error creating product. Please try again.';
                this.messageClass = 'error';
            }
        },
        resetForm() {
            this.form = {
                name: '',
                price: '',
                description: '',
            };
        },
    },
};
</script>

<style scoped>
.success {
    color: green;
}
.error {
    color: red;
}
</style>
