<template>
    <OrderComponent
        :dishesByType="dishesByType"
        :dishesList="dishesList"
        :startingCart="startingCart"
    >
        <template #order-button="{ cart, emptyCart }">
            <button @click="order(cart, emptyCart)" class="border px-2 rounded bg-white m-0.5 hover:bg-gray-200">Bestellen</button>
        </template>
    </OrderComponent>
</template>
<script>
import { route } from 'ziggy-js'
import OrderComponent from './OrderComponent.vue'

export default {
    components: {OrderComponent},
    props: {
        startingCart: {
            type: [Object, null],
            default: null
        },
        dishesByType: Object,
        dishesList: Array
    },

    methods: {
        async getTableNumber() {
            const res = await fetch(route('getTableNumber'), {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document
                        .querySelector('meta[name="csrf-token"]').content
                }
            });

            const result = await res.json();
            return result.table_number;
        },

        async order(cart, emptyCart) {
            const tableNumber = await this.getTableNumber();

            fetch(route('cart.order'), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document
                        .querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ cart: cart, table_number: tableNumber })
            }).then(res => res.json())
                .then(result => {
                    if (result.success) {
                        alert('Bestelling succesvol!');
                        emptyCart();
                    } else {
                        alert(result.message ?? 'Bestelling niet succesvol.');
                    }
                });
        },
    },
}
</script>
