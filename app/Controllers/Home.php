<?php

namespace App\Controllers;

use App\Models\PasienModel;
use App\Models\TerapiModel;
use CodeIgniter\Database\Exceptions\DataException;
use Carbon\Carbon;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\GroupModel;
use Config\Database;


class Home extends BaseController
{
    protected $pasiensModel;
    protected $terapiModel;

    public function __construct()
    {
        $this->pasiensModel = new PasienModel();
        $this->terapiModel = new TerapiModel();
        $this->db = Database::connect();
    }

    public function index()
    {
        $user = auth()->user(); // Ambil user yang login
        $userId = $user->id; // Ambil ID user
        $allTerapi = $this->terapiModel->getAllTerapiWithPasienAndUsers($userId);

        // Pastikan $pasiens dikirim sebagai array asosiatif
        return view('home', ['terapis' => $allTerapi]);
    }

    public function search()
    {
        // Make sure this is an AJAX request
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $keyword = $this->request->getPost('keyword');
        $user = auth()->user(); // Get logged-in user
        $userId = $user->id; // Get user ID

        // Search logic - modify this based on your needs
        if (!empty($keyword)) {
            // Search by patient name, registration number, or address
            $terapis = $this->terapiModel->searchTerapi($keyword, $userId);
        } else {
            // If keyword is empty, return all data
            $terapis = $this->terapiModel->getAllTerapiWithPasienAndUsers($userId);
        }

        // Load view with search results
        $data = [
            'terapis' => $terapis
        ];
        // Return only the terapis cards HTML
        return view('partials/terapi_cards', $data);
    }

    // public function index()
    // {
    //     $data = [
    //         'title' => 'Dashboard'
    //     ];

    //     return view('home', $data);
    // }

    public function create()
    {
        return view('pasiens/create');
    }

