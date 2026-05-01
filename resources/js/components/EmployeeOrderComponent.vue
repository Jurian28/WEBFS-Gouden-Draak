<template>
    <div class="flex gap-2 mb-2">
        <!-- search -->
        <input
            v-model="searchQuery"
            type="text"
            placeholder="Zoek naam of nummer..."
            class="border px-2 rounded w-full"
        />

        <!-- category filter -->
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
            <input type="number" v-model="tableNumber" placeholder="Tafel nr">
            <button @click="sell(cart, emptyCart)" class="border px-2 rounded bg-white m-0.5 hover:bg-gray-200">Afrekenen</button>
        </template>
    </OrderComponent>
</template>
<script>
import { route } from 'ziggy-js'
import OrderComponent from './OrderComponent.vue'

export default {
    components: {OrderComponent},
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
        sell(cart, emptyCart) {
            fetch(route('cart.sell'), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document
                        .querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ cart: cart, table_number: this.tableNumber })
            }).then(res => res.json())
                .then(result => {
                    if (result.success) {
                        alert('Verkoop succesvol!');
                        emptyCart();
                    } else {
                        alert(result.message ?? 'Bestelling niet succesvol.');
                    }
                });
        },
    },

    computed: {
        filteredDishesList() {
            let query = (this.searchQuery ?? '').toLowerCase().trim();

            return this.dishesList.filter(dish => {
                const nameMatch = (dish.name ?? '').toLowerCase().includes(query);

                const menuCode =
                    `${dish.menu_number ?? ''}${dish.menu_affix ?? ''}`.toLowerCase();

                const menuMatch = menuCode.includes(query);

                const categoryMatch = this.selectedCategory
                    ? dish.type?.name === this.selectedCategory
                    : true;

                return (nameMatch || menuMatch) && categoryMatch;
            });
        },

        filteredDishesByType() {
            const grouped = {};

            this.filteredDishesList.forEach(dish => {
                const type = dish.type?.name ?? 'Unknown';

                if (!grouped[type]) {
                    grouped[type] = [];
                }

                grouped[type].push(dish);
            });

            return grouped;
        },

        categories() {
            return Object.keys(this.dishesByType);
        }
    }
}
</script>
