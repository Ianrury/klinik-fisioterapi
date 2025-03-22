<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienModel extends Model
{
    protected $table = 'pasien';
    protected $primaryKey = 'id';
    protected $useAutoIncrements = true;
    protected $allowedFields = ['nama', 'tgl_lahir', 'alamat', 'no_hp', 'pekerjaan', 'j_kelamin'];
}
