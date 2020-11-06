<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Admin_pengguna extends BaseController
{
    protected $pModel;
    protected $pemModel;
    protected $penModel;
    protected $APModel;
    protected $ALModel;
    protected $uri;

    public function __construct()
    {
        $this->APModel = new \App\Models\Admin_pengguna_model();
        $this->pemModel = new \App\Models\Pembeli_model();
        $this->pModel = new \App\Models\Pengguna_model();
        $this->penModel = new \App\Models\Penjual_model();
        $this->ALModel = new \App\Models\Admin_laporan_model();     
        $this->uri = service('uri');
    }

    public function pengguna()
    {
        $email = session()->get('email');
        $currentPage = $this->request->getGet('page_pengguna') ? $this->request->getGet('page_pengguna') : 1;

        if($this->request->getPost('keyword'))
        {
            $pengguna = $this->pModel->search($this->request->getPost('keyword'));
        }
        else
        {
            $pengguna = $this->pModel;
        }
        $data = [
            'title' => 'Admin | Niaga 11',
            'user' => $this->APModel->getByEmail($email),
            'pengguna' => $pengguna->paginate(6, 'pengguna'),
            'pager' => $pengguna->pager,
            'currentPage' => $currentPage,            

        ];        
        echo view('layout/header', $data);
        echo view('admin_pengguna/index');
        echo view('layout/footer');
    }

    public function pembeli()
    {
        $email = session()->get('email');
        $currentPage = $this->request->getGet('page_pembeli') ? $this->request->getGet('page_pembeli') : 1;

        if($this->request->getPost('keyword'))
        {
            $pembeli = $this->pemModel->search($this->request->getPost('keyword'));
        }
        else
        {
            $pembeli = $this->pemModel;
        }
        $data = [
            'title' => 'Admin | Niaga 11',
            'user' => $this->APModel->getByEmail($email),
            'pembeli' => $pembeli->paginate(6, 'pembeli'),
            'pager' => $pembeli->pager,
            'currentPage' => $currentPage,            

        ];        
        echo view('layout/header', $data);
        echo view('admin_pengguna/pembeli');
        echo view('layout/footer');   
    }

    public function penjual()
    {
        $email = session()->get('email');
        $currentPage = $this->request->getGet('page_penjual') ? $this->request->getGet('page_penjual') : 1;

        if($this->request->getPost('keyword'))
        {
            $penjual = $this->penModel->search($this->request->getPost('keyword'));
        }
        else
        {
            $penjual = $this->penModel;
        }
        $data = [
            'title' => 'Admin | Niaga 11',
            'user' => $this->APModel->getByEmail($email),
            'penjual' => $penjual->paginate(6, 'penjual'),
            'pager' => $penjual->pager,
            'currentPage' => $currentPage,            

        ];        
        echo view('layout/header', $data);
        echo view('admin_pengguna/penjual');
        echo view('layout/footer');
    }

    public function admnpengguna()
    {
        $email = session()->get('email');
        $currentPage = $this->request->getGet('page_admnpengguna') ? $this->request->getGet('page_admnpengguna') : 1;

        if($this->request->getPost('keyword'))
        {
            $admnpengguna = $this->APModel->search($this->request->getPost('keyword'));
        }
        else
        {
            $admnpengguna = $this->APModel;
        }
        $data = [
            'title' => 'Admin | Niaga 11',
            'user' => $this->APModel->getByEmail($email),
            'admnpengguna' => $admnpengguna->paginate(6, 'admnpengguna'),
            'pager' => $admnpengguna->pager,
            'currentPage' => $currentPage,            

        ];        
        echo view('layout/header', $data);
        echo view('admin_pengguna/admin_pengguna');
        echo view('layout/footer');
    }

    public function admnlaporan()
    {
        $email = session()->get('email');
        $currentPage = $this->request->getGet('page_admnlaporan') ? $this->request->getGet('page_admnlaporan') : 1;

        if($this->request->getPost('keyword'))
        {
            $admnlaporan = $this->ALModel->search($this->request->getPost('keyword'));
        }
        else
        {
            $admnlaporan = $this->ALModel;
        }
        $data = [
            'title' => 'Admin | Niaga 11',
            'user' => $this->APModel->getByEmail($email),
            'admnlaporan' => $admnlaporan->paginate(6, 'admnlaporan'),
            'pager' => $admnlaporan->pager,
            'currentPage' => $currentPage,            

        ];        
        echo view('layout/header', $data);
        echo view('admin_pengguna/admin_laporan');
        echo view('layout/footer');
    }
    
    public function tambahadmin()
    {
        $email = session()->get('email');
        $data = [
            'title' => 'Admin | Niaga 11',
            'user' => $this->APModel->getByEmail($email),
            'validation' => \Config\Services::validation()
        ];

        echo view('layout/header', $data);
        echo view('admin_pengguna/tambah_admin');
        echo view('layout/footer');
    }

    public function create()
    {
        $level = $this->request->getPost('level');
        $level = $level == 'admin_pengguna' ? '[t_admin_pengguna.email]' : '[t_admin_laporan.email]';        
        if(!$this->validate([
            'nama' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong'
                ]
                ],
            'email' => [
                'rules' => 'required|valid_email|is_unique' . $level,
                'errors' => [
                    'required' => 'Email tidak boleh kosong',
                    'valid_email' => 'Email tidak valid'
                ]
                ],
            'no_telp' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Nomor Telepon tidak boleh kosong',
                    'numeric' => 'Nomor Telepon hanya boleh angka saja'
                ]
                ],
            'level' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Level tidak boleh kosong'
                    ]
                ],
            'password' => [
                'rules' => 'required|min_length[5]|matches[password2]',
                'errors' => [
                    'required' => 'Password tidak boleh kosong',
                    'min_length' => 'Password minimal 5 karakter',
                    'mathces' => 'Password tidak sesuai'
                ]
                ],
            'password2' => [
                'rules' => 'required|min_length[5]|matches[password]',
                'errors' => [
                    'required' => 'Password tidak boleh kosong',
                    'min_length' => 'Password minimal 5 karakter',
                    'mathces' => 'Password tidak sesuai'
                ]
            ]
        ]))
        {
            return redirect()->to('/admin_pengguna/tambahadmin')->withInput();
        }

        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $nomor_telepon = $this->request->getPost('no_telp');
        $level = $this->request->getPost('level');
        $password = $this->request->getPost('password');

        $data = [
            'nama_pengguna' => $nama,
            'email' => $email,
            'level' => $level,
            'is_active' => 1,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        $dataAdmin = [
            'nama' => $nama,
            'email' => $email,
            'nomor_telepon' => $nomor_telepon,
        ];

        $this->pModel->insert($data);
        if($data['level'] == 'admin_pengguna')
        {
            $this->APModel->insert($dataAdmin);
        }
        else
        {
            $this->ALModel->insert($dataAdmin);
        }

        session()->setFlashdata('pesan','
		<div class="alert alert-success alert-dismissible fade show" role="alert">
		  	Data Berhasil Diinput.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
	  	</div>
		');
		return redirect()->to(base_url() . '/admin_pengguna/tambahadmin');
    }

    public function edit_profile()
    {
        $email = $this->uri->getSegment(3);
        if(!$email)
        {
            return redirect()->to('/admin_pengguna/pengguna');
        }

        $data = [
            'title' => 'Admin | Niaga 11',
            'user' => $this->APModel->getByEmail($email),
            'validation' => \Config\Services::validation()
        ];        
        
        echo view('layout/header', $data);
        echo view('admin_pengguna/edit_profil');
        echo view('layout/footer');
    }

    public function ganti_profil()
    {
        if(!$this->validate([
            'nama' => [
                'rules' => 'required|trim|alpha_space',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong',
                    'alpha_space' => 'Isi nama dengan huruf saja.'
                ]
                ],            
            'nomor_telepon' => [
                'rules' => 'required|numeric',
                'errors' => [                    
                    'required' => 'Nomor Telepon tidak boleh kosong',
                    'numeric' => 'Nomor Telepon hanya boleh angka saja'
                ]
                ],
            'foto' => [
                'rules' => 'is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,1024]'
            ]
        ]))
        {            
            return redirect()->to('/admin_pengguna/edit_profile/' . $this->request->getPost('email'))->withInput();
        }

        $fileGambar = $this->request->getFile('foto');

        if($fileGambar->getError() == 4)
        {
            $namaGambar = $this->request->getPost('gambarlama');
        }
        else
        {
            $namaGambar = $fileGambar->getName();
            $fileGambar->move('img/profil', $namaGambar);
            if($this->request->getPost('gambarlama') != 'avatar.png')
            {
                unlink('img/profil/' . $this->request->getPost('gambarlama'));
            }

            $image = \Config\Services::image()
                    ->withFile('img/profil/' . $namaGambar)
                    ->fit(512, 512, 'center')
                    ->save('img/profil/' . $namaGambar);
        }               

        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'nomor_telepon' => $this->request->getPost('nomor_telepon'),
            'foto' => $namaGambar
        ];

        $dataPengguna = [
            'nama_pengguna' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email')
        ];

        $this->APModel->editData($data);
        $this->pModel->ubahData($dataPengguna, 'admin_pengguna');
        session()->setFlashdata('pesan','
		<div class="alert alert-success alert-dismissible fade show" role="alert">
		  	Data Berhasil Diubah.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
	  	</div>
		');		
        return redirect()->to('/admin_pengguna/edit_profile/' . $this->request->getPost('email'));

    }

    public function ganti_password()
    {
        $email = $this->uri->getSegment(3);
        if(!$email)
        {
            return redirect()->to('/admin_pengguna/pengguna');
        }

        $data = [
            'title' => 'Admin | Niaga 11',
            'user' => $this->APModel->getByEmail($email),
            'validation' => \Config\Services::validation()
        ];        
        
        echo view('layout/header', $data);
        echo view('admin_pengguna/ganti_password');
        echo view('layout/footer');
    }

    public function ubah_password()
    {
        if(!$this->validate([
            'current_password' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'kolom tidak boleh kosong',
                    'min_length' => 'minimal 5 karakter'
                ]
                ],
            'new_password' => [
                'rules' => 'required|min_length[5]|matches[password2]',
                'errors' => [
                    'required' => 'kolom tidak boleh kosong',
                    'min_length' => 'minimal 5 karakter',
                    'matches' => 'password tidak sesuai'
                ]
                ],
            'password2' => [
                'rules' => 'required|min_length[5]|matches[new_password]',
                'errors' => [
                    'required' => 'kolom tidak boleh kosong',
                    'min_length' => 'minimal 5 karakter',
                    'matches' => 'password tidak sesuai'
                ]
                ],
        ]))
        {
            return redirect()->to(base_url('/admin_pengguna/ganti_password/' . $this->request->getPost('email')))->withInput();
        }

        $user = $this->pModel->getByEmailandLevel($this->request->getPost('email'), 'admin_pengguna');
        $passwordLama = $this->request->getPost('current_password');
        $passwordBaru = $this->request->getPost('new_password');

        if(password_verify($passwordLama, $user['password']))
        {
            $this->pModel->gantiPassword($this->request->getPost('email'), 'admin_pengguna', $passwordBaru);
            session()->setFlashdata('pesan','
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Password Berhasil diubah.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ');		
            return redirect()->to('/admin_pengguna/ganti_password/' . $this->request->getPost('email'));
        }
        else
        {
            session()->setFlashdata('pesan','
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Password lama tidak sesuai.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ');		
            return redirect()->to('/admin_pengguna/ganti_password/' . $this->request->getPost('email'));
        }
    }
}