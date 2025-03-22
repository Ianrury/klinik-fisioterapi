<?php $this->extend('layouts/template'); ?>

<?php $this->section('title') ?>
Tambah Terapis
<?php $this->endSection() ?>

<?php $this->section('content') ?>
<div class="bg-white p-6 rounded-lg shadow-lg">
    <div class="bg-transparent border-b-4 border-primary w-1/4">
        <h2 class="text-primary font-bold text-xl">Input Rekam Medis</h2>
    </div>

    <!-- Form untuk menambah user baru -->
    <form action="<?= base_url('/kunjungan/input-data') ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="id_terapi" value="<?= $terapi['id'] ?>">

        <!-- Keluhan Utama -->
        <div class="mt-5">
            <label for="keluhan_utama" class="block text-lg font-semibold text-gray-900">Keluhan Utama</label>
            <input type="text" name="keluhan_utama" id="keluhan_utama"
                value="<?= old('keluhan_utama', $terapi['keluhan_utama']) ?>"
                class="block w-full px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200">
        </div>

        <!-- Riwayat Keluhan -->
        <div class="mt-5">
            <label for="riwayat_keluhan" class="block text-lg font-semibold text-gray-900">Riwayat Keluhan</label>
            <input type="text" name="riwayat_keluhan" id="riwayat_keluhan"
                value="<?= old('riwayat_keluhan', $terapi['riwayat_keluhan']) ?>"
                class="block w-full px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200">
        </div>

        <!-- Pemeriksaan -->
        <div class="mt-5">
            <label for="pemeriksaan" class="block text-lg font-semibold text-gray-900">Pemeriksaan</label>
            <input type="text" name="pemeriksaan" id="pemeriksaan"
                value="<?= old('pemeriksaan', $terapi['pemeriksaan']) ?>"
                class="block w-full px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200">
        </div>

        <!-- Treatment -->
        <div class="mt-5">
            <label for="treatment" class="block text-lg font-semibold text-gray-900">Treatment</label>
            <input type="text" name="treatment" id="treatment" value="<?= old('treatment', $terapi['treatment']) ?>"
                class="block w-full px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200">
        </div>

        <!-- Kesimpulan -->
        <div class="mt-5">
            <label for="kesimpulan" class="block text-lg font-semibold text-gray-900">Kesimpulan</label>
            <input type="text" name="kesimpulan" id="kesimpulan" value="<?= old('kesimpulan', $terapi['kesimpulan']) ?>"
                class="block w-full px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200">
        </div>

        <!-- Latihan Rumah -->
        <div class="mt-5">
            <label for="latihan_rumah" class="block text-lg font-semibold text-gray-900">Latihan Rumah</label>
            <input type="text" name="latihan_rumah" id="latihan_rumah"
                value="<?= old('latihan_rumah', $terapi['latihan_rumah']) ?>"
                class="block w-full px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200">
        </div>

        <!-- Evaluasi -->
        <div class="mt-5">
            <label for="evaluasi" class="block text-lg font-semibold text-gray-900">Evaluasi</label>
            <input type="text" name="evaluasi" id="evaluasi" value="<?= old('evaluasi', $terapi['evaluasi']) ?>"
                class="block w-full px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200">
        </div>

        <!-- Tombol Submit -->
        <div class="flex justify-end mt-5">
            <button type="submit" class="text-white bg-primary flex p-3 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span class="ml-3 font-bold">Simpan</span>
            </button>
        </div>
    </form>

</div>
<?php $this->endSection() ?>