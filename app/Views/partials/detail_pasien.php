<?php
// Save this as 'app/Views/partials/terapi_cards.php'
?>

<?php if (empty($terapis)): ?>
    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-5">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-yellow-700">
                    Tidak ada data pasien anda
                </p>
            </div>
        </div>
    </div>
<?php else: ?>
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

            <!-- Rest of the terapi card content -->
            <!-- [Keep all the original content from your terapi card] -->

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

            <div class="flex justify-center items-center">
                    <!-- Tombol Riwayat -->
                    <a href="/kunjungan/riwayat/<?= $terapi['id_pasien'] ?>"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white w-full text-base px-4 py-3 rounded-lg text-center flex items-center justify-center transition-all duration-300 shadow-sm hover:shadow">
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
<?php endif; ?>