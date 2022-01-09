<template>
    <Head title="Ketentuan -  Pengadaan Barang & Jasa" />
    <WebCompoent>
        <div class="container mx-auto">
            <div class="grid grid-rows-1 grid-flow-col gap-8 mt-4">
                <div class="col-span-2">
                    <img src="https://lelang.ums.ac.id/landing/img/ketentuan.png" alt="Ketentuan">
                </div>
                <div class="col-span-4">
                    <div class="w-full border-solid border-b-2 border-sky-800 mb-4">
                        <h1 class="text-2xl font-bold text-gray-900 border-b-2 border-red-400 w-96">Ketentuan Pengadaan Barang</h1>
                    </div>
                    <div>
                        <ol class="list-decimal text-justify">
                            <li>Pengadaan barang  dilakukan secara terpusat oleh Tim Pengadaan Barang Universitas (Biro  Administrasi Umum, Biro Keuangan, dan Wakil Rektor II) bekerja sama dengan unit  pengusul,</li>
                            <li>Unit pengusul mengajukan pengadaan barang secara <em>on  line</em> melalui RPPS, RPF, atau RPU,</li>
                            <li>Dalam kondisi khusus (misal Unit Kepanitiaan, keadaan mendesak, dll.) unit pengusul dapat  mengajukan permohonan pengadaan barang melalui ajuan khusus di luar RPPS, RPF,  atau RPU, ke Wakil Rektor yang membawahi unit terkai: jika disetujui, Wakil Rektor terkait akan meneruskan ke Wakil Rektor II,</li>
                            <li>Pengadaan barang dari ajuan khusus akan dimasukkan dalam aplikasi Pengadaan Barang <em>on Line</em> setelah ada persetujuan dari  Wakil Rektor II, </li>
                            <li>Informasi pengadaan barang dari unit pengusul harus jelas mencakup: nama barang, jumlah  barang, spek barang, fungsi/kegunaan, dan <em>include</em> tidaknya jasa instalasi,</li>
                            <li>Unit pengusul harus melakukan validasi data barang yang diajukan, sebelum Tim Pengadaan  Barang Universitas mengumumkan ke publik; dalam hal ini, unit pengusul dapat  melengkapi informasi yang diperlukan melalui aplikasi Pengadaan Barang <em>on Line</em>,</li>
                            <li>Semua barang yang diajukan unit pengusul, setelah melalui proses validasi, akan diumumkan ke  publik dengan <em>deadline</em> waktu tertentu,</li>
                            <li>Setiap <em>supplier</em> dapat mengajukan penawaran harga secara <em>on line</em> melalui aplikasi Pengadaan  Barang <em>on Line</em> dengan sistem <em>log in</em> tertentu (diatur langsung di menu  Pengadaan Barang <em>on Line</em>): harga yang diajukan harus sudah HARGA NETTO (sudah dikurangi discount) dan TIDAK TERMASUK PAJAK PPN 10%, karena penetapan supplier dilakukan tanpa interaksi langsung (tatap muka) dengan para calon supplier, dan salah satu pertimbangan penetapan supplier adalah harga yang diajukan tersebut,</li>
                            <li>Penetapan <em>supplier</em> didasarkan atas: kesesuaian  spek, harga penawaran, dan <em>track record  supplier</em>; jika anggaran berasal dari hibah Pemerintah RI dan mensyaratkan <em>tender</em>, beberapa kandidat <em>supplier</em> yang memenuhi syarat akan  diundang <em>tender</em>, </li>
                            <li>Pemberitahuan ke <em>supplier</em> terpilih dilakukan melalui nomor kontak atau alamat korespondensi yang  disediakan <em>supplier</em> di aplikasi Pengadaan  Barang <em>on Line</em>,</li>
                            <li>Batas waktu pengiriman barang oleh <em>supplier</em> adalah paling lambat 2 minggu setelah  diumumkan <em>supplier</em> terpilih,</li>
                            <li>Barang diserahterimakan kepada Tim Pengadaan Barang  Universitas beserta tim unit pengusul; sebelum penandatanganan serah terima,  Tim Pengadaan Barang Universitas men-<em>check</em> kesesuaian barang terkait spek dan jumlah yang diusulkan,</li>
                            <li>Jika barang yang disediakan <em>supplier</em> tidak sesuai spek yang diusulkan, Tim Pengadaan Barang  Universitas berhak mengembalikan barang tersebut, dengan beberapa konsekuensi  yang harus ditanggung <em>supplier</em>.  </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </WebCompoent>
    <Footer />
</template>

<script>
import { defineComponent } from 'vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

import WebCompoent from '@/Layouts/WebComp.vue';
import Footer from '@/Components/Footer.vue';

export default defineComponent({
    components: {
        Head,
        Link,
        WebCompoent,
        Footer
    },
})
</script>