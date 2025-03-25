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
            ->where('terapi.verifi', false);

        // Jika userId bukan 1, tambahkan filter berdasarkan id_fisioterapis
        if ($userId != 1) {
            $query->where('terapi.id_fisioterapis', $userId);
        }

        return $query->get()->getResultArray();
    }

    public function getAllTerapiWithPasienAndUsersdata($userId)
    {
        $query = $this->select('terapi.*, pasien.nama, pasien.j_kelamin, pasien.alamat, users.username')
            ->join('pasien', 'terapi.id_pasien = pasien.id')
            ->join('users', 'terapi.id_fisioterapis = users.id')
            ->where('terapi.verifi', true);

        // Jika userId bukan 1, tambahkan filter berdasarkan id_fisioterapis
        if ($userId != 1) {
            $query->where('terapi.id_fisioterapis', $userId);
        }

        return $query->get()->getResultArray();
    }

    public function getAllTerapiWithPasienAndUsersVerify($userId)
    {
        $query = $this->select('terapi.*, pasien.nama, pasien.j_kelamin, pasien.alamat, users.username')
            ->join('pasien', 'terapi.id_pasien = pasien.id')
            ->join('users', 'terapi.id_fisioterapis = users.id')
            ->where('terapi.verifi', true);

        // Jika userId bukan 1, tambahkan filter berdasarkan id_fisioterapis
        if ($userId != 1) {
            $query->where('terapi.id_fisioterapis', $userId);
        }

        return $query->get()->getResultArray();
    }

    // Add this method to your TerapiModel
    public function searchTerapi($keyword, $userId)
    {
        $query = $this->select('terapi.*, pasien.nama, pasien.j_kelamin, pasien.alamat, users.username')
            ->join('pasien', 'terapi.id_pasien = pasien.id')
            ->join('users', 'terapi.id_fisioterapis = users.id')
            ->where('terapi.verifi', false);


        // Add search conditions
        $query->groupStart()
            ->like('pasien.nama', $keyword)
            ->orLike('terapi.no_pendaftaran', $keyword)
            ->orLike('pasien.alamat', $keyword)
            ->groupEnd();

        // Apply user filtering
        if ($userId != 1) {
            // If not admin (assuming user ID 1 is admin)
            $query->where('terapi.id_fisioterapis', $userId);
        }

        // Sort by date
        $query->orderBy('terapi.tanggal', 'DESC');

        // Execute query and return results
        return $query->findAll();
    }

    public function searchTerapidata($keyword, $userId)
    {
        $query = $this->select('terapi.*, pasien.nama, pasien.j_kelamin, pasien.alamat, users.username')
            ->join('pasien', 'terapi.id_pasien = pasien.id')
            ->join('users', 'terapi.id_fisioterapis = users.id')
            ->where('terapi.verifi', true);


        // Add search conditions
        $query->groupStart()
            ->like('pasien.nama', $keyword)
            ->orLike('terapi.no_pendaftaran', $keyword)
            ->orLike('pasien.alamat', $keyword)
            ->groupEnd();

        // Apply user filtering
        if ($userId != 1) {
            // If not admin (assuming user ID 1 is admin)
            $query->where('terapi.id_fisioterapis', $userId);
        }

        // Sort by date
        $query->orderBy('terapi.tanggal', 'DESC');

        // Execute query and return results
        return $query->findAll();
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

    public function getLatestTherapy()
    {
        $currentDate = date('Y-m-d');
        return $this->select('no_pendaftaran')
            ->where("DATE(tanggal)", $currentDate)
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
