<script setup>
import { Button, Card } from 'primevue';
import CreateOrderModal from './CreateOrderModal.vue';
import { useForm } from '@inertiajs/vue3';

defineProps({
    orders: Array,
});

const updateLog = (status, orderId) => {
    const logForm = useForm({
        description: status,
        log_type: 'order',
    });

    logForm.post('/sales/log/' + orderId);
};
</script>

<template>
    <div class="flex flex-col gap-3 bg-white shadow-sm">
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
                    <CreateOrderModal :order="order" />
                    <Button
                        label="call back"
                        size="small"
                        class="!px-2 !py-1"
                        severity="secondary"
                        raised
                        @click="updateLog('Call back', order.id)"
                    />
                    <Button
                        label="no answer"
                        size="small"
                        class="!px-2 !py-1"
                        severity="secondary"
                        raised
                        @click="updateLog('No answer', order.id)"
                    />
                    <Button
                        label="Can't be contacted"
                        size="small"
                        class="!px-2 !py-1"
                        severity="secondary"
                        raised
                        @click="updateLog('Can\'t be contacted', order.id)"
                    />
                    <Button
                        label="cancel"
                        severity="danger"
                        size="small"
                        class="!px-2 !py-1"
                        raised
                    />
                </div>
                <div class="mt-4">
                    <div
                        v-for="log in order.logs"
                        :key="log.id"
                        class="flex w-2/3 items-center justify-between align-middle"
                    >
                        <div class="flex items-center">
                            <span class="pi pi-angle-right"></span>
                            <p class="align-middle font-bold">
                                {{ log.description }}
                            </p>
                        </div>
                        <div>
                            {{
                                new Date(log.created_at).toLocaleDateString(
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
                        </div>
                    </div>
                </div>
            </template>
        </Card>
    </div>
</template>
