<script setup>
import { Form } from '@primevue/forms';
import {
    Dialog,
    Button,
    Toast,
    InputText,
    Message,
    IftaLabel,
    InputNumber,
} from 'primevue';
import { reactive, ref } from 'vue';
import { useToast } from 'primevue/usetoast';

// const toast = useToast();

const formData = reactive({
    customer: 'Budi',
    phone: '123',
    phoneOther: '',
    address: 'aaaaaa',
    region: 'aa',
    kodepos: 'aa',
    gender: 'aa',
    totalPrice: '2',
    discount: '1',
    shippingFee: '3',
    paymentProof: 'aa',
    orderNote: 'aa',
});

// Validation errors
const formErrors = reactive({
    customer: '',
    phone: '',
    phoneOther: '',
    address: '',
    region: '',
    kodepos: '',
    gender: '',
    totalPrice: '',
    discount: '',
    shippingFee: '',
    paymentProof: '',
    orderNote: '',
});

// Submit handler
const onFormSubmit = () => {
    // Reset errors
    for (const key in formErrors) {
        formErrors[key] = '';
    }

    // Simple validation
    let valid = true;

    if (!formData.customer) {
        formErrors.customer = 'Customer name is required';
        valid = false;
    }
    if (!formData.phone) {
        formErrors.phone = 'Phone number is required';
        valid = false;
    }
    if (!formData.phoneOther) {
        formErrors.phoneOther = 'Other phone number is optional';
    }
    if (!formData.address) {
        formErrors.address = 'Address is required';
        valid = false;
    }
    if (!formData.region) {
        formErrors.region = 'Region is required';
        valid = false;
    }
    if (!formData.kodepos) {
        formErrors.kodepos = 'Postal code is required';
        valid = false;
    }
    if (!formData.gender) {
        formErrors.gender = 'Gender is required';
        valid = false;
    }
    if (!formData.totalPrice) {
        formErrors.totalPrice = 'Total price is required';
        valid = false;
    }
    if (!formData.discount) {
        formErrors.discount = 'Discount is required';
        valid = false;
    }
    if (!formData.shippingFee) {
        formErrors.shippingFee = 'Shipping fee is required';
        valid = false;
    }
    if (!formData.paymentProof) {
        formErrors.paymentProof = 'Payment proof is required';
        valid = false;
    }
    if (!formData.orderNote) {
        formErrors.orderNote = 'Order note is required';
        valid = false;
    }

    // If form is valid, proceed
    if (valid) {
        console.log('Form Submitted:', formData);
        // You can make an API call here to submit the form data
    } else {
        console.log('Form has errors');
    }
};

const visible = ref(false);
</script>

