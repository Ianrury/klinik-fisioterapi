<?php $this->extend('layouts/template'); ?>

<?php $this->section('title') ?>
Tambah Terapis
<?php $this->endSection() ?>

<?php $this->section('content') ?>
<div class="bg-white p-6 rounded-lg shadow-lg">
    <div class="bg-transparent border-b-4 border-primary w-1/4">
        <h2 class="text-primary font-bold text-xl">Tambah Pasien</h2>
    </div>

    <!-- Form untuk menambah user baru -->
    <form action="/pasiens/store" method="post">
        <?= csrf_field() ?>
        <?php $validation = \Config\Services::validation(); ?>

        <div class="mt-5">
            <label for="nama_pasien" class="block text-lg font-semibold text-gray-900">Nama Pasien atau Atlet</label>
            <div class="relative mt-1">
                <input type="text" name="nama_pasien" id="nama_pasien" value="<?= old('nama_pasien'); ?>"
                    placeholder="Masukkan nama pasien atau atlet"
                    class="block w-full px-2 py-2 text-gray-500 placeholder-gray-400 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200">
            </div>
            <small class="text-red-500"><?= $validation->getError('nama_pasien'); ?></small>
        </div>

        <div class="mt-5">
            <label for="j_kelamin" class="block text-lg font-semibold text-gray-900">Jenis Kelamin</label>
            <div class="relative mt-1">
                <select name="j_kelamin" id="j_kelamin"
                    class="block w-full px-2 py-2 text-gray-500 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200">
                    <option value="" <?= old('j_kelamin') == '' ? 'selected' : '' ?>>-- Pilih --</option>
                    <option value="L" <?= old('j_kelamin') == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="P" <?= old('j_kelamin') == 'P' ? 'selected' : '' ?>>Perempuan</option>
                </select>
            </div>
            <small class="text-red-500"><?= $validation->getError('j_kelamin'); ?></small>
        </div>

        <div class="mt-5">
            <label for="tgl_lahir" class="block text-lg font-semibold text-gray-900">Tanggal Lahir</label>
            <div class="relative mt-1">
                <input type="date" name="tgl_lahir" id="tgl_lahir" value="<?= old('tgl_lahir'); ?>"
                    class="block w-full px-2 py-2 text-gray-500 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200">
            </div>
            <small class="text-red-500"><?= $validation->getError('tgl_lahir'); ?></small>
        </div>

        <div class="mt-5">
            <label for="alamat" class="block text-lg font-semibold text-gray-900">Alamat</label>
            <div class="relative mt-1">
                <input type="text" name="alamat" id="alamat" value="<?= old('alamat'); ?>"
                    class="block w-full px-2 py-2 text-gray-500 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200">
            </div>
            <small class="text-red-500"><?= $validation->getError('alamat'); ?></small>
        </div>

        <div class="mt-5">
            <label for="no_hp" class="block text-lg font-semibold text-gray-900">Nomor HP</label>
            <div class="relative mt-1">
                <input type="text" name="no_hp" id="no_hp" value="<?= old('no_hp'); ?>"
                    class="block w-full px-2 py-2 text-gray-500 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200">
            </div>
            <small class="text-red-500"><?= $validation->getError('no_hp'); ?></small>
        </div>

        <div class="mt-5">
            <label for="pekerjaan" class="block text-lg font-semibold text-gray-900">Pekerjaan</label>
            <div class="relative mt-1">
                <input type="text" name="pekerjaan" id="pekerjaan" value="<?= old('pekerjaan'); ?>"
                    class="block w-full px-2 py-2 text-gray-500 bg-transparent border-b border-gray-400 focus:outline-none focus:border-black transition duration-200">
            </div>
            <small class="text-red-500"><?= $validation->getError('pekerjaan'); ?></small>
        </div>

        <div class="flex justify-end mt-5">
            <button type="submit" class="text-white bg-primary flex p-3 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span class="ml-3 font-bold">Tambah</span>
            </button>
        </div>
    </form>
</div>
<?php $this->endSection() ?>