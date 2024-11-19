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
    AutoComplete,
    Textarea,
    RadioButtonGroup,
    RadioButton,
    FileUpload,
} from 'primevue';
import { onMounted, reactive, ref } from 'vue';
import { useToast } from 'primevue/usetoast';
import areas from './area.json';
import AddressSelector from './AddressSelector.vue';
import { computed } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    order: Object,
});

const csrfToken = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute('content');

// Add CSRF token to headers
const beforeUpload = (event) => {
    event.xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
};

const onUpload = ({ xhr }) => {
    const response = JSON.parse(xhr.responseText);
    if (response.path) {
        formData.order.paymentProof = response.path; // Set payment proof URL
        // toast.add({
        //     severity: 'success',
        //     summary: 'Success',
        //     detail: 'Image uploaded',
        // });
    } else {
        // toast.add({
        //     severity: 'error',
        //     summary: 'Error',
        //     detail: 'Image upload failed',
        // });
    }
};

const onUploadError = (error) => {
    console.log(error);
};

const formData = useForm({
    customer: {
        id: null, // Will be populated if updating an existing order
        name: '',
        phone: '',
        gender: '',
        phoneOther: '',
        address: {
            full_address: '',
            kelurahan: '',
            kecamatan: '',
            kota: '',
            provinsi: '',
            kodepos: '',
        },
    },
    order: {
        id: null, // For new orders; update with existing order ID if needed
        price: '',
        discount: '',
        totalPrice: '', // Calculate based on items
        shippingFee: '',
        status: 'pending', // Default status for new orders
        paymentProof: '',
        orderNote: '',
    },
    orderItems: [],
});

const populateFormData = () => {
    if (props.order) {
        formData.customer.id = props.order.customer?.id || null;
        formData.customer.name = props.order.customer?.name || '';
        formData.customer.phone = props.order.customer?.phone_number_1 || '';
        formData.customer.phoneOther =
            props.order.customer?.phone_number_2 || '';
        // formData.customer.address.full_address = props.order.customer?.full_address + `` || '';
        formData.customer.address.full_address = `${props.order.customer?.full_address}`;
        formData.customer.address.kelurahan =
            props.order.customer?.kelurahan || '';
        formData.customer.address.kecamatan =
            props.order.customer?.kecamatan || '';
        formData.customer.address.kota = props.order.customer?.kota || '';
        formData.customer.address.provinsi =
            props.order.customer?.provinsi || '';
        formData.customer.address.kodepos = props.order.customer?.kodepos || '';

        formData.order.id = props.order.id || null;
        formData.order.price = props.order.price || '';
        formData.order.discount = props.order.discount || '0';
        // formData.order.totalPrice = props.order.totalPrice || '';
        formData.order.shippingFee = props.order.shipping_fee || '';
        formData.order.status = props.order.status || 'pending';
        formData.order.paymentProof = props.order.payment_proof || '';
        formData.order.orderNote = props.order.orderNote || '';

        formData.orderItems = props.order.order_items.map((item) => ({
            id: item.id,
            product_id: item.product_id,
            product: item.product.name,
            quantity: item.quantity,
            stock: item.product.stock,
            price: item.product.price,
        }));
    }
};
// const toast = useToast();

// Submit handler
const onFormSubmit = () => {
    const itemsTotal = formData.orderItems.reduce((total, item) => {
        return total + item.quantity * item.price;
    }, 0);
    const discountAmount = formData.order.discount;
    formData.order.totalPrice =
        itemsTotal -
        discountAmount +
        parseFloat(formData.order.shippingFee || 0).toFixed(0);
    formData.put('/sales/' + formData.order.id, {
        onSuccess: () => (visible.value = false),
    });
};

const visible = ref(false);

const updateAddress = (updatedAddress) => {
    formData.customer.address = updatedAddress;
};

const calculatedTotalPrice = computed(() => {
    const itemsTotal = formData.orderItems.reduce((total, item) => {
        return total + item.quantity * item.price;
    }, 0);
    const discountAmount = formData.order.discount;
    return (
        itemsTotal -
        discountAmount +
        parseFloat(formData.order.shippingFee || 0)
    ).toFixed(2);
});

onMounted(() => {
    populateFormData();
});
</script>

