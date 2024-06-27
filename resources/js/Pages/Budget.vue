<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    transactions: Object,
    categories: Object,
})
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="w-full mx-auto sm:px-6 lg:px-8">
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
                            <tr v-for="category in categories">
                                <td>{{ category.name }}</td>
                                <td>{{ category.default_expected_spending}}</td>
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
                            <tr v-for="transaction in transactions">
                                <td>Fuel</td>
                                <td>{{ transaction.description}}</td>
                                <td>{{ transaction.vendor}}</td>
                                <td>{{ transaction.amount}}</td>
                                <td>{{ transaction.created_at}}</td>
                                <td>CBA Credit Card</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
