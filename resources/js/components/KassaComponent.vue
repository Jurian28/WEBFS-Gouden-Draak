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
                            € {{ formatPrice(dish.price) }}
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
                            € {{ formatPrice(dish.price) }}
                        </td>

                        <td class="w-[10%]">
                            <input
                                type="number"
                                min="0"
                                v-model.number="cart[dish.id]"
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
                <button @click="sell()" class="border px-2 rounded bg-white m-0.5 hover:bg-gray-200">Afrekenen</button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        dishesByType: Object,
        dishesList: Array
    },
    data() {
        return { cart: {} };
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

        sell() {
            alert("Verkoop succesvol")
            this.emptyCart()
        },

        emptyCart() {
            this.cart = {};
        }
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
                total += Number(dish.price) * Number(dish.amount);
            }
            return this.formatPrice(total);
        }
    }
}
</script>
