<?php $this->extend('layouts/template') ?>

<?php $this->section('title') ?>
List Pasien
<?php $this->endSection() ?>

<?php $this->section('content') ?>

<div class="bg-transparent border-b-4 border-primary w-1/4 my-4">
    <h2 class="text-primary font-bold text-xl">
        Riwayat Pasien <?= isset($pasien['nama']) ? $pasien['nama'] : 'Tidak Ditemukan' ?>
    </h2>
</div>

<?php if (empty($terapis)): ?>
    <div class="bg-white p-6 rounded-lg shadow-lg my-5">
        <div class="text-center">
            <h1 class="text-xl font-semibold">Tidak Ada Data Rekam Medis</h1>
        </div>
    </div>
<?php else: ?>
    <?php foreach ($terapis as $terapi): ?>
        <div
            class="bg-white hover:bg-[#F2F2F7] p-6 rounded-lg shadow-md mb-5 border-l-4 border-[#6C69FF] transition-all duration-300">
            <div class="mb-3 border-b pb-2">
                <p class="text-sm text-gray-500">Pasien</p>
                <h1 class="text-xl font-bold text-gray-800"><?= $terapi['nama'] ?></h1>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Jenis Kelamin</p>
                        <p class="font-medium"><?= $terapi['j_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></p>
                    </div>
                </div>

                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Tanggal Kunjungan</p>
                        <p class="font-medium"><?= $terapi['tanggal'] ?></p>
                    </div>
                </div>

                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Alamat</p>
                        <p class="font-medium"><?= $terapi['alamat'] ?></p>
                    </div>
                </div>

                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">No. Pendaftaran</p>
                        <p class="font-medium"><?= $terapi['no_pendaftaran'] ?></p>
                    </div>
                </div>
            </div>

            <div class="flex items-center border-t pt-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Dokter</p>
                    <p class="font-medium"><?= $terapi['username'] ?></p>
                </div>
            </div>

            <div class="text-center mt-4">
                <button
                    class="bg-[#6C69FF] hover:bg-[#5855e6] text-white text-lg w-full p-4 rounded-lg transition-all duration-300 flex items-center justify-center shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-[#6C69FF] focus:ring-opacity-50"
                    onclick="openModal(<?= $terapi['id'] ?>)">
                    <span>Lihat Selengkapnya</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    <?php endforeach ?>
<?php endif ?>

<!-- Modal -->
<div id="modalDetail" class="fixed inset-0 items-center flex justify-center bg-gray-600 bg-opacity-50 hidden">
    <div class="fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg relative max-h-[500px] overflow-y-auto">
            <button class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 focus:outline-none"
                onclick="closeModal()">
                &times;
            </button>

            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold text-blue-600">SIRM Fisio</h1>
                <p class="text-gray-600">Sistem Informasi Rekam Medis Praktik Mandiri Fisioterapi</p>
            </div>

            <div class="overlay-auto">
                <div id="identitasPasien">
                    <!-- Konten modal akan dimuat di sini -->
                </div>

                <div id="keluhan">
                    <!-- Konten modal akan dimuat di sini -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script -->
<script>
    // Fungsi untuk membuka modal dan memuat data terapi berdasarkan ID
    function openModal(id) {
        console.log("id: ", id);
        // Memuat data terapi menggunakan AJAX atau bisa juga menggunakan fetch API
        fetch(`/detail/${id}`)
            .then(response => response.json())
            .then(data => {
                // Function untuk mendapatkan usia berdasarkan tanggal lahir
                let birthDate = new Date(data.tgl_lahir);
                let today = new Date();
                let usia = today.getFullYear() - birthDate.getFullYear();
                let monthDiff = today.getMonth() - birthDate.getMonth();

                // Jika bulan saat ini lebih kecil dari bulan lahir atau bulan sama tapi hari lebih kecil, usia dikurangi 1
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                    usia--;
                }
                // Menampilkan data detail terapi di dalam modal
                // console.log(data)
                const identitasPasien = document.getElementById('identitasPasien');
                identitasPasien.innerHTML = `
                <div class="text-center text-xl font-bold mb-3">
                    Identitas Pasien
                </div>

                <div class="grid grid-cols-2 gap-4 text-sm text-gray-800">
                    <div class="">Nama</div>
                    <div class="font-semibold text-end"> ${data.nama}</div>
                    
                    <div class="">No Pendaftaran</div>
                    <div class="font-semibold text-end"> ${data.no_pendaftaran}</div>
                    
                    <div class="">Jenis Kelamin</div>
                    <div class="font-semibold text-end"> ${data.j_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'}</div>
                    
                    <div class="">Alamat</div>
                    <div class="font-semibold text-end"> ${data.alamat}</div>
                    
                    <div class="">Fisioterapis</div>
                    <div class="font-semibold text-end"> ${data.username}</div>
                    
                    <div class="">Nomor HP</div>
                    <div class="font-semibold text-end"> ${data.no_hp}</div>
                    
                    <div class="">Tanggal Lahir/Usia</div>
                    <div class="font-semibold text-end"> ${data.tgl_lahir.split(" ")[0]} / ${usia}</div>
                    
                    <div class="">Pekerjaan</div>
                    <div class="font-semibold text-end"> ${data.pekerjaan}</div>
                </div>
                `;

                const keluhan = document.getElementById('keluhan');
                keluhan.innerHTML = `
                <div class="text-center text-xl font-bold my-3">
                    Keluhan
                </div>

                <div class="grid grid-cols-2 gap-4 text-sm text-gray-800">
                    <div class="">Keluhan Utama</div>
                    <div class="font-semibold text-end"> ${data.keluhan_utama}</div>

                    <div class="">Riwayat Utama</div>
                    <div class="font-semibold text-end"> ${data.riwayat_keluhan}</div>

                    <div class="">Pemeriksaan</div>
                    <div class="font-semibold text-end"> ${data.pemeriksaan}</div>

                    <div class="">Treatment</div>
                    <div class="font-semibold text-end"> ${data.treatment}</div>

                    <div class="">Kesimpulan</div>
                    <div class="font-semibold text-end"> ${data.kesimpulan}</div>

                    <div class="">Latihan Rumah</div>
                    <div class="font-semibold text-end"> ${data.latihan_rumah}</div>

                    <div class="">Evaulasi</div>
                    <div class="font-semibold text-end"> ${data.evaluasi}</div>
                </div>
                `;
                // Menampilkan modal
                document.getElementById('modalDetail').classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    // Fungsi untuk menutup modal
    function closeModal() {
        document.getElementById('modalDetail').classList.add('hidden');
    }
</script>

<?php $this->endSection() ?>