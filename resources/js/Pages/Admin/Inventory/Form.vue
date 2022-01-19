<template>
    <Head title="List Lelalang -  Pengadaan Barang & Jasa" />
    <app-layout title="Sistem Informasi Pengadaan Barang & Jasa">
        <main class="flex w-full h-screen">
            <SidebarAdmin />
            <section class="w-full p-4">
                <div class="w-full h-screen p-4 text-md">
                    <h1 class="font-bold text-3xl text-center border-b-2 border-red-500">{{ title }} Daftar Pengadaan Barang & Jasa</h1>

                    <form @submit.prevent="submit" enctype="multipart/form-data" class="mt-8">
                        <div class="grid grid-cols-3 gap-4 p-2">
                            <div>
                                <jet-label for="name" value="Nama Barang" />
                            </div>
                            <div class="col-span-2">
                                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.nama_barang" required autofocus autocomplete="name" placeholder="Nama Barang" />
                                <div v-if="errors.nama_barang">{{ errors.nama_barang }}</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-4 p-2">
                            <div>
                                <jet-label for="jumlah" value="Jumlah" />
                            </div>
                            <div class="col-span-2">
                                <jet-input id="jumlah" type="number" class="mt-1 block w-full" v-model="form.jumlah" required autofocus autocomplete="name" placeholder="Jumlah" />
                                <div v-if="errors.jumlah">{{ errors.jumlah }}</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-4 p-2">
                            <div>
                                <jet-label for="unit" value="Unit" />
                            </div>
                            <div class="col-span-2">
                                <jet-input id="unit" type="text" class="mt-1 block w-full" v-model="form.unit" required autofocus autocomplete="name" placeholder="Unit" />
                                <div v-if="errors.unit">{{ errors.unit }}</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-4 p-2">
                            <div>
                                <jet-label for="status" value="Status" />
                            </div>
                            <div class="col-span-2">
                                <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                                    <input type="checkbox" name="toggle" id="toggle" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer" v-model="form.isActive" v-on:click="changeActive('Active', $event)"/>
                                    <label for="toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                                </div>
                                <label for="toggle" class="text-xs text-gray-700">Aktif</label>
                            </div>
                        </div>

                         <div class="grid grid-cols-3 gap-4 p-2">
                            <div>
                                <jet-danger-button type="button">
                                    <Link :href="route('Admin.inventory.index')">Batal</Link>
                                </jet-danger-button>
                            </div>
                            <div class="col-span-2">
                                <jet-button type="submit" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Simpan
                                </jet-button>
                            </div>
                        </div>

                    </form>
                </div>
            </section>
        </main>
    </app-layout>
    <Footer />
</template>

<style>
.toggle-checkbox:checked {
  @apply: right-0 border-green-400;
  right: 0;
  border-color: #68D391;
}
.toggle-checkbox:checked + .toggle-label {
  @apply: bg-green-400;
  background-color: #68D391;
}
</style>

<script>
import { defineComponent } from 'vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetDangerButton from '@/Jetstream/DangerButton.vue'

import AppLayout from '@/Layouts/AppLayout.vue'
import SidebarAdmin from '@/Components/SidebarAdmin.vue';
import Footer from '@/Components/Footer.vue';
import Pagination from '@/Components/Pagination.vue'

export default defineComponent({
    components: {
        Head,
        Link,
        JetInput,
        JetLabel,
        JetButton,
        JetDangerButton,
        AppLayout,
        SidebarAdmin,
        Footer,
        Pagination
    },
    props: {
        errors: Object,
        Action: String,
        dataEdit: Object
    },
    data() {
        console.log(this.Action);
        let formInput = this.$inertia.form({
                nama_barang: '',
                jumlah: '',
                unit: '',
                isActive: true,
                status: 1,
            });
            if(this.Action == "Update"){
                formInput = this.$inertia.form({
                    _method: 'put',
                    nama_barang: this.dataEdit.nama_barang,
                    jumlah: this.dataEdit.jumlah,
                    unit: this.dataEdit.unit,
                    isActive: true,
                    status: 1,
                });
            }
            return {
                form: formInput,
                title: this.Action == "Update" ? "Edit" : "Tambah",
                ActionForm: this.Action == "Update" ? "Edit" : "Tambah",
            }
    },
    methods: {
        submit() {
            if(this.Action == "Update"){
                this.form.post(this.route("Admin.inventory.update", { id: this.dataEdit.id}),  {
                    forceFormData: true,
                });
            }else{
                this.form.post(this.route("Admin.inventory.store"),  {
                    forceFormData: true,
                });
            }
        },
        changeActive(value,event){
            this.form.isActive = event.target.checked;
            this.form.status = event.target.checked ? 1 : 0
        }
    }
})
</script>