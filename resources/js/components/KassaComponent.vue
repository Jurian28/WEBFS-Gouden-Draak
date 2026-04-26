<template>
    <OrderComponent
        :dishesByType="dishesByType"
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
            tableNumber: null
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
                        alert('ERROR: Verkoop niet succesvol.');
                    }
                });
        },
    },
}
</script>
