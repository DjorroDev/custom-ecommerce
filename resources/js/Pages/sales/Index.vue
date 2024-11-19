<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {
    Button,
    Tabs,
    Tab,
    TabList,
    TabPanel,
    Toolbar,
    IconField,
    InputIcon,
    InputText,
    TabPanels,
} from 'primevue';
import { ref, defineProps } from 'vue';
import Data from './partials/Data.vue';
import Overview from './partials/Overview.vue';
import Order from './partials/Order.vue';
import { router } from '@inertiajs/vue3';

defineProps({
    orders: Array,
});

const tabs = ref([
    { title: 'Overview', content: Data, value: '0' },
    { title: 'Your Data', content: 'Tab 2 Content', value: '1' },
    { title: 'Your Order', content: 'Tab 3 Content', value: '2' },
]);

// console.log();
</script>

<template>
    <AuthenticatedLayout>
        <div class="py-6">
            <Toolbar style="padding: 8px 24px 8px 24px">
                <template #start>
                    <IconField>
                        <InputIcon>
                            <i class="pi pi-search" />
                        </InputIcon>
                        <InputText placeholder="Phone number" />
                    </IconField>
                    <div class="ml-2 flex gap-2">
                        <Button
                            label="Refresh"
                            icon="pi pi-refresh"
                            severity="info"
                            @click="router.reload({ only: ['orders'] })"
                        ></Button>
                        <Button label="Create Order" icon="pi pi-plus"></Button>
                    </div>
                </template>
                <template #center> </template>
            </Toolbar>
            <Tabs class="px-6" value="0">
                <TabList>
                    <Tab value="0">Overview</Tab>
                    <Tab value="1">Your Data</Tab>
                    <Tab value="2">Your Order</Tab>
                </TabList>
                <TabPanels>
                    <TabPanel value="0">
                        <Overview :orders="orders" />
                        <!-- <pre>{{ props.orders }}</pre> -->
                    </TabPanel>
                    <TabPanel value="1">
                        <Data :orders="orders" />
                    </TabPanel>
                    <TabPanel value="2">
                        <Order />
                    </TabPanel>
                </TabPanels>
            </Tabs>
        </div>
    </AuthenticatedLayout>
</template>