<template>
    <Button label="Show" @click="visible = true" />
    <div class="card flex justify-center">
        <Dialog
            v-model:visible="visible"
            modal
            header="Create Order"
            :style="{ width: 'auto' }"
            :breakpoints="{ '1199px': '75vw', '575px': '90vw' }"
        >
            <!-- <Toast /> -->
            <!-- <pre>{{ initialValues }}</pre> -->

            <form
                @submit.prevent="onFormSubmit"
                class="flex w-full justify-between gap-4"
            >
                <!-- Customer Field -->
                <div>
                    <div class="flex flex-col gap-1">
                        <label for="customer">Customer</label>
                        <InputText
                            v-model="formData.customer"
                            id="customer"
                            type="text"
                            placeholder="Customer name"
                            class="input"
                        />
                        <span v-if="formErrors.customer" class="text-red-500">{{
                            formErrors.customer
                        }}</span>
                    </div>
                    <!-- Phone Field -->
                    <div class="flex gap-5">
                        <div class="flex flex-col gap-1">
                            <label for="phone">Phone</label>
                            <InputText
                                v-model="formData.phone"
                                id="phone"
                                type="text"
                                placeholder="Phone number"
                                class="input"
                            />
                            <span
                                v-if="formErrors.phone"
                                class="text-red-500"
                                >{{ formErrors.phone }}</span
                            >
                        </div>
                        <!-- Phone Other Field -->
                        <div class="flex flex-col gap-1">
                            <label for="phoneOther">Other</label>
                            <InputText
                                v-model="formData.phoneOther"
                                id="phoneOther"
                                type="text"
                                placeholder="Other phone number"
                                class="input"
                            />
                            <span
                                v-if="formErrors.phoneOther"
                                class="text-red-500"
                                >{{ formErrors.phoneOther }}</span
                            >
                        </div>
                    </div>
                    <!-- Address Field -->
                    <div class="flex flex-col gap-1">
                        <label for="address">Address</label>
                        <InputText
                            v-model="formData.address"
                            id="address"
                            type="text"
                            placeholder="Address"
                            class="input"
                        />
                        <span v-if="formErrors.address" class="text-red-500">{{
                            formErrors.address
                        }}</span>
                    </div>
                    <!-- Region Field -->
                    <div class="flex flex-col gap-1">
                        <label for="region">Region</label>
                        <InputText
                            v-model="formData.region"
                            id="region"
                            type="text"
                            placeholder="Region"
                            class="input"
                        />
                        <span v-if="formErrors.region" class="text-red-500">{{
                            formErrors.region
                        }}</span>
                    </div>
                    <!-- Kodepos Field -->
                    <div class="flex flex-col gap-1">
                        <label for="kodepos">Kodepos</label>
                        <InputText
                            v-model="formData.kodepos"
                            id="kodepos"
                            type="text"
                            placeholder="Postal code"
                            class="input"
                        />
                        <span v-if="formErrors.kodepos" class="text-red-500">{{
                            formErrors.kodepos
                        }}</span>
                    </div>
                    <!-- Gender Field -->
                    <div class="flex flex-col gap-1">
                        <label for="gender">Gender</label>
                        <InputText
                            v-model="formData.gender"
                            id="gender"
                            type="text"
                            placeholder="Gender"
                            class="input"
                        />
                        <span v-if="formErrors.gender" class="text-red-500">{{
                            formErrors.gender
                        }}</span>
                    </div>
                    <!-- Total Price Field -->
                    <div class="flex flex-col gap-1">
                        <label for="totalPrice">Total Price</label>
                        <InputText
                            v-model="formData.totalPrice"
                            id="totalPrice"
                            type="text"
                            placeholder="Total price"
                            class="input"
                        />
                        <span
                            v-if="formErrors.totalPrice"
                            class="text-red-500"
                            >{{ formErrors.totalPrice }}</span
                        >
                    </div>
                    <!-- Discount Field -->
                    <div class="flex flex-col gap-1">
                        <label for="discount">Discount</label>
                        <InputText
                            v-model="formData.discount"
                            id="discount"
                            type="text"
                            placeholder="Discount"
                            class="input"
                        />
                        <span v-if="formErrors.discount" class="text-red-500">{{
                            formErrors.discount
                        }}</span>
                    </div>
                    <!-- Shipping Fee Field -->
                    <div class="flex flex-col gap-1">
                        <label for="shippingFee">Shipping Fee</label>
                        <InputText
                            v-model="formData.shippingFee"
                            id="shippingFee"
                            type="text"
                            placeholder="Shipping fee"
                            class="input"
                        />
                        <span
                            v-if="formErrors.shippingFee"
                            class="text-red-500"
                            >{{ formErrors.shippingFee }}</span
                        >
                    </div>
                    <!-- Payment Proof Field -->
                    <div class="flex flex-col gap-1">
                        <label for="paymentProof">Payment Proof</label>
                        <InputText
                            v-model="formData.paymentProof"
                            id="paymentProof"
                            type="text"
                            placeholder="Payment proof"
                            class="input"
                        />
                        <span
                            v-if="formErrors.paymentProof"
                            class="text-red-500"
                            >{{ formErrors.paymentProof }}</span
                        >
                    </div>
                    <!-- Order Note Field -->
                    <div class="flex flex-col gap-1">
                        <label for="orderNote">Order Note</label>
                        <InputText
                            v-model="formData.orderNote"
                            id="orderNote"
                            type="text"
                            placeholder="Order note"
                            class="input"
                        />
                        <span
                            v-if="formErrors.orderNote"
                            class="text-red-500"
                            >{{ formErrors.orderNote }}</span
                        >
                    </div>
                    <!-- Submit Button -->
                    <Button type="submit" severity="secondary" label="Submit" />
                </div>
                <div>
                    <table class="min-w-full table-auto border-collapse">
                        <thead class="bg-gray-100 text-left">
                            <tr>
                                <th class="border-b px-4 py-2">Product</th>
                                <th class="border-b px-4 py-2">Price</th>
                                <th class="border-b px-4 py-2">Stocks</th>
                                <th class="border-b px-4 py-2">Quantity</th>
                                <th class="border-b px-4 py-2">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="flex items-center gap-2 px-4 py-2">
                                    <img
                                        src="/ginseng.jpeg"
                                        class="w-10"
                                        alt="ginseng"
                                    />
                                    Serum Ginseng Anti Kerut🌹🪷
                                </td>
                                <td class="px-4 py-2">Rp200000</td>
                                <td class="px-4 py-2">500</td>
                                <td class="px-4 py-2">
                                    <InputNumber
                                        size="small"
                                        v-model="value1"
                                        inputId="stacked-buttons"
                                        showButtons
                                        fluid
                                        :min="0"
                                    />
                                </td>
                                <td class="px-4 py-2">Rp400000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </form>
        </Dialog>
    </div>
</template>
