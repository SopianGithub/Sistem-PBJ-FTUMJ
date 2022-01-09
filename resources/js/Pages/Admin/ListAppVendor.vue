<template>
    <!-- <Head title="List Lelalang -  Pengadaan Barang & Jasa" /> -->
    <app-layout title="Sistem Informasi Pengadaan Barang & Jasa">
        <main class="flex w-full h-screen">
            <SidebarAdmin />
            <section class="w-full p-4">
                <div class="w-full h-screen p-4 text-md">
                    <h1 class="font-bold text-3xl text-center border-b-2 border-red-500">Daftar Pengadaan Barang & Jasa</h1>

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
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4">{{ item.id }}</td> 
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4">{{ item.nama_lengkap }}</td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4">{{ item.tempat_lahir }}</td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4">{{ item.tanggal_lahir }}</td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4">{{ item.nama_badan_usaha }}</td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4">{{ item.alamat_badan_usaha }}</td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4">{{ item.nomor_hp }}</td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4">{{ item.email }}</td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4">{{ item.alamat_web }}</td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4">
                                <div class="flex space-x-2">
                                    <div class="item">
                                        <Link :href="route('Admin.penawaran.edit', {id: item.id})">
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
                                    <div class="item">
                                        <jet-button type="button" @click="cetak(item)">
                                            Cetak
                                        </jet-button>
                                    </div>
                                </div>      
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4">{{ item.status_pbj }}</td>
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

import pdfMake from 'pdfmake';
import pdfFonts from 'pdfmake/build/vfs_fonts';
import htmlToPdfmake from 'html-to-pdfmake';

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
        pdfMake,
        pdfFonts,
        htmlToPdfmake
    },
    props: {
        listData: Object,
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
            listPage: [5, 10, 15, 20, 30, 50, 100],
            listCols: ['No', 'Nama Lengkap', 'Tempat Lahir', 'Tanggal Lahir', 'Nama Badan Usaha', 'Alamat Badan Usaha', 'No HP', 'Email', 'Alamat Website','Opsi', 'Status']
        }
    },
    methods: {
        search() {
            this.$inertia.replace(this.route('listInvent', {term: this.term, perPage: this.page}))
        },
        deleteAction(id){
            if (confirm('Apakah Anda Yakin Untuk Menghapus Usulan Ini?')) {
                this.$inertia.delete(`/Validator/delete/${id}`)
            }
        },
        cetak(items){
            var html = htmlToPdfmake(`
                    <h2 style="text-align: center; font-size: 36px; margin-bottom: 10px;"><b>Penawaran Barang & Jasa</b></h2>
                    <hr/>
                    <div class="with-margin">
                        <table style="border: none !important;">
                            <tr>
                                <th style="width:200px; margin: 20px;">Nama Lengkap</th>
                                <th style="width:200px; margin: 20px; text-align: center">${items.nama_lengkap}</th>
                            </tr>
                            <tr>
                                <th style="width:200px; margin: 20px;">Tempat Lahir</th>
                                <th style="width:200px; margin: 20px; text-align: center">${items.tempat_lahir}</th>
                            </tr>
                            <tr>
                                <th style="width:200px; margin: 20px;">Tanggal Lahir</th>
                                <th style="width:200px; margin: 20px; text-align: center">${items.tanggal_lahir}</th>
                            </tr>
                            <tr>
                                <th style="width:200px; margin: 20px;">Nama Badan Usaha</th>
                                <th style="width:200px; margin: 20px; text-align: center">${items.nama_badan_usaha}</th>
                            </tr>
                            <tr>
                                <th style="width:200px; margin: 20px;">Alamat Badan Usaha</th>
                                <th style="width:200px; margin: 20px; text-align: center">${items.alamat_badan_usaha}</th>
                            </tr>
                            <tr>
                                <th style="width:200px; margin: 20px;">No HP</th>
                                <th style="width:200px; margin: 20px; text-align: center">${items.nomor_hp}</th>
                            </tr>
                            <tr>
                                <th style="width:200px; margin: 20px;">Email</th>
                                <th style="width:200px; margin: 20px; text-align: center">${items.email}</th>
                            </tr>
                            <tr>
                                <th style="width:200px; margin: 20px;">Alamat Web</th>
                                <th style="width:200px; margin: 20px; text-align: center">${items.alamat_web}</th>
                            </tr>
                        </table>
                    </div>
                `);
            
            const documentDefinition = { 
                content: html,
                styles:{
                    red:{ // we define the class called "red"
                        color:'red'
                    },
                    'with-margin':{
                        marginLeft: 120
                    }
                },
                tableAutoSize: true,
                margin: [0, 5, 0, 10],
            };
            pdfMake.vfs = pdfFonts.pdfMake.vfs;
            pdfMake.createPdf(documentDefinition).open();   
        }
    }
})
</script>