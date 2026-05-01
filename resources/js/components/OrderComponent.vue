<template>
    <div class="flex gap-2 mt-2">
        <!-- LEFT -->
        <div class="flex-1 border rounded p-2 overflow-y-auto h-[85vh]">
            <div v-for="(group, type) in dishesByType" :key="type" class="mb-4">
                <h1 class="font-bold text-center">{{ type }}</h1>

                <table class="w-full">
                    <tr v-for="dish in group" :key="dish.id" class="hover:bg-gray-100">
                        <td class="w-[10%]">
                            {{ dish.menu_number + dish.menu_affix + "." }}
                        </td>

                        <td class="w-[70%]">
                            {{ dish.name }}
                            <i v-if="dish.description">({{ dish.description }})</i>
                        </td>

                        <td class="w-[10%]">
                            <div v-if="getActiveDiscount(dish)">
                                <div class="line-through text-gray-400 text-xs">
                                    € {{ formatPrice(dish.price) }}
                                </div>

                                <div class="text-red-600 font-bold">
                                    € {{ formatPrice(getDiscountedPrice(dish)) }}
                                </div>

                                <div class="text-[10px] text-red-500">
                                    -{{ getActiveDiscount(dish).percentage }}%
                                </div>
                            </div>

                            <div v-else>
                                € {{ formatPrice(dish.price) }}
                            </div>
                        </td>

                        <td class="w-[10%]">
                            <button
                                class="border px-2 rounded bg-white m-0.5 hover:bg-gray-200"
                                @click="addDish(dish.id)"
                            >
                                +
                            </button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="flex-1 flex flex-col gap-2 h-[85vh]">
            <!-- TOP -->
            <div class="flex-1 border rounded p-2 overflow-y-auto">
                <h1 class="font-bold text-center">Bestelling</h1>

                <table class="w-full">
                    <tr v-for="dish in getCart" :key="dish.id" class="hover:bg-gray-100">
                        <td class="w-[10%]">
                            {{ dish.menu_number + dish.menu_affix + "." }}
                        </td>

                        <td class="w-[70%]">
                            {{ dish.name }}
                            <i v-if="dish.description">({{ dish.description }})</i>
                        </td>

                        <td class="w-[10%]">
                            € {{ formatPrice(getDiscountedPrice(dish)) }}
                        </td>

                        <td class="w-[10%]">
                            <input
                                type="number"
                                min="0"
                                :value="cart[dish.id]"
                                @input="setAmount(dish.id, $event.target.value)"
                                class="w-12 border"
                            />
                        </td>
                    </tr>
                </table>
            </div>

            <!-- BOTTOM -->
            <div class="border rounded p-2 flex justify-between mt-2">
                <button @click="emptyCart()" class="border px-2 rounded bg-white m-0.5 hover:bg-gray-200">Verwijderen</button>
                <h1 class="font-bold text-center">
                    Total: {{ totalPrice }}
                </h1>
                <slot name="order-button" :cart="cart" :emptyCart="emptyCart"></slot>
            </div>
        </div>
    </div>
</template>
<script>
import { route } from 'ziggy-js'

export default {
    props: {
        startingCart: {
            type: [Object, null],
            default: null
        },
        dishesByType: Object,
        dishesList: Array
    },
    data() {
        return { cart: this.startingCart ?? {} };
    },

    methods: {
        formatPrice(price) {
            return Number(price).toFixed(2).replace('.', ',')
        },

        addDish(dishId, remove=false) {
            if (dishId in this.cart) {
                this.cart[dishId] += remove ? -1 : 1;
            } else {
                this.cart[dishId] = 1;
            }

            if (this.cart[dishId] <= 0) {
                delete this.cart[dishId]
            }
        },

        getDish(dishId) {
            return this.dishesList.find(d => d.id == dishId);
        },

        emptyCart() {
            this.cart = {};
        },

        setAmount(dishId, value) {
            value = Number(value);

            if (value <= 0) {
                delete this.cart[dishId];
            } else {
                this.cart[dishId] = value;
            }
        },

        getActiveDiscount(dish) {
            if (!dish.discounts || !dish.discounts.length) return null;

            const now = new Date();

            return dish.discounts
                .filter(d => {
                    const start = new Date(d.start_time);
                    const end = new Date(d.end_time);
                    return now >= start && now <= end;
                })
                .sort((a, b) => b.percentage - a.percentage)[0] || null;
        },

        getDiscountedPrice(dish) {
            const discount = this.getActiveDiscount(dish);

            if (!discount) return Number(dish.price);

            return Number(dish.price) * (1 - discount.percentage / 100);
        },
    },

    computed: {
        getCart() {
            return Object.entries(this.cart).map(([dishId, amount]) => {
                const dish = this.getDish(dishId);

                return {
                    ...dish,
                    amount
                }
            })
        },

        totalPrice() {
            let total = 0;

            for (const dish of this.getCart) {
                total += this.getDiscountedPrice(dish) * Number(dish.amount);
            }

            return this.formatPrice(total);
        }
    }
}
</script>
