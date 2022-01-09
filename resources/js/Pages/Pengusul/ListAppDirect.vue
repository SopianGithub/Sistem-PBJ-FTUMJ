<template>
    <app-layout title="Sistem Informasi Pengadaan Barang & Jasa">
        <main class="flex w-full h-screen">
            <SidebarPengusul />
            <section class="w-full p-4">
                <div class="w-full h-64 p-4 text-md">
                    
                    <div class="relative overflow-x-auto">
                        <Link :href="route('Pengusul.create', {jenis_usulan: jenisUsulan})" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Tambah Baru</Link>
                        <div class="relative w-12/12 overflow-x-auto">
                            <select name="perPage" id="perPage" class="m-4 rounded-lg" v-model="page" @change="search">
                                <option v-for="item in listPage" :value="item" >{{item}}</option>
                            </select>

                            <input type="text" name="table_search" class="form-control w-auto float-right m-4 rounded-lg" placeholder="Search" v-model="term" @keyup="search">
                        </div>
                        <table class="table-auto border-collapse w-full mt-6">
                            <thead>
                                <tr class="rounded-lg text-sm font-medium text-gray-700 text-left">
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
                                    ]">Nama Pengusul</th>
                                <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                    :class="[
                                        color === 'light'
                                        ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                        : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                                    ]">Nomor Identitas</th>
                                <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                    :class="[
                                        color === 'light'
                                        ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                        : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                                    ]">Status Pengusul</th>
                                <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                    :class="[
                                        color === 'light'
                                        ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                        : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                                    ]">No HP</th>
                                <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                    :class="[
                                        color === 'light'
                                        ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                        : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                                    ]">Alamat</th>
                                <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                    :class="[
                                        color === 'light'
                                        ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                        : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                                    ]">Keterangan</th>
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
                                    ]">Aksi</th>
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
                                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4">
                                    <span class="grid grid-flow-col grid-cols-2 gap-4">
                                        <div>
                                            <Link :href="route('Pengusul.edit', {id: item.id, jenis_usulan: item.jenis_usulan.toLowerCase()})" >
                                                <jet-button type="button">
                                                    Edit
                                                </jet-button>
                                            </Link>
                                        </div>
                                        <div class="ml-12">
                                            <jet-danger-button type="button" @click="deleteAction(item.id, item.jenis_usulan)">
                                                Hapus
                                            </jet-danger-button>
                                        </div>
                                    </span>
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
    import AppLayout from '@/Layouts/AppLayout.vue'
    import SidebarPengusul from '@/Components/SidebarPengusul.vue';
    import Pagination from '@/Components/Pagination.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetDangerButton from '@/Jetstream/DangerButton.vue'

    export default defineComponent({
        components: {
            Link,
            AppLayout,
            SidebarPengusul,
            Pagination,
            JetButton,
            JetDangerButton
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
                listPage: [5, 10, 15, 20, 30, 50, 100]
            }
        },
        methods: {
            search() {
                this.$inertia.replace(this.route('Pengusul.list', {term: this.term, perPage: this.page, jenisUsulan: this.jenisUsulan}))
            },
            editAction(id){
                
            },
            deleteAction(id, jenis_usulan){
                if (confirm('Apakah Anda Yakin Untuk Menghapus Usulan Ini?')) {
                    this.$inertia.delete(`/Pengusul/delete/${id}/${jenis_usulan}`)
                }
            }
        },
    })
</script>
