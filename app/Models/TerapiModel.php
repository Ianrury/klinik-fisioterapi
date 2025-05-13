<?php

namespace App\Models;

use CodeIgniter\Model;

class TerapiModel extends Model
{
    protected $table = 'terapi';
    protected $primaryKey = 'id';
    protected $useAutoIncrements = true;

    protected $allowedFields = ['no_pendaftaran', 'id_pasien', 'id_fisioterapis', 'tanggal', 'keluhan_utama', 'riwayat_keluhan', 'pemeriksaan', 'treatment', 'kesimpulan', 'latihan_rumah', 'evaluasi', 'verifi'];

    public function getAllTerapiWithPasienAndUsers($userId)
    {
        $query = $this->select('terapi.*, pasien.nama, pasien.j_kelamin, pasien.alamat, users.username')
            ->join('pasien', 'terapi.id_pasien = pasien.id')
            ->join('users', 'terapi.id_fisioterapis = users.id')
            ->where('terapi.verifi', false)
            ->where('DATE(terapi.tanggal) <=', date('Y-m-d')); // ⬅️ Tampilkan hanya hari ini & sebelumnya

        // Jika userId bukan admin (id ≠ 1), filter berdasarkan id_fisioterapis
        if ($userId != 1) {
            $query->where('terapi.id_fisioterapis', $userId);
        }

        return $query->get()->getResultArray();
    }


    public function getAllTerapiWithPasienAndUsersdata($userId)
    {
        // Subquery untuk mendapatkan ID terapi terbaru per pasien
        $subquery = $this->select('MAX(id) as id')
            ->where('verifi', true)
            ->groupBy('id_pasien')
            ->get()
            ->getResultArray();

        // Ambil hanya ID terapi terbaru dari hasil subquery
        $latestTerapiIds = array_column($subquery, 'id');

        // Query utama untuk mengambil detail terapi berdasarkan subquery
        $query = $this->select('terapi.*, pasien.nama, pasien.j_kelamin, pasien.alamat, users.username')
            ->join('pasien', 'terapi.id_pasien = pasien.id')
            ->join('users', 'terapi.id_fisioterapis = users.id')
            ->where('terapi.verifi', true)
            ->whereIn('terapi.id', $latestTerapiIds);

        // Jika userId bukan admin (1), tambahkan filter berdasarkan id_fisioterapis
        if ($userId != 1) {
            $query->where('terapi.id_fisioterapis', $userId);
        }

        return $query->get()->getResultArray();
    }


    public function getAllTerapiWithPasienAndUsersVerify($userId)
    {
        $db = \Config\Database::connect(); // Koneksi database manual

        // Subquery untuk mendapatkan terapi terbaru per pasien
        $subquery = "(SELECT MAX(id) FROM terapi WHERE verifi = 1 GROUP BY id_pasien)";

        // Query utama untuk mengambil detail terapi berdasarkan subquery
        $builder = $db->table('terapi')
            ->select('terapi.*, pasien.nama, pasien.j_kelamin, pasien.alamat, users.username')
            ->join('pasien', 'terapi.id_pasien = pasien.id')
            ->join('users', 'terapi.id_fisioterapis = users.id')
            ->where("terapi.id IN $subquery"); // Gunakan subquery sebagai filter

        // Jika userId bukan 1, tambahkan filter berdasarkan id_fisioterapis
        if ($userId != 1) {
            $builder->where('terapi.id_fisioterapis', $userId);
        }

        return $builder->get()->getResultArray();
    }



    // Add this method to your TerapiModel
    public function searchTerapi($keyword, $userId)
    {
        $query = $this->select('terapi.*, pasien.nama, pasien.j_kelamin, pasien.alamat, users.username')
            ->join('pasien', 'terapi.id_pasien = pasien.id')
            ->join('users', 'terapi.id_fisioterapis = users.id')
            ->where('terapi.verifi', false)
            ->where('DATE(terapi.tanggal) <=', date('Y-m-d')); // ⬅️ hanya tampilkan hari ini & sebelumnya

        // Add search conditions
        $query->groupStart()
            ->like('pasien.nama', $keyword)
            ->orLike('terapi.no_pendaftaran', $keyword)
            ->orLike('pasien.alamat', $keyword)
            ->groupEnd();

        // Apply user filtering
        if ($userId != 1) {
            $query->where('terapi.id_fisioterapis', $userId);
        }

        // Sort by date
        $query->orderBy('terapi.tanggal', 'DESC');

        // Execute query and return results
        return $query->findAll();
    }


