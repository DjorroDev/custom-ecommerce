<script setup>
import { Button, Card } from 'primevue';
import CreateOrderModal from './CreateOrderModal.vue';

defineProps({
    orders: Array,
});
</script>

<template>
    <div class="flex flex-col gap-3 bg-white p-6 shadow-sm">
        <!-- <pre>{{ orders }}</pre> -->
        <Card v-for="order in orders" :key="order.id">
            <!-- <template #header><p>pante</p></template> -->
            <template #title
                ><h3>
                    {{ order.customer.name }} -
                    {{ order.customer.phone_number_1 }}
                </h3></template
            >
            <template #subtitle
                ><p>
                    Created at
                    {{
                        new Date(order.created_at).toLocaleDateString(
                            'locale',
                            {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit',
                                second: 'numeric',
                            },
                        )
                    }}
                </p>
            </template>
            <template #content>
                <p>{{ order.customer.full_address }}</p>
                <p>
                    {{ order.order_items[0].product.name }} beli
                    {{ order.order_items[0].quantity }}
                    Rp{{ order.order_items[0].price }}
                </p>
            </template>
            <template #footer>
                <div class="flex gap-2">
                    <Button
                        label="create order"
                        size="small"
                        class="!px-2 !py-1"
                        severity="success"
                        raised
                    />
                    <CreateOrderModal />
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
            </template>
        </Card>
    </div>
</template>
