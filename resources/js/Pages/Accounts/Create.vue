<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

const form = reactive({
    name: null,
    starting_balance: null,
})

function submit() {
    router.post('/accounts', form)
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
                        <label for="name">Account Name:</label>
                        <input id="name" v-model="form.name" />
                        <label for="starting_balance">Starting Balance:</label>
                        <input id="starting_balance" v-model="form.starting_balance" />
                        <button type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
