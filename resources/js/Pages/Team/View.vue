<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';


const props = defineProps(['team', 'users'])
console.log(props.team)


const formatDate = (created_at) => {
    const date = new Date(created_at);
   
    return date.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric',hour:'2-digit' });

}
</script>

<template>

    <Head :title="team.name" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Team</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">{{ team.name }}</div>
                </div>
                <div class="overflow-x-auto mt-2">
                    <table
                        class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm shadow-sm sm:rounded-lg dark:divide-gray-700 dark:bg-gray-800">
                        <thead class="text-left">
                            <tr>
                                <th class="sticky inset-y-0 start-0  px-4 py-2 ">
                                    <label for="SelectAll" class="sr-only">Select All</label>

                                    <input type="checkbox" id="SelectAll"
                                        class="size-5 rounded border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:focus:ring-offset-gray-900" />
                                </th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">Name
                                </th>

                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">Role
                                </th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                    Created at
                                </th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                    Salary
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 shadow-sm sm:rounded-lg">
                            <tr v-for="user in users">
                                <td class="sticky inset-y-0 start-0 bg-white px-4 py-2 dark:bg-gray-800">
                                    <label class="sr-only" for="Row1">Row 1</label>

                                    <input
                                        class="size-5 rounded border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:focus:ring-offset-gray-900"
                                        type="checkbox" id="Row1" />
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                    {{ user.fullName }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">{{ user.role }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">{{
                                    formatDate(user.created_at) }}</td>

                                <td class="whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200">$120,000</td>
                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
