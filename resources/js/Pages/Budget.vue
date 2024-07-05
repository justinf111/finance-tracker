<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {router, useForm} from "@inertiajs/vue3";
import {ref} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

let props = defineProps({
    categories: Object,
    budget: Object,
})

let date = ref();

const budgetSearch = async ({ instance, month, year }) => {
    await router.get(route('budget.search'), {
        month: month + 1,
        year: year,
    })
    date.value.month = month + 1
    date.value.year = year
};

const updateCategory = async (category, budget) => {
    router.put(route('categories.update', { category: category.id, budget: budget.id }), {
        name: category.name,
        expected_spending: category.expectedSpending,
    })
};

const form = useForm({
    name: null,
    default_expected_spending: null,
})

async function submit() {
    await router.post('/categories', form)
    categoryBeingCreated.value = null;
    form.reset();
}

const transactions = ref(null);
const currentCategory = ref(null);
const editMode = ref(null);
const editingCategory = ref(null);
const viewingCategoryTransactions = ref(null);
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
                <VueDatePicker v-model="date" month-picker auto-apply @update-month-year="budgetSearch"></VueDatePicker>
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

                <ConfirmationModal max-width="3xl" :show="viewingCategoryTransactions != null" @close="viewingCategoryTransactions = null">
                    <template #title>
                        Transactions
                    </template>

                    <template #content>
                        <table class="w-full text-sm">
                            <thead>
                            <tr class="text-left">
                                <th>Category</th>
                                <th>Description</th>
                                <th>Vendor</th>
                                <th>Amount</th>
                                <th class="w-35">Date</th>
                                <th>Account</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="transaction in transactions">
                                <td>{{ currentCategory.name }}</td>
                                <td>{{ transactions.description }}</td>
                                <td>{{ transaction.vendor}}</td>
                                <td>{{ transaction.amount}}</td>
                                <td>{{ transaction.created_at}}</td>
                                <td>{{ transaction.account.name}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </template>

                    <template #footer>
                        <SecondaryButton @click="viewingCategoryTransactions = null">
                            Close
                        </SecondaryButton>
                    </template>
                </ConfirmationModal>
                <div class="grid grid-cols-6 gap-4">
                    <div class="col-span-4 p-2 lg:p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <button class="cursor-pointer text-sm" @click="categoryBeingCreated = true">
                            Create Category
                        </button>
                        <table class="w-full table-auto">
                            <thead>
                            <tr class="text-left text-sm">
                                <th>Category</th>
                                <th>Budget</th>
                                <th>Activity</th>
                                <th>Available</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="category in categories" class="text-sm">
                                <td>{{ category.name }}</td>
                                <td>
                                    <div @mouseover="editingCategory = category.id" @mouseleave="editingCategory = false">
                                        <div v-if="editingCategory == category.id" @click="editMode = true">
                                            <input
                                                v-if="editMode"
                                                v-model="category.expectedSpending"
                                                @blur="updateCategory(category, budget)"
                                                class="border p-1"
                                            />
                                            <div v-else>
                                                <span>${{ category.expectedSpending }}</span>
                                            </div>
                                        </div>
                                        <div v-else>
                                            <span>${{ category.expectedSpending }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button v-if="category.transactions.length > 0" class="cursor-pointer text-sm" @click="viewingCategoryTransactions = true; transactions = category.transactions; currentCategory = category">
                                        ${{ category.total }}
                                    </button>
                                    <span v-else>
                                        ${{ category.total }}
                                    </span>
                                </td>
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