<template>
    <Button
        label="Create Order"
        severity="success"
        size="small"
        raised
        class="!px-2 !py-1"
        @click="visible = true"
    />
    <div class="card flex justify-center">
        <Dialog
            v-model:visible="visible"
            modal
            header="Create Order"
            :style="{ width: 'auto' }"
            :breakpoints="{ '1199px': '75vw', '575px': '90vw' }"
        >
            <!-- <Toast /> -->
            <!-- <pre>{{ order }}</pre> -->
            <!-- <pre>{{ formData }}</pre> -->

            <form
                @submit.prevent="onFormSubmit"
                class="flex w-full justify-between gap-4"
            >
                <!-- Customer Field -->
                <div>
                    <div class="flex flex-col gap-1">
                        <label for="customer">Customer</label>
                        <InputText
                            v-model="formData.customer.name"
                            id="customer"
                            type="text"
                            placeholder="Customer name"
                            class="input"
                        />
                        <span
                            v-if="formData.errors['customer.name']"
                            class="text-red-500"
                            >{{ formData.errors['customer.name'] }}</span
                        >
                    </div>
                    <!-- Phone Field -->
                    <div class="flex gap-5">
                        <div class="flex flex-col gap-1">
                            <label for="phone">Phone</label>
                            <InputNumber
                                v-model="formData.customer.phone"
                                id="phone"
                                placeholder="Phone number"
                                :useGrouping="false"
                            />
                            <span
                                v-if="formData.errors['customer.phone']"
                                class="text-red-500"
                                >{{ formData.errors['customer.phone'] }}</span
                            >
                        </div>
                        <!-- Phone Other Field -->
                        <div class="flex flex-col gap-1">
                            <label for="phoneOther">Other</label>
                            <InputNumber
                                v-model="formData.customer.phoneOther"
                                :useGrouping="false"
                                id="phoneOther"
                                placeholder="Other phone number"
                            />
                        </div>
                    </div>
                    <!-- Address Field -->
                    <div class="flex flex-col gap-1">
                        <label for="address">Address</label>
                        <Textarea
                            v-model="formData.customer.address.full_address"
                            id="address"
                            type="text"
                            placeholder="Address"
                            class="input"
                        />
                        <span
                            v-if="
                                formData.errors['customer.address.full_address']
                            "
                            class="text-red-500"
                            >{{
                                formData.errors['customer.address.full_address']
                            }}</span
                        >
                    </div>

                    <!-- Gender Field -->
                    <div class="mb-1 flex flex-col gap-1">
                        <label class="flex" for="gender">Gender</label>
                        <div class="flex gap-2">
                            <div class="flex items-center gap-1">
                                <RadioButton
                                    v-model="formData.customer.gender"
                                    inputId="male"
                                    value="Male"
                                />
                                <label for="male">Male</label>
                            </div>
                            <div class="flex items-center gap-1">
                                <RadioButton
                                    v-model="formData.customer.gender"
                                    inputId="female"
                                    value="Female"
                                />
                                <label for="female">Female</label>
                            </div>
                        </div>
                        <span
                            v-if="formData.errors['customer.gender']"
                            class="text-red-500"
                            >{{ formData.errors['customer.gender'] }}</span
                        >
                    </div>
                    <!-- Total Price Field -->
                    <div class="flex flex-col gap-1">
                        <label for="totalPrice">Total Price</label>
                        <InputNumber
                            v-model="calculatedTotalPrice"
                            id="discount"
                            placeholder="Discount"
                            class="input"
                            size="small"
                            mode="currency"
                            currency="IDR"
                            disabled
                        />
                        <!-- <input :value="calculatedTotalPrice" disabled /> -->
                    </div>
                    <!-- Discount Field -->
                    <div class="flex flex-col gap-1">
                        <label for="discount">Discount</label>
                        <InputNumber
                            v-model="formData.order.discount"
                            id="discount"
                            placeholder="Discount"
                            class="input"
                            currency="IDR"
                        />
                        <span
                            v-if="formData.errors['order.discount']"
                            class="text-red-500"
                            >{{ formData.errors['order.discount'] }}</span
                        >
                    </div>
                    <!-- Shipping Fee Field -->
                    <div class="flex flex-col gap-1">
                        <label for="shippingFee">Shipping Fee</label>
                        <InputNumber
                            v-model="formData.order.shippingFee"
                            id="shippingFee"
                            placeholder="Shipping fee"
                            currency="IDR"
                            class="input"
                        />
                        <span
                            v-if="formData.errors['order.shippingFee']"
                            class="text-red-500"
                            >{{ formData.errors['order.shippingFee'] }}</span
                        >
                    </div>
                    <!-- Payment Proof Field -->
                    <div class="flex flex-col items-start gap-1">
                        <label for="paymentProof">Payment Proof</label>
                        <FileUpload
                            name="image"
                            mode="basic"
                            url="/upload-image"
                            accept="image/*"
                            :auto="true"
                            @beforeSend="beforeUpload"
                            :maxFileSize="10000000"
                            :onUpload="onUpload"
                            :onError="onUploadError"
                        />
                        <p v-if="formData.order.paymentProof">
                            <strong>Bukti:</strong>
                            <!-- {{ formData.paymentProof }} -->
                            <img
                                class="w-24"
                                :src="formData.order.paymentProof"
                                alt="bukti"
                            />
                        </p>
                        <!-- @upload="onUpload" -->
                        <span
                            v-if="formData.errors['order.paymentProof']"
                            class="text-red-500"
                            >{{ formData.errors['order.paymentProof'] }}</span
                        >
                    </div>
                    <!-- Order Note Field -->
                    <div class="flex flex-col gap-1">
                        <label for="orderNote">Order Note</label>
                        <Textarea
                            v-model="formData.orderNote"
                            id="orderNote"
                            type="text"
                            placeholder="Order note"
                            class="input"
                        />
                        <span
                            v-if="formData.errors['order.orderNote']"
                            class="text-red-500"
                            >{{ formData.errors['order.orderNote'] }}</span
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
                            <span
                                v-if="formData.errors['orderItems']"
                                class="text-red-500"
                                >Masukan minimal 1 produk</span
                            >
                        </thead>
                        <tbody>
                            <tr
                                class="border-b hover:bg-gray-50"
                                v-for="item in formData.orderItems"
                                :key="item.id"
                            >
                                <td class="flex items-center gap-2 px-4 py-2">
                                    <img
                                        src="/ginseng.jpeg"
                                        class="w-10"
                                        alt="ginseng"
                                    />
                                    {{ item.product }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ item.price }}
                                </td>
                                <td class="px-4 py-2">{{ item.stock }}</td>
                                <td class="px-4 py-2">
                                    <InputNumber
                                        size="small"
                                        inputId="stacked-buttons"
                                        showButtons
                                        fluid
                                        v-model="item.quantity"
                                        :min="0"
                                    />
                                </td>
                                <td>
                                    <InputNumber
                                        size="small"
                                        :model-value="
                                            item.quantity * item.price
                                        "
                                        mode="currency"
                                        currency="IDR"
                                        disabled
                                    />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <span
                        v-if="
                            formData.errors['customer.address.provinsi'] ||
                            formData.errors['customer.address.kota'] ||
                            formData.errors['customer.address.kecamatan'] ||
                            formData.errors['customer.address.kelurahan'] ||
                            formData.errors['customer.address.kodepos']
                        "
                        class="text-red-500"
                        >{{
                            `
                            ${formData.errors['customer.address.provinsi'] ? 'provinsi,' : ''}
                            ${formData.errors['customer.address.kota'] ? 'kota,' : ''}
                            ${formData.errors['customer.address.kecamatan'] ? 'kecamatan,' : ''}
                            ${formData.errors['customer.address.kodepos'] ? 'kodepos,' : ''}
                            ${formData.errors['customer.address.kelurahan'] ? 'kelurahan' : ''}
                            Tidak boleh kosong
                            `
                        }}</span
                    >
                    <AddressSelector
                        :areas="areas"
                        :initialAddress="{
                            provinsi: formData.customer.address.provinsi,
                            kota: formData.customer.address.kota,
                            kecamatan: formData.customer.address.kecamatan,
                            kelurahan: formData.customer.address.kelurahan,
                            kodepos: formData.customer.address.kodepos,
                            full_address:
                                formData.customer.address.full_address,
                        }"
                        @update:address="updateAddress"
                    />
                </div>
            </form>
        </Dialog>
    </div>
</template>
