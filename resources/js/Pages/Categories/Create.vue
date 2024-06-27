<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import TextInput from "@/Components/TextInput.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

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
            <div class="w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2 lg:p-4">
                    <h1>Create Category</h1>
                    <form @submit.prevent="submit">
                        <TextInput
                            v-model="form.name"
                            type="text"
                            class="mb-2 block w-3/4"
                            placeholder="Name"
                        />

                        <TextInput
                            v-model="form.default_expected_spending"
                            type="text"
                            class="mb-2 block w-3/4"
                            placeholder="Default Expected Spending"
                        />

                        <PrimaryButton>
                            Submit
                        </PrimaryButton>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
