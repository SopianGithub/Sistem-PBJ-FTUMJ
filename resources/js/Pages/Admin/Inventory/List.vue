<template>
    <!-- <Head title="List Lelalang -  Pengadaan Barang & Jasa" /> -->
    <app-layout title="Sistem Informasi Pengadaan Barang & Jasa">
        <main class="flex w-full h-screen">
            <SidebarAdmin />
            <section class="w-full p-4">
                <div class="w-full h-screen p-4 text-md">
                    <h1 class="font-bold text-3xl text-center border-b-2 border-red-500">Kelola Daftar Pengadaan Barang & Jasa</h1>

                    <Link :href="route('Admin.inventory.create')" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Tambah Baru</Link>

                    <select name="perPage" id="perPage" class="m-4 rounded-lg" v-model="page" @change="search">
                        <option v-for="item in listPage" :value="item" >{{item}}</option>
                    </select>

                    <input type="text" name="table_search" class="form-control float-right m-4 rounded-lg" placeholder="Search" v-model="term" @keyup="search">

                    <table class="table table-auto w-full mt-4">
                    <thead>
                        <tr>
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="[
                                color === 'light'
                                ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                            ]">#No</th>
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="[
                                color === 'light'
                                ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                            ]">Nama Barang</th>
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="[
                                color === 'light'
                                ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                            ]">Jumlah</th>
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="[
                                color === 'light'
                                ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                            ]">Unit</th>
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="[
                                color === 'light'
                                ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                            ]">Status</th>
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="[
                                color === 'light'
                                ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                            ]">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in inventList.data" :key="item.id">
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4">{{ item.id }}</td> 
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4">{{ item.nama_barang }}</td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4">{{ item.jumlah }}</td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4">{{ item.unit }}</td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4">{{ item.status }}</td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4">
                            <div class="flex space-x-2">
                                <Link :href="route('Admin.inventory.edit', {id: item.id})" >
                                    <jet-button class="item" type="button" >
                                        Edit
                                    </jet-button>
                                </Link>
                                <jet-danger-button class="item" type="button" @click="deleteAction(item.id)">
                                    Hapus
                                </jet-danger-button>
                            </div>
                        </td>
                        </tr>
                    </tbody>
                    </table>
                    
                    <pagination class="mt-6 float-right" :links="inventList.links" :perPage="page" :searchStr="term" />
                </div>
            </section>
        </main>
    </app-layout>
    <Footer />
</template>

<script>
import { defineComponent } from 'vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

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
        JetButton,
        JetDangerButton,
        AppLayout,
        SidebarAdmin,
        Footer,
        Pagination
    },
    props: {
        inventList: Object,
        perPagePrm: Number,
        termPrm:  String
    },
    created() {
        console.log(this.inventList)
    },
    data() {
        return {
            color:  "light",
            term: this.termPrm !=  null ? this.termPrm :  '',
            page: this.perPagePrm != null ? this.perPagePrm : 10,
            listPage: [5, 10, 15, 20, 30, 50, 100]
        }
    },
    methods: {
        search() {
            this.$inertia.replace(this.route('Admin.inventory.index', {term: this.term, perPage: this.page}))
        },
        deleteAction(id, jenis_usulan){
            if (confirm('Apakah Anda Yakin Untuk Menghapus Usulan Ini?')) {
                this.$inertia.delete(`/Admin/inventory/delete/${id}`)
            }
        },
    }
})
</script>