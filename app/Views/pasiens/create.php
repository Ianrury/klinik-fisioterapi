<?php $this->extend('layouts/template'); ?>

<?php $this->section('title') ?>
Tambah Terapis
<?php $this->endSection() ?>

<?php $this->section('content') ?>
<div class="bg-white p-6 rounded-lg shadow-lg">
    <div class="bg-transparent border-b-4 border-primary w-1/4">
        <h2 class="text-primary font-bold text-xl">Tambah Akun Terapis</h2>
    </div>

    <!-- Form untuk menambah user baru -->
    <form action="/register-user" method="post">
        <?= csrf_field() ?>

        <div class="flex flex-col mt-5 gap-3">
            <label for="email" class="font-semibold">Email Fisioterapis</label>
            <input type="email" name="email" placeholder="Masukkan email" class="border border-primary rounded-xl bg-inputBg p-3" required>
        </div>

        <div class="flex flex-col mt-5 gap-3">
            <label for="username" class="font-semibold">Nama Fisioterapis</label>
            <input type="text" name="username" placeholder="Masukkan nama" class="border border-primary rounded-xl bg-inputBg p-3" required>
        </div>

        <div class="flex flex-col mt-5 gap-3">
            <label for="password" class="font-semibold">Password</label>
            <input type="password" name="password" placeholder="Masukkan password" class="border border-primary rounded-xl bg-inputBg p-3" required>
        </div>

        <div class="flex flex-col mt-5 gap-3">
            <label for="password_confirm" class="font-semibold">Konfirmasi Password</label>
            <input type="password" name="password_confirm" placeholder="Masukkan ulang password" class="border border-primary rounded-xl bg-inputBg p-3" required>
        </div>

        <div class="flex justify-end mt-5">
            <button type="submit" class="text-white bg-primary flex p-3 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span class="ml-3 font-bold">Tambah Akun</span>
            </button>
        </div>
    </form>
</div>
<?php $this->endSection() ?>