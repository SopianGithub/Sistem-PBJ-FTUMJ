<template>
     <app-layout title="Sistem Informasi Pengadaan Barang & Jasa">
        <main class="flex w-full h-screen">
            <SidebarAdmin />
            <section class="w-full p-4">
                <div class="w-full h-screen p-4 text-md">
                    <h1 class="font-bold text-3xl text-center border-b-2 border-red-500">Pengelolaan Konten Web</h1>

                    <Link :href="route('Admin.cms.create')" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Tambah Baru</Link>

                    <select name="perPage" id="perPage" class="m-4 rounded-lg" v-model="page" @change="search">
                        <option v-for="item in listPage" :value="item" >{{item}}</option>
                    </select>

                    <input type="text" name="table_search" class="form-control float-right m-4 rounded-lg" placeholder="Search" v-model="term" @keyup="search">
                    <div class="relative max-h-96 max-w-screen-lg overflow-auto">
                        <table class="table table-auto w-full mt-4">
                        <thead>
                            <tr>
                                <HeaderTable :color="color" :headCols="listCols" />
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in listData.data" :key="item.id">
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4">{{ item.rownum }}</td> 
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4">{{ item.categories }}</td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4">{{ item.title }}</td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4" v-html="item.content"></td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4">
                                <div class="flex space-x-2">
                                    <div class="item">
                                        <Link :href="route('Admin.cms.edit', {id: item.id})">
                                        <jet-button type="button">
                                            Edit
                                        </jet-button>
                                        </Link>
                                    </div>
                                    <div class="item">
                                        <jet-danger-button type="button" @click="deleteAction(item.id)">
                                            Hapus
                                        </jet-danger-button>
                                    </div>
                                </div>      
                            </td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                    
                    <pagination class="mt-6 float-right" :links="listData.links" :perPage="page" :searchStr="term" />
                </div>
            </section>
        </main>
    </app-layout>
    <Footer />
</template>

<script>
import { defineComponent } from 'vue'
import { Head, Link } from '@inertiajs/inertia-vue3';


import AppLayout from '@/Layouts/AppLayout.vue'
import SidebarAdmin from '@/Components/SidebarAdmin.vue';
import JetButton from '@/Jetstream/Button.vue'
import JetDangerButton from '@/Jetstream/DangerButton.vue'
import Footer from '@/Components/Footer.vue';
import Pagination from '@/Components/Pagination.vue'
import HeaderTable from '@/Components/HeaderTable.vue'

export default defineComponent({
    components: {
        Head,
        Link,
        AppLayout,
        SidebarAdmin,
        JetButton,
        JetDangerButton,
        Footer,
        Pagination,
        HeaderTable,
    },
    props: {
        listData: Object,
        perPagePrm: Number,
        termPrm:  String
    },
    data() {
        return {
            color:  "light",
            term: this.termPrm !=  null ? this.termPrm :  '',
            page: this.perPagePrm != null ? this.perPagePrm : 10,
            listPage: [5, 10, 15, 20, 30, 50, 100],
            listCols: ['No', 'Kategori', 'Title', 'Konten', 'Actions']
        }
    },
    methods: {
        search() {
            this.$inertia.replace(this.route('Admin.cms.index', {term: this.term, perPage: this.page}))
        },
        deleteAction(id){
            if (confirm('Apakah Anda Yakin Untuk Menghapus Usulan Ini?')) {
                this.$inertia.delete(`/Admin/cms/delete/${id}`)
            }
        },
    }
})
</script>