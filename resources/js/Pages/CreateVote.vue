<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';


const form = useForm({
    title: '',
    description: '',
    expiryDate: '',
    options: [{ name: '' }] // Initialize with one empty option
});

function addOption() {
    form.options.push({ name: '' });
}

function removeOption(index) {
    form.options.splice(index, 1);
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Balsojuma veidošana</h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Izveidot jaunu balsojumu un rediģēt to.</p>
                    </header>
                    <form @submit.prevent="form.post(route('votes.store'))" class="mt-6 space-y-6">
                        <div>
                            <InputLabel for="title" value="Nosaukums" />
                            <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus />
                            <InputError class="mt-2" :message="form.errors.title" />
                        </div>
                        <div>
                            <InputLabel for="description" value="Apraksts" />
                            <TextInput id="description" type="text" class="mt-1 block w-full" v-model="form.description" required  maxlength="1000" />
                            <InputError class="mt-2" :message="form.errors.description" />
                        </div>
                        <div>
                            <InputLabel for="expiryDate" value="Darbības ilgums" />
                            <TextInput id="expiryDate" type="date" class="mt-1 block w-full" v-model="form.expiryDate" required />
                            <InputError class="mt-2" :message="form.errors.expiryDate" />
                        </div>
                        <div>
                            <InputLabel value="Vēlamo variantu pievienošana" />
                            <template v-for="(option, index) in form.options" :key="index">
                                <div class="flex items-center gap-4">
                                    <TextInput
                                        v-model="option.name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        placeholder="Varianta nosaukums"
                                    />
                                    <button @click="removeOption(index)" type="button" class="px-4 py-2 text-sm font-medium text-red-600 bg-red-100 rounded-md hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-500">Izņemt</button>
                                </div>
                            </template>
                            <button @click="addOption" type="button" class="mt-2 px-4 py-2 text-sm font-medium text-blue-600 bg-blue-100 rounded-md hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500">Pievienot</button>
                        </div>
                        <div class="flex items-center gap-4">
                            <PrimaryButton :disabled="form.processing">Izveidot</PrimaryButton>
                            <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0" leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">Saglabāts</p>
                            </Transition>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


<style>

</style>