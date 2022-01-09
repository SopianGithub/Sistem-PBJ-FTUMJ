<template>
    <app-layout title="Sistem Informasi Pengadaan Barang & Jasa">
        <main class="flex w-full h-screen">
            <SidebarAdmin />
            <section class="container p-4">
                <div class="w-full max-h-full max-w-full overflow-auto">
                    <h1 class="font-bold text-lg text-center border-b-2 border-red-500">Form Data User</h1>

                    <form @submit.prevent="submit" class="mx-4 my-2">
                        <div>
                            <jet-label for="name" value="Name" />
                            <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                        </div>

                        <div class="mt-4">
                            <jet-label for="email" value="Email" />
                            <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required />
                        </div>

                        <div class="mt-4">
                            <jet-label for="password" value="Password" />
                            <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
                        </div>

                        <div class="mt-4">
                            <jet-label for="password_confirmation" value="Confirm Password" />
                            <jet-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
                        </div>

                        <div class="mt-4">
                            <jet-label for="tipe_user" value="Tipe User" />
                            <select name="tipe_user" id="tipe_user" class="border-gray-300 w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" @change="selectTypeUser($event)">
                                <option v-for="user in tipeUserArr" :value="user">{{ user }}</option>
                            </select>    
                        </div>

                        <div class="mt-4" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                            <jet-label for="terms">
                                <div class="flex items-center">
                                    <jet-checkbox name="terms" id="terms" v-model:checked="form.terms" />

                                    <div class="ml-2">
                                        I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                                    </div>
                                </div>
                            </jet-label>
                        </div>

                        <div class="flex items-center justify-end mt-4">

                            <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Register
                            </jet-button>
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </app-layout>
    
</template>

<style type="text/css">
    input:checked + svg {
        display: block;
    }
</style>

<script>
    import { defineComponent, ref } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import SidebarAdmin from '@/Components/SidebarAdmin.vue';
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import JetButton from '@/Jetstream/Button.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetCheckbox from '@/Jetstream/Checkbox.vue'
    import JetLabel from '@/Jetstream/Label.vue'

    export default defineComponent({
        components: {
            AppLayout,
            SidebarAdmin,
            Head, Link,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel
        },
        props: {
            errors: Object,
            dataEdit: Object,
            Actions: String,
        },
        data() {
            let formUsers =  this.$inertia.form({
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                terms: false,
                tipe_user: 'Admin',
            });
            if(this.Actions == "Update"){
               formUsers =  this.$inertia.form({
                    _method: 'put',
                    name: this.dataEdit.name ?? '',
                    email: this.dataEdit.email ?? '',
                    password: this.dataEdit.password ?? '',
                    password_confirmation: this.dataEdit.password ?? '',
                    terms: false,
                    tipe_user: this.dataEdit.tipe_user ?? 'Admin',
                }); 
            }
            return {
                form: formUsers,
                tipeUserArr: ['Admin',  'PBJ',  'Pengusul', 'Validator']
            }
        },
        methods: {
            submit() {
                if(this.Actions == "Update"){
                    this.form.post(this.route("Admin.users.update", {id: this.dataEdit.id}));
                }else{
                    this.form.post(this.route("Admin.users.store"));
                }
                
            },
            selectTypeUser(event){
                this.form.tipe_user = event.target.value;
            }
        },
    })
</script>
