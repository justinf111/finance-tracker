<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {Link, router, useForm} from "@inertiajs/vue3";
import {reactive, ref} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

const date = ref();

defineProps({
    categories: Object,
})

const form = useForm({
    name: null,
    default_expected_spending: null,
})

async function submit() {
    await router.post('/categories', form)
    categoryBeingCreated.value = null;
    form.reset();
}

const categoryBeingCreated = ref(null);
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Budget
            </h2>
        </template>

        <div class="py-12">
            <div class="w-full mx-auto sm:px-6 lg:px-8">
                <VueDatePicker v-model="date" month-picker auto-apply></VueDatePicker>
                <ConfirmationModal :show="categoryBeingCreated != null" @close="categoryBeingCreated = null">
                    <template #title>
                        Create Category
                    </template>

                    <template #content>
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
                    </template>

                    <template #footer>
                        <SecondaryButton @click="categoryBeingCreated = null">
                            Cancel
                        </SecondaryButton>

                        <PrimaryButton
                            class="ms-3"
                            @click="submit"
                        >
                            Create Category
                        </PrimaryButton>
                    </template>
                </ConfirmationModal>
                <div class="grid grid-cols-6 gap-4">
                    <div class="col-span-4 p-2 lg:p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <button class="cursor-pointer text-sm" @click="categoryBeingCreated = true">
                            Create Category
                        </button>
                        <table class="w-full table-auto">
                            <thead>
                            <tr class="text-left">
                                <th>Category</th>
                                <th>Budget</th>
                                <th>Activity</th>
                                <th>Available</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="category in categories">
                                <td>{{ category.name }}</td>
                                <td>${{ category.default_expected_spending }}</td>
                                <td>${{ category.total }}</td>
                                <td>${{ category.available }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
