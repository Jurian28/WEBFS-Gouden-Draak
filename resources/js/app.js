import { createApp } from 'vue'
import EmployeeOrderComponent from './components/EmployeeOrderComponent.vue'
import CustomerOrderComponent from './components/CustomerOrderComponent.vue'
import TakeAwayOrderComponent from "./components/TakeAwayOrderComponent.vue";

const app = createApp({})

app.component('employee-order-component', EmployeeOrderComponent)
app.component('customer-order-component', CustomerOrderComponent)
app.component('take-away-order-component', TakeAwayOrderComponent)

app.mount('#app')
