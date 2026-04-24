import { createApp } from 'vue'
import KassaComponent from './components/KassaComponent.vue'

const app = createApp({})

app.component('kassa-component', KassaComponent)

app.mount('#cashDeskPage')