    public function searchTerapidata($keyword, $userId)
    {
        // Subquery untuk mendapatkan terapi terbaru per pasien
        $subquery = $this->select('MAX(id) as id')
            ->where('verifi', true)
            ->groupBy('id_pasien')
            ->get()
            ->getResultArray();

        // Ambil hanya ID terapi terbaru dari hasil subquery
        $latestTerapiIds = array_column($subquery, 'id');

        // Query utama untuk mengambil detail terapi berdasarkan ID dari subquery
        $query = $this->select('terapi.*, pasien.nama, pasien.j_kelamin, pasien.alamat, users.username')
            ->join('pasien', 'terapi.id_pasien = pasien.id')
            ->join('users', 'terapi.id_fisioterapis = users.id')
            ->where('terapi.verifi', true)
            ->whereIn('terapi.id', $latestTerapiIds);

        // Tambahkan kondisi pencarian
        $query->groupStart()
            ->like('pasien.nama', $keyword)
            ->orLike('terapi.no_pendaftaran', $keyword)
            ->orLike('pasien.alamat', $keyword)
            ->groupEnd();

        // Jika userId bukan admin (1), filter berdasarkan id_fisioterapis
        if ($userId != 1) {
            $query->where('terapi.id_fisioterapis', $userId);
        }

        // Urutkan berdasarkan tanggal terbaru
        $query->orderBy('terapi.tanggal', 'DESC');

        // Jalankan query dan kembalikan hasilnya
        return $query->get()->getResultArray();
    }


    public function getAllTerapiWithPasienAndUsersdetail($id)
    {
        return $this->select('terapi.*, pasien.nama, pasien.j_kelamin, pasien.alamat, users.username')
            ->join('pasien', 'terapi.id_pasien = pasien.id')
            ->join('users', 'terapi.id_fisioterapis = users.id')
            ->where('terapi.verifi', true)
            ->where('id_pasien', $id)
            ->orderBy('terapi.tanggal', 'DESC') // Urutkan berdasarkan tanggal terbaru
            ->get()
            ->getResultArray();
    }

    public function getRiwayatPasien($id_pasien)
    {
        return $this->select('terapi.*, pasien.nama, pasien.j_kelamin, pasien.alamat')
            ->join('pasien', 'pasien.id = terapi.id_pasien')
            ->where('terapi.id_pasien', $id_pasien)
            ->findAll();
    }

    public function getTerapiWithPasienAndUsers($id)
    {
        return $this->select('terapi.*, pasien.*, users.username')
            ->join('pasien', 'terapi.id_pasien = pasien.id')
            ->join('users', 'terapi.id_fisioterapis = users.id')
            ->where('terapi.id', $id)
            ->first();
    }

    public function getAllFisioterapis()
    {
        return $this->db->table('auth_groups_users')
            ->select('users.*')
            ->join('users', 'auth_groups_users.user_id = users.id')
            ->where('auth_groups_users.group', 'fisioterapis')
            ->get()
            ->getResultArray();
    }

    public function getLatestTherapy($id_fisoterapis, $waktu)
    {
        $currentDate = $waktu;

        return $this->select('no_pendaftaran')
            ->where("DATE(tanggal)", $currentDate)
            ->where('id_fisioterapis', $id_fisoterapis) // ⬅️ INI WAJIB!
            ->orderBy('no_pendaftaran', 'DESC')
            ->first();
    }


    public function getTerapiByNoPendaftaran($id_pasien)
    {
        return $this->where('id_pasien', $id_pasien)
            ->where('verifi', false)
            ->first();
    }
}
