<template>
    <OrderComponent
        :dishesByType="dishesByType"
        :dishesList="dishesList"
    >
        <template #order-button="{ cart, emptyCart }">
            <input
                type="text"
                v-model="name"
                placeholder="Naam"
                class="border px-2 py-1 rounded bg-white w-24 text-sm focus:outline-none focus:ring-2 focus:ring-gray-300"
            />

            <button
                @click="order(cart, emptyCart)"
                class="border px-2 rounded bg-white m-0.5 hover:bg-gray-200"
            >
                Afrekenen
            </button>
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
            name: '',
        }
    },

    methods: {
        async order(cart, emptyCart) {
            try {
                const res = await fetch(route('public.cart.orderTakeAway'), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        cart,
                        name: this.name
                    })
                })

                const result = await res.json()

                if (!result.success) {
                    alert(result.message ?? 'Bestelling niet succesvol.')
                    return
                }

                emptyCart()


                console.log(result)
                window.location.href = route('public.thanksPage', {
                    orderId: result.order_id
                })

            } catch (e) {
                console.log(e)
                alert('Er ging iets mis.')
            }
        },
    }
}
</script>
