<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import { Menu, Menubar } from 'primevue';

const showingNavigationDropdown = ref(false);

const items = ref([
    {
        items: [
            {
                label: 'Sales',
                icon: 'pi pi-shopping-cart',
                route: '/sales',
            },
            {
                label: 'Shipment',
                route: '/shipment',
                icon: 'pi pi-forward',
            },
        ],
    },
]);
</script>

<template>
    <div class="relative flex h-max">
        <nav class="overflow-hidden">
            <Menu class="fixed h-full !rounded-none" :model="items">
                <template #start>
                    <div class="py-3 text-center text-xl font-bold">
                        DASHBOARD
                    </div>
                </template>
                <template #item="{ item, props }">
                    <Link
                        :href="item.route"
                        :target="item.target"
                        v-bind="props.action"
                    >
                        <span :class="item.icon" />
                        <span class="ml-2">{{ item.label }}</span>
                    </Link>
                </template>
            </Menu>
        </nav>
        <main class="ml-48 flex-1 bg-gray-100">
            <!-- <Menubar /> -->
            <Menubar class="!rounded-none border-none">
                <template #end>
                    <div class="hidden sm:ms-6 sm:flex sm:items-center">
                        <!-- Settings Dropdown -->
                        <div class="relative ms-3">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button
                                            type="button"
                                            class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                                        >
                                            {{ $page.props.auth.user.name }}

                                            <svg
                                                class="-me-0.5 ms-2 h-4 w-4"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                    </span>
                                </template>

                                <template #content>
                                    <DropdownLink :href="route('profile.edit')">
                                        Profile
                                    </DropdownLink>
                                    <DropdownLink
                                        :href="route('logout')"
                                        method="post"
                                        as="button"
                                    >
                                        Log Out
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                        </div>
                    </div>
                </template>
            </Menubar>
            <div>
                <slot />
            </div>
        </main>
    </div>
</template>
