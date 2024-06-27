<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-6 gap-4">
                    <div class="col-span-2 p-2 lg:p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <table class="w-full table-auto">
                            <thead>
                            <tr class="text-left">
                                <th>Category</th>
                                <th>Expected Spending</th>
                                <th>Actual Spending</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Fuel</td>
                                <td>$500</td>
                                <td>$400</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-span-4 p-2 lg:p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <table class="w-full">
                            <thead>
                            <tr class="text-left">
                                <th>Category</th>
                                <th>Description</th>
                                <th>Vendor</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Account</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Fuel</td>
                                <td>Fuel</td>
                                <td>Fuel</td>
                                <td>Fuel</td>
                                <td>$500</td>
                                <td>$400</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
