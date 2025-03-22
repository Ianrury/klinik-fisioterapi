<?= $this->extend('layouts/template') ?>

<?= $this->section('title') ?>
Rekam Medis
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<form action="/store" method="post">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="bg-transparent border-b-4 border-primary w-1/4">
            <h2 class="text-primary font-bold text-xl">Status Klinik Pasien</h2>
        </div>
        <div class="mt-5">
            <div class="mt-5">
                <label for="id_fisioterapis" class="block text-lg font-semibold text-gray-900">Fisioterapis</label>
                <div class="relative mt-1">
                    <select name="id_fisioterapis" id="id_fisioterapis" placeholder="Pilih fisioterapis"
                        class="block w-1/2 px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200">
                        <?php foreach ($fisioterapis as $fisioterapi): ?>
                            <option value="<?= $fisioterapi['id'] ?>"><?= $fisioterapi['username'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="mt-5">
                <label for="tanggal" class="block text-lg font-semibold text-gray-900">Tanggal Periksa</label>
                <div class="relative mt-1">
                    <input type="date" name="tanggal" id="tanggal" placeholder="Pilih tanggal"
                        class="block w-1/2 px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200">
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-lg mt-5 grid grid-cols-2 gap-6 w-full">
        <?= csrf_field(); ?>
        <!-- Kolom pertama -->
        <div class="col-span-1" id="first-column">
            <div class="mt-5">
                <label for="nama_pasien" class="block text-lg font-semibold text-gray-900">Nama Pasien atau
                    Atlet</label>
                <div class="relative mt-1">
                    <select name="nama_pasien" id="nama_pasien"
                        class="select2 block w-full px-2 py-2 text-gray-500 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200">
                        <option value="">-- Pilih Pasien --</option>
                        <?php foreach ($pasiens as $pasien): ?>
                            <option value="<?= $pasien['id']; ?>"><?= $pasien['nama']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="mt-5">
                <label for="j_kelamin" class="block text-lg font-semibold text-gray-900">Jenis Kelamin</label>
                <div class="relative mt-1">
                    <select name="j_kelamin" id="j_kelamin"
                        class="block w-full px-2 py-2 text-gray-500 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200"
                        disabled>
                        <option value="">-- Pilih --</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="mt-5">
                <label for="tgl_lahir" class="block text-lg font-semibold text-gray-900">Tanggal Lahir</label>
                <div class="relative mt-1">
                    <input type="date" name="tgl_lahir" id="tgl_lahir"
                        class="block w-full px-2 py-2 text-gray-500 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200"
                        readonly>
                </div>
            </div>

            <div class="mt-5">
                <label for="alamat" class="block text-lg font-semibold text-gray-900">Alamat</label>
                <div class="relative mt-1">
                    <input type="text" name="alamat" id="alamat"
                        class="block w-full px-2 py-2 text-gray-500 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200"
                        readonly>
                </div>
            </div>

            <div class="mt-5">
                <label for="no_hp" class="block text-lg font-semibold text-gray-900">Nomor HP</label>
                <div class="relative mt-1">
                    <input type="text" name="no_hp" id="no_hp"
                        class="block w-full px-2 py-2 text-gray-500 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200"
                        readonly>
                </div>
            </div>

            <div class="mt-5">
                <label for="pekerjaan" class="block text-lg font-semibold text-gray-900">Pekerjaan</label>
                <div class="relative mt-1">
                    <input type="text" name="pekerjaan" id="pekerjaan"
                        class="block w-full px-2 py-2 text-gray-500 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200"
                        readonly>
                </div>
            </div>


            <input type="text" name="id_pasien" id="id_pasien" hidden>
            <div class="mt-5 flex justify-end">
                <button id="next" type="button"
                    class="bg-primary text-white font-semibold p-3 rounded-lg">Selanjutnya</button>
                <button id="submit" type="submit"
                    class="bg-primary text-white font-semibold p-3 rounded-lg hidden">Buat Antrian</button>
            </div>
        </div>

        <!-- Kolom kedua -->
        <div class="col-span-1 hidden" id="second-column">
            <!-- Keluhan Utama -->
            <div class="mt-5">
                <label for="keluhan_utama" class="block text-lg font-semibold text-gray-900">Keluhan Utama</label>
                <div class="relative mt-1">
                    <input type="text" name="keluhan_utama" id="keluhan_utama" placeholder="Masukkan keluhan utama"
                        class="block w-full px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200"
                        readonly>
                    <p class="text-sm text-red-500 mt-1">Hanya fisioterapis yang bisa mengisi bagian ini.</p>
                </div>
            </div>

            <!-- Riwayat Keluhan -->
            <div class="mt-5">
                <label for="riwayat_keluhan" class="block text-lg font-semibold text-gray-900">Riwayat Keluhan</label>
                <div class="relative mt-1">
                    <input type="text" name="riwayat_keluhan" id="riwayat_keluhan"
                        placeholder="Masukkan riwayat keluhan"
                        class="block w-full px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200"
                        readonly>
                    <p class="text-sm text-red-500 mt-1">Hanya fisioterapis yang bisa mengisi bagian ini.</p>
                </div>
            </div>

            <!-- Pemeriksaan -->
            <div class="mt-5">
                <label for="pemeriksaan" class="block text-lg font-semibold text-gray-900">Pemeriksaan</label>
                <div class="relative mt-1">
                    <input type="text" name="pemeriksaan" id="pemeriksaan" placeholder="Masukkan pemeriksaan"
                        class="block w-full px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200"
                        readonly>
                    <p class="text-sm text-red-500 mt-1">Hanya fisioterapis yang bisa mengisi bagian ini.</p>
                </div>
            </div>

            <!-- Treatment -->
            <div class="mt-5">
                <label for="treatment" class="block text-lg font-semibold text-gray-900">Treatment</label>
                <div class="relative mt-1">
                    <input type="text" name="treatment" id="treatment" placeholder="Masukkan treatment"
                        class="block w-full px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200"
                        readonly>
                    <p class="text-sm text-red-500 mt-1">Hanya fisioterapis yang bisa mengisi bagian ini.</p>
                </div>
            </div>

            <!-- Kesimpulan -->
            <div class="mt-5">
                <label for="kesimpulan" class="block text-lg font-semibold text-gray-900">Kesimpulan</label>
                <div class="relative mt-1">
                    <input type="text" name="kesimpulan" id="kesimpulan" placeholder="Masukkan kesimpulan"
                        class="block w-full px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200"
                        readonly>
                    <p class="text-sm text-red-500 mt-1">Hanya fisioterapis yang bisa mengisi bagian ini.</p>
                </div>
            </div>

            <!-- Latihan Rumah -->
            <div class="mt-5">
                <label for="latihan_rumah" class="block text-lg font-semibold text-gray-900">Latihan Rumah</label>
                <div class="relative mt-1">
                    <input type="text" name="latihan_rumah" id="latihan_rumah" placeholder="Masukkan latihan rumah"
                        class="block w-full px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200"
                        readonly>
                    <p class="text-sm text-red-500 mt-1">Hanya fisioterapis yang bisa mengisi bagian ini.</p>
                </div>
            </div>

            <!-- Evaluasi -->
            <div class="mt-5">
                <label for="evaluasi" class="block text-lg font-semibold text-gray-900">Evaluasi</label>
                <div class="relative mt-1">
                    <input type="text" name="evaluasi" id="evaluasi" placeholder="Masukkan evaluasi"
                        class="block w-full px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200"
                        readonly>
                    <p class="text-sm text-red-500 mt-1">Hanya fisioterapis yang bisa mengisi bagian ini.</p>
                </div>
            </div>
        </div>
    </div>
</form>



<script>
    document.addEventListener("DOMContentLoaded", function () {
        const nextButton = document.getElementById("next");
        const submitButton = document.getElementById("submit");
        const firstColumn = document.getElementById("first-column");
        const secondColumn = document.getElementById("second-column");
        const inputsFirstColumn = firstColumn.querySelectorAll("input, select");

        function checkFields() {
            let allFilled = true;
            inputsFirstColumn.forEach(function (input) {
                if (!input.value) {
                    allFilled = false;
                }
            });
            return allFilled;
        }

        nextButton.addEventListener("click", function () {
            if (checkFields()) {
                secondColumn.classList.remove("hidden");
                secondColumn.classList.add("animate-slide-in-from-left");
                nextButton.classList.add("hidden");
                submitButton.classList.remove("hidden");
            } else {
                alert("Harap Pilih Pasien Terlebih Dahulu.");
            }
        });
    });
</script>

<style>
    @keyframes slideInFromLeft {
        0% {
            transform: translateX(-100%);
        }

        100% {
            transform: translateX(0);
        }
    }

    .animate-slide-in-from-left {
        animation: slideInFromLeft 0.5s ease-out forwards;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

<?= $this->endSection() ?>

<?php $this->section('style') ?>
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

<?php $this->endSection() ?>

<?php $this->section('script') ?>


<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        // Inisialisasi Select2
        $('#nama_pasien').select2({
            placeholder: "Pilih Nama Pasien",
            allowClear: true,
            width: '100%'
        });

        // AJAX untuk mengambil data pasien berdasarkan ID
        $('#nama_pasien').change(function () {
            var pasienId = $(this).val();
            if (pasienId) {
                $.ajax({
                    url: "/pasiens/pasienid/" + pasienId,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        if (data) {
                            $('#j_kelamin').val(data.j_kelamin).trigger('change');
                            $('#tgl_lahir').val(data.tgl_lahir.split(" ")[0]);
                            $('#alamat').val(data.alamat);
                            $('#no_hp').val(data.no_hp);
                            $('#pekerjaan').val(data.pekerjaan);
                            $('#id_pasien').val(data.id);
                        }
                    }
                });
            } else {
                // Kosongkan jika tidak ada pasien yang dipilih
                $('#j_kelamin').val("").trigger('change');
                $('#tgl_lahir, #alamat, #no_hp, #pekerjaan').val("");
            }
        });
    });
</script>

</script>


<?php $this->endSection() ?>