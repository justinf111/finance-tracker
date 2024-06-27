<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    transactions: null,
})

function submit() {
    form.post('/transactions/import')
}
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
                <div class="p-2 lg:p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="container mx-auto">
                        <h2 class="text-2xl font-bold mb-4">Import Transactions</h2>
                        <form @submit.prevent="submit">
                            <div class="mb-4">
                                <label for="file" class="block text-gray-700">Upload File</label>
                                <input type="file" @input="form.transactions = $event.target.files[0]" />
                            </div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Import</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
