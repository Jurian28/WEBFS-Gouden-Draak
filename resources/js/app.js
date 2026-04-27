import { createApp } from 'vue'
import EmployeeOrderComponent from './components/EmployeeOrderComponent.vue'
import CustomerOrderComponent from './components/CustomerOrderComponent.vue'

const app = createApp({})

app.component('employee-order-component', EmployeeOrderComponent)
app.component('customer-order-component', CustomerOrderComponent)

app.mount('#app')
