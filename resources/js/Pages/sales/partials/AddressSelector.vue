<script setup>
import { AutoComplete } from 'primevue';
import { ref, watch } from 'vue';

const props = defineProps({
    areas: Object,
    initialAddress: Object,
});

const emits = defineEmits(['update:address']);

const selectedProvince = ref(props.initialAddress.provinsi || '');
const selectedRegency = ref(props.initialAddress.kota || '');
const selectedDistrict = ref(props.initialAddress.kecamatan || '');
const selectedVillage = ref(props.initialAddress.kelurahan || '');
const selectedPostalCode = ref(props.initialAddress.kodepos || '');

const fullAddress = props.initialAddress.full_address;

const filteredProvinces = ref([]);
const filteredRegencies = ref([]);
const filteredDistricts = ref([]);
const filteredVillages = ref([]);
const filteredPostalCodes = ref([]);

const filterProvinces = (event) => {
    filteredProvinces.value = Object.keys(props.areas).filter((province) =>
        province.toLowerCase().includes(event.query.toLowerCase()),
    );
};

const filterRegencies = (event) => {
    if (!selectedProvince.value) return;
    filteredRegencies.value = Object.keys(
        props.areas[selectedProvince.value] || {},
    ).filter((regency) =>
        regency.toLowerCase().includes(event.query.toLowerCase()),
    );
};

const filterDistricts = (event) => {
    if (!selectedRegency.value) return;
    filteredDistricts.value = Object.keys(
        props.areas[selectedProvince.value][selectedRegency.value] || {},
    ).filter((district) =>
        district.toLowerCase().includes(event.query.toLowerCase()),
    );
};

const filterPostalCodes = (event) => {
    if (!selectedDistrict.value) return;
    filteredPostalCodes.value = Object.keys(
        props.areas[selectedProvince.value][selectedRegency.value][
            selectedDistrict.value
        ] || {},
    ).filter((postalCode) =>
        postalCode.toLowerCase().includes(event.query.toLowerCase()),
    );
};

const filterVillages = (event) => {
    if (!selectedPostalCode.value) return;
    const villages =
        props.areas[selectedProvince.value][selectedRegency.value][
            selectedDistrict.value
        ][selectedPostalCode.value] || [];
    filteredVillages.value = villages.filter((village) =>
        village.toLowerCase().includes(event.query.toLowerCase()),
    );
};

watch(selectedProvince, (newVal) => {
    if (newVal) {
        selectedRegency.value = '';
        selectedDistrict.value = '';
        selectedVillage.value = '';
        selectedPostalCode.value = '';
    }
});
watch(selectedRegency, (newVal) => {
    if (newVal) {
        selectedDistrict.value = '';
        selectedVillage.value = '';
        selectedPostalCode.value = '';
    }
});
watch(selectedDistrict, (newVal) => {
    if (newVal) {
        selectedVillage.value = '';
        selectedPostalCode.value = '';
    }
});
watch(selectedPostalCode, (newVal) => {
    if (newVal) {
        selectedVillage.value = '';
    }
});

// Watch for changes and emit updated address to parent
watch(
    [
        selectedProvince,
        selectedRegency,
        selectedDistrict,
        selectedVillage,
        selectedPostalCode,
    ],
    () => {
        emits('update:address', {
            full_address: fullAddress,
            provinsi: selectedProvince.value,
            kota: selectedRegency.value,
            kecamatan: selectedDistrict.value,
            kelurahan: selectedVillage.value,
            kodepos: selectedPostalCode.value,
        });
    },
);
</script>

<template>
    <div class="flex w-1/2 flex-col">
        <label for="province">Provinsi:</label>

        <AutoComplete
            v-model="selectedProvince"
            dropdown
            :suggestions="filteredProvinces"
            @complete="filterProvinces"
            placeholder="Select Province"
        />
        <label for="kota">Kota/Kabupaten:</label>

        <AutoComplete
            v-model="selectedRegency"
            dropdown
            :suggestions="filteredRegencies"
            @complete="filterRegencies"
            placeholder="Select Regency"
            :disabled="!selectedProvince"
        />
        <label for="kecamatan">Kecamatan:</label>

        <AutoComplete
            v-model="selectedDistrict"
            dropdown
            :suggestions="filteredDistricts"
            @complete="filterDistricts"
            placeholder="Select District"
            :disabled="!selectedRegency"
        />
        <label for="postalcode">Kodepos:</label>

        <AutoComplete
            v-model="selectedPostalCode"
            dropdown
            :suggestions="filteredPostalCodes"
            @complete="filterPostalCodes"
            placeholder="Select Postal Code"
            :disabled="!selectedDistrict"
        />
        <label for="village">Kelurahan/Desa:</label>

        <AutoComplete
            v-model="selectedVillage"
            dropdown
            :suggestions="filteredVillages"
            @complete="filterVillages"
            placeholder="Select Village"
            :disabled="!selectedPostalCode"
        />
    </div>
</template>
