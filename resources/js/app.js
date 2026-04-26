import { createApp } from 'vue'
import KassaComponent from './components/KassaComponent.vue'
import CustomerOrderComponent from './components/CustomerOrderComponent.vue'

const app = createApp({})

app.component('kassa-component', KassaComponent)
app.component('customer-order-component', CustomerOrderComponent)

app.mount('#app')
