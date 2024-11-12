<script setup>
import { Button, Column, DataTable } from 'primevue';

defineProps({
    orders: Array,
});

const addressTemplate = (order) => {
    return `${order.customer.full_address}, ${order.customer.kelurahan}, ${order.customer.kecamatan}, ${order.customer.kota}, ${order.customer.kodepos}`;
};

const phoneTemplate = (order) => {
    return `${order.customer.phone_number_1}${order.customer.phone_number_2 ? ', ' + order.customer.phone_number_2 : ''}`;
};

const productTemplate = (order) => {
    return order.order_items.map((item) => item.product.name).join(', ');
};

const quantityTemplate = (order) => {
    return order.order_items.map((item) => item.quantity).join(', ');
};

const priceTemplate = (order) => {
    return order.order_items.map((item) => item.price).join(', ');
};
</script>

<template>
    <div class="bg-white p-6 shadow-sm sm:rounded-lg">
        <!-- <pre>{{ orders }}</pre> -->
        <div class="card">
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="border-b px-4 py-2">ID</th>
                        <th class="w-1/4 border-b px-4 py-2">
                            Product Details
                        </th>
                        <th class="w-2/4 border-b px-4 py-2">
                            Customer Information
                        </th>
                        <th class="w-2/4 border-b px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="order in orders"
                        :key="order.id"
                        class="border-b hover:bg-gray-50"
                    >
                        <!-- Order ID -->
                        <td class="px-4 py-2">{{ order.id }}</td>

                        <!-- Product Details Column -->
                        <td class="px-4 py-2">
                            <div
                                v-for="item in order.order_items"
                                :key="item.id"
                                class="mb-2"
                            >
                                <strong class="text-sm text-gray-700"
                                    >Product:</strong
                                >
                                <span class="block">{{
                                    item.product.name
                                }}</span>
                                <strong class="text-sm text-gray-700"
                                    >Price:</strong
                                >
                                <span class="block"
                                    >{{ item.price }} ({{
                                        item.quantity
                                    }})</span
                                >
                            </div>
                        </td>

                        <!-- Customer Information Column -->
                        <td class="px-4 py-2">
                            <div>
                                <strong class="text-sm text-gray-700"
                                    >Name:</strong
                                >
                                <span class="block">{{
                                    order.customer.name
                                }}</span>
                                <strong class="text-sm text-gray-700"
                                    >Address:</strong
                                >
                                <span class="block">{{
                                    order.customer.full_address
                                }}</span>
                                <span class="block"
                                    >{{ order.customer.kelurahan }},
                                    {{ order.customer.kecamatan }},
                                    {{ order.customer.kota }},
                                    {{ order.customer.kodepos }}</span
                                >
                                <strong class="text-sm text-gray-700"
                                    >Phone:</strong
                                >
                                <span class="block"
                                    >{{ order.customer.phone_number_1 }}
                                    <span v-if="order.customer.phone_number_2">
                                        , {{ order.customer.phone_number_2 }}
                                    </span>
                                </span>
                            </div>
                        </td>
                        <td class="px-4 py-2">
                            <div class="flex flex-wrap gap-2">
                                <Button
                                    label="create order"
                                    size="small"
                                    class="!px-2 !py-1"
                                    severity="success"
                                    raised
                                />
                                <Button
                                    label="call back"
                                    size="small"
                                    class="!px-2 !py-1"
                                    severity="secondary"
                                    raised
                                />
                                <Button
                                    label="no answer"
                                    size="small"
                                    class="!px-2 !py-1"
                                    severity="secondary"
                                    raised
                                />
                                <Button
                                    label="Can't be contacted"
                                    size="small"
                                    class="!px-2 !py-1"
                                    severity="secondary"
                                    raised
                                />
                                <Button
                                    label="cancel"
                                    severity="danger"
                                    size="small"
                                    class="!px-2 !py-1"
                                    raised
                                />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
