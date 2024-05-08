<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="flex">
        <!-- Sidebar -->
        <div :class="`min-h-screen bg-white dark:bg-gray-900 w-64 hidden sm:block`">
            <div class="flex justify-center ">
                <div class="dark:text-gray-100 font-bold text-3xl m-1">
                    Workkit
                </div>
            </div>
            <aside class="m-6">
                <div class="dark:text-gray-100 font-bold">
                    APPS
                </div>
                <div>
                    <div class="p-2 dark:text-gray-100 font-semibold  items-center">
                        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </NavLink>

                    </div>
                    <div class="p-2 dark:text-gray-100 font-semibold  items-center">
                        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Projects
                        </NavLink>

                    </div>
                    <div class="p-2 dark:text-gray-100 font-semibold  items-center">
                        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Calendar
                        </NavLink>

                    </div>
                    <div class="p-2 dark:text-gray-100 font-semibold  items-center">
                        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Chat
                        </NavLink>

                    </div>
                    <div class="p-2 dark:text-gray-100 font-semibold  items-center">
                        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Team
                        </NavLink>

                    </div>
                </div>
                <div class="dark:text-gray-100 font-semibold">
                    PROJECTS
                </div>
                <div>
                    <div class="p-2 dark:text-gray-100 font-semibold  items-center">
                        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Project1
                        </NavLink>

                    </div>
                    <div class="p-2 dark:text-gray-100 font-semibold  items-center">
                        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Project2
                        </NavLink>

                    </div>
                    <div class="p-2 dark:text-gray-100 font-semibold  items-center">
                        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Project3
                        </NavLink>

                    </div>
                    <div class="p-2 dark:text-gray-100 font-semibold  items-center">
                        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Project4
                        </NavLink>

                    </div>
                </div>

            </aside>
        </div>


        <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex-1">
            <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                <!-- Primary Navigation Menu -->

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-end h-16">

                        <div class="hidden sm:flex  sm:items-center sm:ms-6">
                            <!-- Settings Dropdown -->
                            <div class="ms-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.name }}

                                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white dark:bg-gray-800 shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
