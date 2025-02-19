import { createApp } from 'vue'; // Import createApp from Vue
import axios from 'axios'; // Import Axios
import ExampleComponent from './components/ExampleComponent.vue'; // Import your component
import ProductFormComponent from './components/ProductFormComponent.vue'; // Import your component
import ProductListComponent from './components/ProductListComponent.vue'; // Import your component
import ProductIndexComponent from './components/ProductIndexComponent.vue'; // Import your component

// Create a Vue app
const app = createApp({});
app.config.globalProperties.$axios = axios;
// Register the component globally
app.component('example-component', ExampleComponent);
app.component('product-form-component', ProductFormComponent);
app.component('product-list-component', ProductListComponent);
app.component('product-index-component', ProductIndexComponent);

// Mount the app to the element with id="app"
app.mount('#app');
