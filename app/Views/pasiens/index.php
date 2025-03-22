<?php $this->extend('layouts/template'); ?>

<?php $this->section('title') ?>
Tambah Terapis
<?php $this->endSection() ?>

<?php $this->section('content') ?>
<div class="bg-white p-6 rounded-lg shadow-lg">
    <div class="bg-transparent border-b-4 border-primary w-1/4 mb-4">
        <h2 class="text-primary font-bold text-xl">Data Pasien</h2>
    </div>
    <div class="my-4">
        <!-- Using utilities: -->
        <a href="/pasiens/create">
            <button class="bg-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Input Pasien
            </button>
        </a>

    </div>
    <div class="w-full overflow-x-auto">
        <table id="dataTable" class="w-full bg-white border border-gray-200 rounded-lg shadow">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Nama Pasien</th>
                    <th class="px-4 py-2 border">Tanggal Lahir</th>
                    <th class="px-4 py-2 border">Alamat</th>
                    <th class="px-4 py-2 border">Nomor Telepon</th>
                    <th class="px-4 py-2 border">Pekerjaan</th>
                    <th class="px-4 py-2 border">Jenis Kelamin</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($pasiens as $pasien): ?>
                    <tr class="text-gray-700">
                        <td class="px-4 py-2 border"><?= $no++; ?></td>
                        <td class="px-4 py-2 border"><?= esc($pasien['nama']); ?></td>
                        <td class="px-4 py-2 border">
                            <?= date('d-m-Y', strtotime($pasien['tgl_lahir'])); ?>
                        </td>

                        <td class="px-4 py-2 border"><?= esc($pasien['alamat']); ?></td>
                        <td class="px-4 py-2 border"><?= esc($pasien['no_hp']); ?></td>
                        <td class="px-4 py-2 border"><?= esc($pasien['pekerjaan']); ?></td>
                        <td class="px-4 py-2 border">
                            <?= $pasien['j_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan'; ?>
                        </td>

                        <td class="px-4 py-2 border text-center">
                            <a href="<?= base_url('pasiens/edit/' . $pasien['id']); ?>" class="text-blue-500">Edit</a> |

                            <a href="<?= base_url('pasiens/delete/' . $pasien['id']); ?>" class="text-red-500"
                                onclick="return confirm('Hapus data ini?')">Hapus</a>
                            |
                            <a href="<?= base_url('kunjungan/riwayat/' . $pasien['id']); ?>"
                                class="text-blue-500">Riwayat</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>
</div>

<?php $this->endSection() ?>

<?php $this->section('script') ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(function () {
        $('#dataTable').DataTable({
            "responsive": true,
            "autoWidth": false,
            "language": {
                "search": "Cari Pasien:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "info": "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                "paginate": {
                    "previous": "Sebelumnya",
                    "next": "Berikutnya"
                }
            }
        });
    });
</script>

<?php $this->endSection() ?>