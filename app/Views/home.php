<?php $this->extend('layouts/template') ?>

<?php $this->section('title') ?>
List Pasien
<?php $this->endSection() ?>

<?php $this->section('content') ?>
<!-- component -->
<div>
    <div class="flex flex-col gap-4 lg:p-4 p-2  rounde-lg m-2">

        <div class="lg:text-2xl md:text-xl text-lg lg:p-3 p-1 font-black text-gray-700">Antrian Kunjungan</div>
    </div>

    <div class="flex flex-col p-2 py-6 m-h-screen">

        <div class="bg-white items-center justify-between w-full flex rounded-full shadow-lg p-2 mb-5 sticky"
            style="top: 5px">

            <div>

                <div class="p-2 mr-1 rounded-full hover:bg-gray-100 cursor-pointer">

                    <svg class="h-6 w-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                            clip-rule="evenodd" />
                    </svg>

                </div>

            </div>

            <input
                class="font-bold uppercase rounded-full w-full py-4 pl-4 text-gray-700 bg-gray-100 leading-tight focus:outline-none focus:shadow-outline lg:text-sm text-xs"
                placeholder="Cari nama pasien, no. pendaftaran, atau alamat..." type="text" id="search-input">

            <div id="search-button" class="bg-gray-600 p-2 hover:bg-blue-400 cursor-pointer mx-2 rounded-full">

                <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd" />
                </svg>

            </div>

        </div>
    </div>

</div>


<?php if (empty($terapis)): ?>
    <div class="bg-white p-6 rounded-lg shadow-lg my-5">
        <div class="text-center">
            <h1 class="text-xl font-semibold">Tidak Ada Antrian Pasien</h1>
        </div>
    </div>
<?php else: ?>
    <div id="terapi-container">
        <?php foreach ($terapis as $terapi): ?>
            <div
                class="bg-white hover:bg-[#F2F2F7] p-6 rounded-lg shadow-lg mb-5 border-l-4 border-[#6C69FF] transition-all duration-300">
                <div class="flex justify-between items-center mb-4 pb-2 border-b">
                    <div>
                        <h1 class="text-xl font-bold text-gray-800"><?= $terapi['nama'] ?></h1>
                        <span class="text-sm text-gray-500 inline-block mt-1">Pasien</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span
                            class="<?= $terapi['verifi'] ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-orange-200 border border-orange-800' ?> text-xs font-semibold px-3 py-1 rounded-full">
                            <?= $terapi['verifi'] ? 'Tertangani' : 'Belum Tertangani' ?>
                        </span>
                        <?php
                        $hariIni = date('Y-m-d');
                        $tanggalTerapi = date('Y-m-d', strtotime($terapi['tanggal']));
                        $namaHari = date('l', strtotime($terapi['tanggal'])); // Mengambil nama hari dalam bahasa Inggris
                
                        // Jika tanggalnya hari ini
                        if ($tanggalTerapi == $hariIni) {
                            $bgColor = 'bg-green-100 text-green-800';
                            $label = 'Hari Ini';
                        } else {
                            $bgColor = 'bg-red-100 text-red-800';
                            $label = $namaHari;
                        }
                        ?>

                        <span class="<?= $bgColor ?> text-xs font-semibold px-3 py-1 rounded-full">
                            <?= $label ?>
                        </span>
                    </div>


                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">
                        <?= $terapi['no_pendaftaran'] ?>
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-purple-500" viewBox="0 0 20 20"
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
                        <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" viewBox="0 0 20 20"
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
                        <div class="w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-600" viewBox="0 0 20 20"
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
                </div>

                <div class="flex items-center border-t pt-3 mb-4">
                    <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Dokter</p>
                        <p class="font-medium"><?= $terapi['username'] ?></p>
                    </div>
                </div>


                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 mt-4">
                    <!-- Tombol Hapus -->
                    <a href="/kunjungan/delete/<?= $terapi['id'] ?>"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');"
                        class="bg-red-500 hover:bg-red-600 text-white text-base px-4 py-3 rounded-lg text-center flex items-center justify-center transition-all duration-300 shadow-sm hover:shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Hapus
                    </a>

                    <!-- Tombol Input Data -->
                    <a href="<?= base_url('/kunjungan/input-data/' . $terapi['id']) ?>"
                        class="bg-[#6C69FF] hover:bg-[#5855e6] text-white text-base px-4 py-3 rounded-lg text-center flex items-center justify-center transition-all duration-300 shadow-sm hover:shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                            <path fill-rule="evenodd"
                                d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                clip-rule="evenodd" />
                        </svg>
                        Input Data
                    </a>

                    <!-- Tombol Verifikasi -->
                    <button onclick="window.location.href='/kunjungan/verify/<?= $terapi['id'] ?>'"
                        class="bg-green-500 hover:bg-green-600 text-white text-base px-4 py-3 rounded-lg text-center flex items-center justify-center transition-all duration-300 shadow-sm hover:shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        Verifikasi
                    </button>

                    <!-- Tombol Riwayat -->
                    <a href="/kunjungan/riwayat/<?= $terapi['id_pasien'] ?>"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white text-base px-4 py-3 rounded-lg text-center flex items-center justify-center transition-all duration-300 shadow-sm hover:shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd" />
                        </svg>
                        Riwayat
                    </a>
                </div>
            </div>
        <?php endforeach ?>
    </div>
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
                    <div class="font-semibold text-end"> ${data.riwayat_utama}</div>

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

<script>
    // Add this script to your page
    document.addEventListener('DOMContentLoaded', function () {
        // Get the search input element
        const searchInput = document.getElementById('search-input');
        const searchButton = document.getElementById('search-button');
        const terapiContainer = document.getElementById('terapi-container'); // Container where results will be displayed

        // Function to perform search
        const performSearch = () => {
            const keyword = searchInput.value.trim();

            // Create FormData object
            const formData = new FormData();
            formData.append('keyword', keyword);

            // Show loading indicator
            terapiContainer.innerHTML = '<div class="text-center py-4"><svg class="animate-spin h-8 w-8 text-[#6C69FF] mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg><p class="mt-2 text-gray-600">Mencari...</p></div>';

            // Send AJAX request
            fetch('/search', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(html => {
                    // Update the container with search results
                    terapiContainer.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error:', error);
                    terapiContainer.innerHTML = '<div class="text-center py-4 text-red-500">Terjadi kesalahan saat mencari data. Silakan coba lagi.</div>';
                });
        };

        // Event listener for Enter key on search input
        searchInput.addEventListener('keypress', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Prevent form submission
                performSearch();
            }
        });

        // Event listener for search button click
        searchButton.addEventListener('click', function (event) {
            event.preventDefault();
            performSearch();
        });
    });
</script>
<?php $this->endSection() ?>