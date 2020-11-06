<?php namespace App\Controllers;

class Penjual extends BaseController
{
    protected $pModel;
    protected $bModel;
    protected $penModel;
    protected $uri;

    public function __construct()
    {
        $this->pModel = new \App\Models\Pengguna_model();
        $this->bModel = new \App\Models\Barang_model();
        $this->penModel = new \App\Models\Penjual_model();
        $this->uri = service('uri');
    }

    public function utama()
    {
        $email = session()->get('email');      
        $currentPage = $this->request->getGet('page_barang') ? $this->request->getGet('page_barang') : 1;

        if($this->request->getPost('keyword'))
        {
            $barang = $this->bModel->getMyBarang($email);
        }
        else
        {
            $barang = $this->bModel->getMyBarang($email, $this->request->getPost('keyword'));
        }   
        $data = [
            'title' => 'Penjual | Niaga 11',
            'user' => $this->penModel->getByEmail($email),
            'validation' => \Config\Services::validation(),
            'barang' => $barang->paginate(6, 'barang'),
            'pager' => $barang->pager,
            'currentPage' => $currentPage,  
        ];        
        
        echo view('layout/header', $data);
        echo view('penjual/utama');
        echo view('layout/footer');
    }

    public function tambah_barang()
    {
        if(!$this->validate([
            'nama_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Barang tidak boleh kosong'
                ]
                ],
            'harga_barang' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga Barang tidak boleh kosong',
                    'numeric' => 'Isi Harga dengan angka saja'
                ]
                ],
            'banyak_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Stok tidak boleh kosong'
                ]
                ],
            'deskripsi_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi tidak boleh kosong'
                ]
                ],  
            'foto_barang' => [
                'rules' => 'uploaded[foto_barang]|is_image[foto_barang]|mime_in[foto_barang,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => 'Tidak dapat mengaupload file selain gambar.',
                    'mime_in' => 'Foto anda bermasalah',
                    'uploaded' => 'Anda harus memasukan foto barang.'
                ]
            ],            
        ]))
        {
            return redirect()->to('/penjual/utama')->withInput();
        }

        $filegambar = $this->request->getFile('foto_barang');
        $namagambar = $filegambar->getName();
        
        $data = [
            'id_penjual' => $this->request->getPost('id_penjual'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'harga_barang' => $this->request->getPost('harga_barang'),
            'banyak_barang' => $this->request->getPost('banyak_barang'),
            'deskripsi_barang' => $this->request->getPost('deskripsi_barang'),
            'foto_barang' => $namagambar
        ];

        $this->bModel->insert($data);
        $filegambar->move('img/barang', $namagambar);

        session()->setFlashdata('pesan','
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Barang telah ditambahkan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        ');
        return redirect()->to(base_url('/penjual/utama'));

    }

    public function edit_profile()
    {
        
        $email = $this->uri->getSegment(3);
        if(!$email)
        {
            return redirect()->to('/admin_pengguna/pengguna');
        }

        $data = [
            'title' => 'Penjual | Niaga 11',
            'user' => $this->penModel->getByEmail($email),
            'validation' => \Config\Services::validation()
        ];        
        
        echo view('layout/header', $data);
        echo view('penjual/edit_profile');
        echo view('layout/footer');
    }

    public function ganti_profil()
    {
        if(!$this->validate([
            'nama_lengkap' => [
                'rules' => 'required|trim|alpha_space',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong',
                    'alpha_space' => 'Isi nama dengan huruf saja.'
                ]
                ],
            'nama_toko' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong'                    
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
            return redirect()->to('/penjual/edit_profile/' . $this->request->getPost('email'))->withInput();
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
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'nama_toko' => $this->request->getPost('nama_toko'),
            'email' => $this->request->getPost('email'),
            'nomor_telepon' => $this->request->getPost('nomor_telepon'),
            'foto' => $namaGambar
        ];

        $dataPengguna = [
            'nama_pengguna' => $this->request->getPost('nama_lengkap'),
            'email' => $this->request->getPost('email')
        ];

        $this->penModel->editData($data);
        $this->pModel->ubahData($dataPengguna, 'penjual');
        session()->setFlashdata('pesan','
		<div class="alert alert-success alert-dismissible fade show" role="alert">
		  	Data Berhasil Diubah.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
	  	</div>
		');		
        return redirect()->to('/penjual/edit_profile/' . $this->request->getPost('email'));
    }

    public function edit_barang()
    {
        $email = session()->get('email');        
        $id_barang = $this->uri->getSegment(3);
        if(!$id_barang)
        {
            return redirect()->to('/penjual/utama');
        }

        $data = [
            'title' => 'Penjual | Niaga 11',
            'user' => $this->penModel->getByEmail($email),
            'barang' => $this->bModel->getBarangbyId($id_barang),
            'validation' => \Config\Services::validation()
        ];

        echo view('layout/header', $data);
        echo view('penjual/edit_barang');
        echo view('layout/footer');
    }

    public function ganti_password()
    {
        $email = $this->uri->getSegment(3);
        if(!$email)
        {
            return redirect()->to('/penjual/utama');
        }

        $data = [
            'title' => 'Penjual | Niaga 11',
            'user' => $this->penModel->getByEmail($email),
            'validation' => \Config\Services::validation()
        ];        
        
        echo view('layout/header', $data);
        echo view('penjual/ganti_password');
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
            return redirect()->to(base_url('/penjual/ganti_password/' . $this->request->getPost('email')))->withInput();
        }

        $user = $this->pModel->getByEmailandLevel($this->request->getPost('email'), 'penjual');
        $passwordLama = $this->request->getPost('current_password');
        $passwordBaru = $this->request->getPost('new_password');

        if(password_verify($passwordLama, $user['password']))
        {
            $this->pModel->gantiPassword($this->request->getPost('email'), 'penjual', $passwordBaru);
            session()->setFlashdata('pesan','
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Password Berhasil diubah.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ');		
            return redirect()->to('/penjual/ganti_password/' . $this->request->getPost('email'));
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
            return redirect()->to('/penjual/ganti_password/' . $this->request->getPost('email'));
        }
    }

    public function update_barang()
    {
        if(!$this->validate([
            'nama_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Barang tidak boleh kosong'
                ]
                ],
            'harga_barang' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga Barang tidak boleh kosong',
                    'numeric' => 'Isi Harga dengan angka saja'
                ]
                ],
            'banyak_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Stok tidak boleh kosong'
                ]
                ],
            'deskripsi_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi tidak boleh kosong'
                ]
                ],  
            'foto_barang' => [
                'rules' => 'is_image[foto_barang]|mime_in[foto_barang,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => 'Tidak dapat mengaupload file selain gambar.',
                    'mime_in' => 'Foto anda bermasalah',
                ]
            ]
        ]))
        {
            return redirect()->to('/penjual/edit_barang')->withInput();
        }

        $filegambar = $this->request->getFile('foto_barang');

        if($filegambar->getError() == 4)
        {
            $namagambar = $this->request->getPost('gambarlama');
        }
        else
        {            
            $namagambar = $filegambar->getName();            
            $filegambar->move('img/barang', $namagambar);
        }        
        
        $data = [
            'id_barang' => $this->request->getPost('id_barang'),
            'id_penjual' => $this->request->getPost('id_penjual'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'harga_barang' => $this->request->getPost('harga_barang'),
            'banyak_barang' => $this->request->getPost('banyak_barang'),
            'deskripsi_barang' => $this->request->getPost('deskripsi_barang'),
            'foto_barang' => $namagambar
        ];

        $this->bModel->updateBarang($data);
        session()->setFlashdata('pesan','
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Barang telah diedit.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        ');
        return redirect()->to(base_url('/penjual/utama'));
    }

    public function hapus_barang()
    {
        
        $id_barang = $this->uri->getSegment(3);
        if(!$id_barang)
        {
            return redirect()->to('/penjual/utama');
        }

        $this->bModel->deletebyId($id_barang);        
        session()->setFlashdata('pesan','
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Barang telah diedit.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        ');
        return redirect()->to(base_url('/penjual/utama'));
    }

    
    public function chat()
    {
        $email = session()->get('email');
        $data = [
            'title' => 'Penjual | Niaga 11',
            'nama' => $this->pModel->getByEmail($email),            
        ];  
        echo view('penjual/menu-utama/chat', $data);
    }

    public function lihat_pembeli()
    {
        
    }

    // public function pesanan()
    // {
    //     $email = session()->get('email');
    //     $data = [
    //         'title' => 'Penjual | Niaga 11',
    //         'nama' => $this->pModel->getByEmail($email),            
    //     ];  
    //     echo view('penjual/menu-utama/pesanan', $data);
    // }



    // public function transaksi()
    // {
    //     $email = session()->get('email');
    //     $data = [
    //         'title' => 'Penjual | Niaga 11',
    //         'nama' => $this->pModel->getByEmail($email),            
    //     ];  
    //     echo view('penjual/menu-utama/transaksi', $data);
    // }

}