    public function store()
    {
        try {
            $id_pasien = $this->request->getPost('id_pasien');

            $getLatestTerapi = $this->terapiModel->getLatestTherapy();
            $noPendaftaran = 0;

            $cekKunjungan = $this->terapiModel->getTerapiByNoPendaftaran($id_pasien);

            if ($cekKunjungan != null) {
                return redirect()->back()->with('error', 'Kunjungan sebelumnya belum tertangani. lakukan tindakan atau hapus dari antrian!');
            }

            if ($getLatestTerapi == null) {
                $noPendaftaran = 1;
            } else {
                $noPendaftaran = $getLatestTerapi['no_pendaftaran'] + 1;
            }

            // Data terapi yang akan diinputkan
            $terapi = [
                'no_pendaftaran' => $noPendaftaran,
                'id_pasien' => $id_pasien,
                'id_fisioterapis' => $this->request->getPost('id_fisioterapis'),
                'tanggal' => $this->request->getPost('tanggal'),
                'keluhan_utama' => $this->request->getPost('keluhan_utama'),
                'riwayat_keluhan' => $this->request->getPost('riwayat_keluhan'),
                'pemeriksaan' => $this->request->getPost('pemeriksaan'),
                'treatment' => $this->request->getPost('treatment'),
                'kesimpulan' => $this->request->getPost('kesimpulan'),
                'latihan_rumah' => $this->request->getPost('latihan_rumah'),
                'evaluasi' => $this->request->getPost('evaluasi'),
            ];

            // Format tanggal terapi
            $terapi['tanggal'] = Carbon::now()->format('Y-m-d H:i:s.u');

            // Insert terapi ke database
            $this->terapiModel->insert($terapi);

            // Redirect ke halaman sebelumnya dengan pesan sukses
            return redirect()->back()->with('message', 'Data pasien dan terapi berhasil disimpan!');
        } catch (\Exception $e) {
            // Jika terjadi error, tangkap dan kembalikan dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function pasien()
    {
        $pasien = $this->pasiensModel->findAll();
        return view('pasiens/index', ['pasiens' => $pasien]);
    }

    public function create_pasien()
    {
        return view('pasiens/create_pasien');
    }


    public function store_pasien()
    {
        // Aturan validasi dengan pesan kustom
        $rules = [
            'nama_pasien' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama pasien wajib diisi.'
                ]
            ],
            'tgl_lahir' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => 'Tanggal lahir wajib diisi.',
                    'valid_date' => 'Format tanggal lahir tidak valid.'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat wajib diisi.'
                ]
            ],
            'no_hp' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Nomor HP wajib diisi.',
                    'numeric' => 'Nomor HP harus berupa angka.'
                ]
            ],
            'pekerjaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pekerjaan wajib diisi.'
                ]
            ],
            'j_kelamin' => [
                'rules' => 'required|in_list[L,P]',
                'errors' => [
                    'required' => 'Jenis kelamin wajib diisi.',
                    'in_list' => 'Jenis kelamin harus dipilih antara Laki-laki atau Perempuan.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return view('pasiens/create_pasien', [
                'validation' => $this->validator
            ]);
        }

        // Jika validasi sukses, simpan data
        $pasien = [
            'nama' => $this->request->getPost('nama_pasien'),
            'tgl_lahir' => $this->request->getPost('tgl_lahir'),
            'alamat' => $this->request->getPost('alamat'),
            'no_hp' => $this->request->getPost('no_hp'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'j_kelamin' => $this->request->getPost('j_kelamin')
        ];

        $this->pasiensModel->insert($pasien);

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->to('/pasiens')->with('message', 'Data pasien berhasil disimpan!');
    }

    public function edit_pasien($id)
    {
        $pasien = $this->pasiensModel->find($id);
        if (!$pasien) {
            return redirect()->to('/pasiens')->with('error', 'Pasien tidak ditemukan.');
        }

        return view('pasiens/edit_pasien', ['pasien' => $pasien]);
    }

    // Proses update pasien
    public function update_pasien($id)
    {
        $rules = [
            'nama' => 'required',
            'tgl_lahir' => 'required|valid_date',
            'alamat' => 'required',
            'no_hp' => 'required|numeric',
            'pekerjaan' => 'required',
            'j_kelamin' => 'required|in_list[L,P]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'tgl_lahir' => $this->request->getPost('tgl_lahir'),
            'alamat' => $this->request->getPost('alamat'),
            'no_hp' => $this->request->getPost('no_hp'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'j_kelamin' => $this->request->getPost('j_kelamin')
        ];

        $this->pasiensModel->update($id, $data);

        return redirect()->to('/pasiens')->with('message', 'Data pasien berhasil diperbarui.');
    }


    public function delete_pasien($id)
    {
        $this->pasiensModel->delete($id);
        return redirect()->to('/pasiens')->with('message', 'Data pasien berhasil dihapus.');
    }

    public function delete_kunjungan($id)
    {
        $this->terapiModel->delete($id);
        return redirect()->to('/')->with('message', 'Data antrian berhasil dihapus.');
    }

    public function verify($id)
    {
        $this->terapiModel->update($id, ['verifi' => true]);
        return redirect()->to('/')->with('message', 'Antrian berhasil diverifikasi.');
    }

    public function input_data($id)
    {
        $terapi = $this->terapiModel->find($id);
        return view('pasiens/input_data', ["terapi" => $terapi]); // Perbaikan array
    }
    public function update_terapi()
    {
        // Ambil ID terapi dari form
        $id = $this->request->getPost('id_terapi');

        // Validasi input (Opsional)
        if (
            !$this->validate([
                'keluhan_utama' => 'required',
                'riwayat_keluhan' => 'required',
                'pemeriksaan' => 'required',
                'treatment' => 'required',
                'kesimpulan' => 'required',
                'latihan_rumah' => 'required',
                'evaluasi' => 'required',
            ])
        ) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Data yang akan diupdate
        $data = [
            'keluhan_utama' => $this->request->getPost('keluhan_utama'),
            'riwayat_keluhan' => $this->request->getPost('riwayat_keluhan'),
            'pemeriksaan' => $this->request->getPost('pemeriksaan'),
            'treatment' => $this->request->getPost('treatment'),
            'kesimpulan' => $this->request->getPost('kesimpulan'),
            'latihan_rumah' => $this->request->getPost('latihan_rumah'),
            'evaluasi' => $this->request->getPost('evaluasi'),
            'verifi' => true
        ];

        // Update data berdasarkan ID
        $this->terapiModel->update($id, $data);

        // Redirect ke halaman utama dengan pesan sukses
        return redirect()->to('/')->with('message', 'Data terapi berhasil diperbarui.');
    }


    public function createRm()
    {
        $fisioterapis = $this->terapiModel->getAllFisioterapis();
        $pasiens = $this->pasiensModel->findAll();
        // Pastikan $pasiens dikirim sebagai array asosiatif
        return view('pasiens/create_rm', ['fisioterapis' => $fisioterapis, 'pasiens' => $pasiens]);
    }

    public function pasienid($id)
    {
        $pasien = $this->pasiensModel->find($id);
        return $this->response->setJSON($pasien);
    }

    public function detail($id)
    {
        $getTerapi = $this->terapiModel->getTerapiWithPasienAndUsers($id);
        if ($getTerapi == null) {
            error_log("ID not found: " . $id);
            return $this->response->setStatusCode(404, "Data tidak ditemukan");
        }
        return $this->response->setJSON($getTerapi);
    }

    public function register()
    {
        // Validasi input
        $rules = [
            'email' => 'required|valid_email|is_unique[auth_identities.secret]',
            'username' => 'required|min_length[3]|is_unique[users.username]',
            'password' => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', array_values($this->validator->getErrors()));
        }

        // Ambil instance UserModel dari Shield
        $users = auth()->getProvider();

        try {
            // Buat user baru
            $user = new User([
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password')
            ]);

            // Simpan user
            $users->save($user);

            // Ambil user berdasarkan email
            $user = $users->findByCredentials(['email' => $this->request->getPost('email')]);

            if (!$user) {
                return redirect()->back()->with('error', 'User tidak ditemukan setelah registrasi.');
            }

            // Aktifkan user
            $user->activate();

            // Masukkan user ke dalam grup "fisioterapis"
            $this->db->table('auth_groups_users')->insert([
                'user_id' => $user->id,
                'group' => 'fisioterapis'
            ]);

            return redirect()->back()->with('message', 'Fisioterapis berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }



    public function riwayat($id)
    {
        $allTerapi = $this->terapiModel->getAllTerapiWithPasienAndUsersdetail($id);

        if (!empty($allTerapi)) {
            $pasienData = $allTerapi[0]; // Ambil data pertama jika ada
        } else {
            $pasienData = null;
        }

        return view('pasiens/riwayat_pasien', [
            'terapis' => $allTerapi,
            'pasien' => $pasienData
        ]);
    }

    public function data_pasien(){
        $user = auth()->user(); // Ambil user yang login
        $userId = $user->id; // Ambil ID user
        $allTerapi = $this->terapiModel->getAllTerapiWithPasienAndUsersVerify($userId);

        // Pastikan $pasiens dikirim sebagai array asosiatif
        return view('pasiens/data_pasien', ['terapis' => $allTerapi]);
    }

    public function search_pasien()
    {
        // Make sure this is an AJAX request
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $keyword = $this->request->getPost('keyword');
        $user = auth()->user(); // Get logged-in user
        $userId = $user->id; // Get user ID

        // Search logic - modify this based on your needs
        if (!empty($keyword)) {
            // Search by patient name, registration number, or address
            $terapis = $this->terapiModel->searchTerapidata($keyword, $userId);
        } else {
            // If keyword is empty, return all data
            $terapis = $this->terapiModel->getAllTerapiWithPasienAndUsersdata($userId);
            // dd($terapis);
        }

        // Load view with search results
        $data = [
            'terapis' => $terapis
        ];
        // Return only the terapis cards HTML
        return view('partials/terapi_cards', $data);
    }

}
