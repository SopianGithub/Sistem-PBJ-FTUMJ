<template>
    <app-layout title="Sistem Informasi Pengadaan Barang & Jasa">
        <main class="flex w-full h-screen">
            <SidebarAdmin />
            <section class="w-full p-4">
                <div class="w-full h-64 p-4 text-md">
                    <h1 class="font-bold text-3xl text-center border-b-2 border-red-500">Form {{ ActionForm }} Data Permohonan {{ title }}</h1>

                    <form @submit.prevent="submit" enctype="multipart/form-data" class="mt-8">
                        <div class="grid grid-cols-3 gap-4 p-2">
                            <div>
                                <jet-label for="name" value="Nama Pengusul" />
                            </div>
                            <div class="col-span-2">
                                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.nama_pengusul" required autofocus autocomplete="name" placeholder="Nama Lengkap" />
                                <div v-if="errors.nama_pengusul">{{ errors.nama_pengusul }}</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-4 p-2">
                            <div>
                                <jet-label for="no_identitas" value="No Identitas" />
                            </div>
                            <div class="col-span-2">
                                <jet-input id="no_identitas" type="text" class="mt-1 block w-full" v-model="form.no_identitas" required autofocus autocomplete="name" placeholder="NIP / NIDN / NIK / NPM" />
                                <div v-if="errors.no_identitas">{{ errors.no_identitas }}</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-4 p-2">
                            <div>
                                <jet-label for="status_pengusul" value="Status Pengusul" />
                            </div>
                            <div class="col-span-2">
                                <jet-input id="status_pengusul" type="text" class="mt-1 block w-full" v-model="form.status_pengusul" required autofocus autocomplete="name" placeholder="Kaprodi / Laboran / dll" />
                                <div v-if="errors.status_pengusul">{{ errors.status_pengusul }}</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-4 p-2">
                            <div>
                                <jet-label for="no_hp" value="No HP" />
                            </div>
                            <div class="col-span-2">
                                <jet-input id="no_hp" type="text" class="mt-1 block w-full" v-model="form.no_hp" required autofocus autocomplete="name" placeholder="Nomor HP" />
                                <div v-if="errors.no_hp">{{ errors.no_hp }}</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-4 p-2">
                            <div>
                                <jet-label for="almat_email" value="Alamat Email" />
                            </div>
                            <div class="col-span-2">
                                <jet-input id="almat_email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="name" placeholder="Pastikan email masa aktif dan penulisannya benar" />
                                <div v-if="errors.email">{{ errors.email }}</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-4 p-2">
                            <div>
                                <jet-label for="keterangan" value="Keterangan" />
                            </div>
                            <div class="col-span-2">
                                <jet-input id="keterangan" type="text" class="mt-1 block w-full" v-model="form.keterangan" required autofocus autocomplete="name" placeholder="Rincian permohonan beserta tujuan permohonan" />
                                <div v-if="errors.keterangan">{{ errors.keterangan }}</div>
                            </div>
                        </div>

                        <div v-if="isReqUpload" class="grid grid-cols-3 gap-4 p-2">
                            <div>
                                <jet-label for="name" value="Unggah Surat Penawaran" />
                            </div>
                            <div class="col-span-2">
                                <input
                                    type="file"
                                    @input="form.surat_penawaran = $event.target.files[0]"
                                    ref="docs"
                                    class="
                                        w-full
                                        px-4
                                        py-2
                                        mt-2
                                        border
                                        rounded-md
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-600
                                    "
                                    accept="application/pdf,application/vnd.ms-excel"
                                />
                                <div v-if="errors.surat_penawaran">{{ errors.suratPenawaran }}</div>
                            </div>
                        </div>

                         <div class="grid grid-cols-3 gap-4 p-2">
                            <div>
                                <jet-danger-button type="button">
                                    <Link href="index">Batal</Link>
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
    
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';
    import JetInput from '@/Jetstream/Input.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetDangerButton from '@/Jetstream/DangerButton.vue'
    
    import AppLayout from '@/Layouts/AppLayout.vue'
    import SidebarAdmin from '@/Components/SidebarAdmin.vue';

    export default defineComponent({
        components: {
            AppLayout,
            SidebarAdmin,
            JetInput,
            JetLabel,
            JetButton,
            JetDangerButton,
            Link
        },
        props:{
            idUserAuth: String,
            userameAuth: String,
            errors: Object,
            jenisUsulan: String,
            Action: String,
            dataEdit: Object
        },
        data() {
            let formInput = this.$inertia.form({
                nama_pengusul: this.userameAuth,
                id_user: this.idUserAuth,
                no_identitas: '',
                status_pengusul: '',
                no_hp: '',
                email: '',
                keterangan: '',
                surat_penawaran: '',
                jenis_usulan: this.jenisUsulan
            });
            if(this.Action == "Update"){
                formInput = this.$inertia.form({
                    _method: 'put',
                    nama_pengusul: this.dataEdit.nama_pengusul,
                    id_user: this.idUserAuth,
                    no_identitas: this.dataEdit.no_identitas,
                    status_pengusul: this.dataEdit.status_pengusul,
                    no_hp: this.dataEdit.no_hp,
                    email: this.dataEdit.email,
                    keterangan: this.dataEdit.keterangan,
                    surat_penawaran: this.dataEdit.surat_penawaran,
                    jenis_usulan: this.jenisUsulan
                });
            }
            return {
                form: formInput,
                isReqUpload : this.jenisUsulan == "langsung" ? true : false,
                title: this.capitalizeFirstLetter(this.jenisUsulan),
                ActionForm: this.Action == "Update" ? "Edit" : "Tambah",
            }
        },
        methods: {
            submit() {
                if(this.Action == "Update"){
                    this.form.post(this.route("Admin.permohonan.update", { id: this.dataEdit.id}),  {
                        forceFormData: true,
                    })
                }
            },
            capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            },
        },
    })
</script>
