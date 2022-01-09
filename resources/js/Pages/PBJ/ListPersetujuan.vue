<template>
    <app-layout title="Sistem Informasi Pengadaan Barang & Jasa">
        <main class="flex w-full h-screen">
            <SidebarValidator />
            <section class="w-full p-4">
                <div class="w-full h-64 p-4 text-md">

                    <h1 class="font-bold text-lg text-center border-b-2 border-red-500">Status Permohonan {{ title }} Pengadaaan Barang & Jasa Dari Pengusul</h1>
                    
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
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4">{{ item.status_validator }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <pagination class="mt-6 float-right" :links="listData.links" :perPage="page" :searchStr="term" />
                    
                </div>
            </section>

            
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
    import axios from 'axios';
    import { Link } from '@inertiajs/inertia-vue3';
    import AppLayout from '@/Layouts/AppLayout.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetDangerButton from '@/Jetstream/DangerButton.vue'
    import SidebarValidator from '@/Components/SidebarValidator.vue';
    import Pagination from '@/Components/Pagination.vue'
    import HeaderTable from '@/Components/HeaderTable.vue'

    export default defineComponent({
        components: {
            Link,
            AppLayout,
            SidebarValidator,
            Pagination,
            JetButton,
            JetDangerButton,
            HeaderTable
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
                listCols: ['No', 'Nama Pengusul', 'Nomor Identitas', 'Status Pengusul', 'No HP', 'Alamat', 'Keterangan', 'Status']
            }
        },
        methods: {
            capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            },
            search() {
                this.$inertia.replace(this.route('Validator.persetujuan', {term: this.term, perPage: this.page, jenisUsulan: this.jenisUsulan}))
            },
            
        },
    })
</script>
