<template>
    <div class="flex gap-2 my-2">
        <input
            v-model="searchQuery"
            type="text"
            placeholder="Zoek naam of nummer..."
            class="border px-2 rounded w-full"
        />

        <select v-model="selectedCategory" class="border px-2 rounded">
            <option value="">Alle</option>
            <option v-for="cat in categories" :key="cat" :value="cat">
                {{ cat }}
            </option>
        </select>
    </div>

    <OrderComponent
        :dishesByType="filteredDishesByType"
        :dishesList="dishesList"
    >
        <template #order-button="{ cart, emptyCart }">
            <input type="number" v-model="tableNumber" placeholder="Tafel nr" class="border px-2 py-1 rounded bg-white w-24 text-sm focus:outline-none focus:ring-2 focus:ring-gray-300" />
            <button @click="sell(cart, emptyCart)" class="border px-2 rounded bg-white m-0.5 hover:bg-gray-200">Afrekenen</button>
        </template>
    </OrderComponent>
</template>
<script>
import { route } from 'ziggy-js'
import OrderComponent from './OrderComponent.vue'

export default {
    components: { OrderComponent },

    props: {
        dishesByType: Object,
        dishesList: Array
    },

    data() {
        return {
            tableNumber: null,
            searchQuery: '',
            selectedCategory: ''
        }
    },

    methods: {
        async sell(cart, emptyCart) {
            try {
                const res = await fetch(route('cart.sell'), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        cart,
                        table_number: this.tableNumber
                    })
                })

                const result = await res.json()

                if (!result.success) {
                    alert(result.message ?? 'Bestelling niet succesvol.')
                    return
                }

                alert('Verkoop succesvol!')
                emptyCart()

            } catch (e) {
                alert('Er ging iets mis.')
            }
        },

        normalize(val) {
            return (val ?? '').toString().toLowerCase().trim()
        }
    },

    computed: {
        filteredDishesList() {
            const query = this.normalize(this.searchQuery)

            return this.dishesList.filter(dish => {
                const name = this.normalize(dish.name)
                const menuCode = this.normalize(`${dish.menu_number ?? ''}${dish.menu_affix ?? ''}`)
                const category = dish.type?.name

                const matchesSearch =
                    !query ||
                    name.includes(query) ||
                    menuCode.includes(query)

                const matchesCategory =
                    !this.selectedCategory ||
                    category === this.selectedCategory

                return matchesSearch && matchesCategory
            })
        },

        filteredDishesByType() {
            return this.filteredDishesList.reduce((acc, dish) => {
                const type = dish.type?.name || 'Unknown'
                ;(acc[type] ??= []).push(dish)
                return acc
            }, {})
        },

        categories() {
            return Object.keys(this.dishesByType || {})
        }
    }
}
</script>
