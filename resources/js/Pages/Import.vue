<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    transactions: null,
    account: "",
    bank: "",
})

function submit() {
    form.post('/transactions/import')
}

defineProps({
    accounts: Object,
    banks: Array,
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
                <div class="p-2 lg:p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="container mx-auto">
                        <h2 class="text-2xl font-bold mb-4">Import Transactions</h2>
                        <form @submit.prevent="submit">
                            <div class="mb-4">
                                <label for="file" class="block text-gray-700">Upload File</label>
                                <input type="file" @input="form.transactions = $event.target.files[0]" />
                                <select v-model="form.account">
                                    <option disabled value="">Please select an account</option>
                                    <option v-for="(account, index) in accounts" :value="index" :key="index">{{account}}</option>
                                </select>
                                <select v-model="form.bank">
                                    <option disabled value="">Please select a bank</option>
                                    <option v-for="bank in banks" :value="bank.value" :key="bank.value">{{bank.name}}</option>
                                </select>
                            </div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Import</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
