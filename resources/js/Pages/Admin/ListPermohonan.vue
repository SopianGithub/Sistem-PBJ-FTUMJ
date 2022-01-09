<template>
    <app-layout title="Sistem Informasi Pengadaan Barang & Jasa">
        <main class="flex w-full h-screen">
            <SidebarAdmin />
            <section class="w-full p-4">
                <div class="w-full h-64 p-4 text-md">

                    <h1 class="font-bold text-lg text-center border-b-2 border-red-500">Data Pengadaaan Barang & Jasa {{ title }} Dari Pengusul</h1>
                    
                    <div class="relative overflow-x-auto">
                        <!-- Notification -->
                        <div v-if="isNotificationfailed" class="flex bg-red-100 rounded-lg p-4 mb-4 text-sm text-red-700" role="alert">
                            <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            <div>
                                <span class="font-medium">Gagal!</span> Proses Approval
                            </div>
                        </div>
                        <div v-if="isNotifSuccess" class="flex bg-green-100 rounded-lg p-4 mb-4 text-sm text-green-700" role="alert">
                            <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            <div>
                                <span class="font-medium">Berhasil!</span> Proses Approval
                            </div>
                        </div>

                        <div class="relative max-w-screen-lg">
                            <select name="perPage" id="perPage" class="m-4 rounded-lg" v-model="page" @change="search">
                                <option v-for="item in listPage" :value="item" >{{item}}</option>
                            </select>

                            <input type="text" name="table_search" class="form-control w-auto float-right m-4 rounded-lg" placeholder="Search" v-model="term" @keyup="search">
                        </div>
                        <div class="relative max-h-96 max-w-screen-lg overflow-auto">
                            <table class="table-auto border-collapse w-full mt-6">
                                <thead>
                                    <tr class="rounded-lg text-sm font-medium text-gray-700 text-left">
                                        <HeaderTable :color="color" :headCols="listCols" />
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in listData.data" :key="item.id">
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4">{{ item.rownum }}</td> 
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4">{{ item.nama_pengusul }}</td>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4">{{ item.no_identitas }}</td>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4">{{ item.status_pengusul }}</td>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4">{{ item.no_hp }}</td>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4">{{ item.email }}</td>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4">{{ item.keterangan }}</td>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4">
                                        <div class="flex space-x-2">
                                            <Link :href="route('Admin.permohonan.edit', {id: item.id, jenis_usulan: item.jenis_usulan.toLowerCase()})" >
                                                <jet-button class="item" type="button" >
                                                    Edit
                                                </jet-button>
                                            </Link>
                                            <jet-danger-button class="item" type="button" @click="deleteAction(item.id, item.jenis_usulan)">
                                                Hapus
                                            </jet-danger-button>
                                            <jet-button class="item" type="button" @click="cetak(item)">
                                                Cetak
                                            </jet-button>
                                        </div>
                                    </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <pagination class="mt-6 float-right" :links="listData.links" :perPage="page" :searchStr="term" />
                    
                </div>
            </section>

            <div id="divToPrint" class="hidden">
            </div>
            
        </main>
    </app-layout>
    
</template>

<style>
  
thead tr th:first-child { border-top-left-radius: 10px; border-bottom-left-radius: 10px;}
thead tr th:last-child { border-top-right-radius: 10px; border-bottom-right-radius: 10px;}

tbody tr td:first-child { border-top-left-radius: 5px; border-bottom-left-radius: 0px;}
tbody tr td:last-child { border-top-right-radius: 5px; border-bottom-right-radius: 0px;}
</style>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';
    import axios from 'axios';
    import AppLayout from '@/Layouts/AppLayout.vue'
    import SidebarAdmin from '@/Components/SidebarAdmin.vue';
    import Pagination from '@/Components/Pagination.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetDangerButton from '@/Jetstream/DangerButton.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import HeaderTable from '@/Components/HeaderTable.vue'

    import pdfMake from 'pdfmake';
    import pdfFonts from 'pdfmake/build/vfs_fonts';
    import htmlToPdfmake from 'html-to-pdfmake';

    export default defineComponent({
        components: {
            Link,
            AppLayout,
            SidebarAdmin,
            Pagination,
            JetButton,
            JetLabel,
            JetDangerButton,
            HeaderTable,
            pdfMake,
            pdfFonts,
            htmlToPdfmake
        },
        props: {
            listData: Object,
            perPagePrm: Number,
            termPrm:  String,
            jenisUsulan: String,
        },
        data() {
            return {
                color: 'light',
                term: this.termPrm !=  null ? this.termPrm :  '',
                page: this.perPagePrm != null ? this.perPagePrm : 10,
                listPage: [5, 10, 15, 20, 30, 50, 100],
                mesageApproval: '',
                isViewNotif: false,
                isNotifSuccess: false,
                isNotificationfailed: false,
                title: this.capitalizeFirstLetter(this.jenisUsulan),
                listCols: ['No', 'Nama Pengusul', 'Nomor Identitas', 'Status Pengusul', 'No HP', 'Email', 'Keterangan', 'Opsi'],
            }
        },
        methods: {
            capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            },
            search() {
                this.$inertia.replace(this.route('PBJ.permohonan', {term: this.term, perPage: this.page, jenisUsulan: this.jenisUsulan}))
            },
            deleteAction(id, jenis_usulan){
                if (confirm('Apakah Anda Yakin Untuk Menghapus Usulan Ini?')) {
                    this.$inertia.delete(`/Admin/delete_permohonan/${id}/${jenis_usulan}`)
                }
            },
            cetak(items){
                //get table html
                const pdfTable = document.getElementById('divToPrint');
                //html to pdf format
                // var html = htmlToPdfmake(pdfTable.innerHTML);
                var html = htmlToPdfmake(`
                        <h2 style="text-align: center; font-size: 36px; margin-bottom: 10px;"><b>Permohonan Usulan Barang & Jasa</b></h2>
                        <hr/>
                        <div class="with-margin">
                            <table style="border: none !important;">
                                <tr>
                                    <th style="width:200px; margin: 20px;">Nama Pengusul</th>
                                    <th style="width:200px; margin: 20px; text-align: center">${items.nama_pengusul}</th>
                                </tr>
                                <tr>
                                    <th style="width:200px; margin: 20px;">No Identitas</th>
                                    <th style="width:200px; margin: 20px; text-align: center">${items.no_identitas}</th>
                                </tr>
                                <tr>
                                    <th style="width:200px; margin: 20px;">Status Pengusul</th>
                                    <th style="width:200px; margin: 20px; text-align: center">${items.status_pengusul}</th>
                                </tr>
                                <tr>
                                    <th style="width:200px; margin: 20px;">No HP</th>
                                    <th style="width:200px; margin: 20px; text-align: center">${items.no_hp}</th>
                                </tr>
                                <tr>
                                    <th style="width:200px; margin: 20px;">Email</th>
                                    <th style="width:200px; margin: 20px; text-align: center">${items.email}</th>
                                </tr>
                                <tr>
                                    <th style="width:200px; margin: 20px;">Keterangan</th>
                                    <th style="width:200px; margin: 20px; text-align: center">${items.keterangan}</th>
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
        },
    })
</script>
