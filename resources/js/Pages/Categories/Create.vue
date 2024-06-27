<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

const form = reactive({
    name: null,
    default_expected_spending: null,
})

function submit() {
    router.post('/categories', form)
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
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <form @submit.prevent="submit">
                        <label for="name">Name:</label>
                        <input id="name" v-model="form.name" />
                        <label for="default_expected_spending">Default Expected Spending:</label>
                        <input id="default_expected_spending" v-model="form.default_expected_spending" />
                        <button type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
