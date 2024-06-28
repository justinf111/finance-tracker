<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {router, useForm} from '@inertiajs/vue3'
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {reactive, ref} from "vue";
import TextInput from "@/Components/TextInput.vue";

defineProps({
    transactions: Object,
    categories: Object,
    accounts: Object,
    banks: Array,
})

const updateTransaction = async (transaction) => {
    router.patch(route('transactions.update', transaction.id), {
        category_id: transaction.category_id,
        description: transaction.description,
    })
};

const importTransactionForm = useForm({
    transactions: null,
    account: "",
    bank: "",
})

function importTransactions() {
    form.post('/transactions/import')
}

const createAccountForm = useForm({
    name: null,
    starting_balance: null,
})

function createAccount() {
    router.post('/accounts', form)
}

const transactionsBeingImported = ref(null);
const accountBeingCreated = ref(null);

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Accounts
            </h2>
        </template>

        <div class="py-12">
            <div class="w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <ConfirmationModal :show="accountBeingCreated != null" @close="accountBeingCreated = null">
                        <template #title>
                            Create Account
                        </template>

                        <template #content>
                            <div class="mb-4">
                                <TextInput
                                    type="text"
                                    class="mb-2 block w-3/4"
                                    placeholder="Name"
                                    v-model="createAccountForm.name"
                                />

                            </div>
                            <div class="mb-4">
                                <TextInput
                                    type="text"
                                    class="mb-2 block w-3/4"
                                    placeholder="Starting Balance"
                                    v-model="createAccountForm.starting_balance"
                                />
                            </div>
                        </template>

                        <template #footer>
                            <SecondaryButton @click="accountBeingCreated = null">
                                Cancel
                            </SecondaryButton>

                            <PrimaryButton
                                class="ms-3"
                                @click="createAccount"
                            >
                                Import
                            </PrimaryButton>
                        </template>
                    </ConfirmationModal>

                    <ConfirmationModal :show="transactionsBeingImported != null" @close="transactionsBeingImported = null">
                        <template #title>
                            Import Transactions
                        </template>

                        <template #content>
                                <div class="mb-4">
                                    <input type="file" @input="importTransactionForm.transactions = $event.target.files[0]" />
                                </div>
                                <div class="mb-4">
                                    <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-2/4" v-model="importTransactionForm.account">
                                        <option disabled value="">Please select an account</option>
                                        <option v-for="(account, index) in accounts" :value="index" :key="index">{{account}}</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-2/4" v-model="importTransactionForm.bank">
                                        <option disabled value="">Please select a bank</option>
                                        <option v-for="bank in banks" :value="bank.value" :key="bank.value">{{bank.name}}</option>
                                    </select>
                                </div>
                        </template>

                        <template #footer>
                            <SecondaryButton @click="transactionsBeingImported = null">
                                Cancel
                            </SecondaryButton>

                            <PrimaryButton
                                class="ms-3"
                                @click="importTransactions"
                            >
                                Import
                            </PrimaryButton>
                        </template>
                    </ConfirmationModal>
                    <button class="cursor-pointer ms-6 text-sm text-red-500" @click="transactionsBeingImported = true">
                        Import
                    </button>
                    <button class="cursor-pointer ms-6 text-sm text-red-500" @click="accountBeingCreated = true">
                        Create Account
                    </button>
                    <div class="col-span-4 p-2 lg:p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <table class="w-full">
                            <thead>
                            <tr class="text-left text-sm">
                                <th>Category</th>
                                <th>Description</th>
                                <th>Vendor</th>
                                <th>Amount</th>
                                <th class="w-35">Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="transaction in transactions" class="text-sm">
                                <td>
                                    <select v-model="transaction.category_id" @change="updateTransaction(transaction)">
                                        <option v-for="category in categories" :value="category.id" :key="category.id">{{ category.name }}</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" v-model="transaction.description" @change="updateTransaction(transaction)" class="w-full">
                                </td>
                                <td>{{ transaction.vendor}}</td>
                                <td>{{ transaction.amount}}</td>
                                <td>{{ transaction.created_at}}</td>
                                <td>{{ transaction.account.name}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
