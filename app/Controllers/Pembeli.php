<?php namespace App\Controllers;

class Pembeli extends BaseController
{
    protected $pemModel;
    protected $pModel;
    protected $bModel;
    protected $uri;

    public function __construct()
    {
        $this->pemModel = new \App\Models\Pembeli_model();
        $this->pModel = new \App\Models\Pengguna_model();
        $this->bModel = new \App\Models\Barang_model();
        $this->uri = service('uri');
    }

    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        $currentPage = $this->request->getGet('page_barang') ? $this->request->getGet('page_barang') : 1;
        
        if($keyword)
        {
            $barang = $this->bModel->getAllBarang($keyword);
        }
        else
        {
            $barang = $this->bModel->getAllBarang();
        }
        $data = [
            'title' => 'Niaga 11',
            'barang' => $barang->paginate(6, 'barang'),
            'pager' => $barang->pager,
            'currentPage' => $currentPage,   
        ];
        echo view('pembeli/index', $data);
    }

    public function profil()
    {
        if($this->cekakses() == false)
        {
            return redirect()->back();
        }

        $email = session()->get('email');
        $data = [
            'title' => 'Niaga 11',
            'user' => $this->pemModel->getByEmail($email),
            'validation' => \Config\Services::validation()
        ];
        echo view('pembeli/profil', $data);
    }

    public function edit_profil()
    {
        if($this->cekakses() == false)
        {
            return redirect()->back();
        }
        
        if(!$this->validate([
            'nama' => [
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
            'tanggal_lahir' => [
                'rules' => 'required',
                'errors' => [                    
                    'required' => 'Nomor Telepon tidak boleh kosong'
                ]
                ],
            'foto' => [
                'rules' => 'is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,1024]'
            ]
        ]))
        {            
            return redirect()->to('/pembeli/profil/')->withInput();
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
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'foto' => $namaGambar
        ];

        $dataPengguna = [
            'nama_pengguna' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email')
        ];

        $this->pemModel->editData($data);
        $this->pModel->ubahData($dataPengguna, 'pembeli');
        session()->setFlashdata('pesan','
		<div class="alert alert-success alert-dismissible fade show" role="alert">
		  	Data Berhasil Diubah.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
	  	</div>
		');		
        return redirect()->to('/pembeli/profil/' . $this->request->getPost('email'));

    }

    public function ganti_password()
    {
        if($this->cekakses() == false)
        {
            return redirect()->back();
        }

        $email = session()->get('email');
        $data = [
            'title' => 'Niaga 11',
            'user' => $this->pemModel->getByEmail($email),
            'validation' => \Config\Services::validation()
        ];
        echo view('pembeli/ganti_password', $data);
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
            return redirect()->to(base_url('/pembeli/ganti_password/' . $this->request->getPost('email')))->withInput();
        }

        $user = $this->pModel->getByEmailandLevel($this->request->getPost('email'), 'pembeli');
        $passwordLama = $this->request->getPost('current_password');
        $passwordBaru = $this->request->getPost('new_password');

        if(password_verify($passwordLama, $user['password']))
        {
            $this->pModel->gantiPassword($this->request->getPost('email'), 'pembeli', $passwordBaru);
            session()->setFlashdata('pesan','
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Password Berhasil diubah.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ');		
            return redirect()->to('/pembeli/ganti_password/' . $this->request->getPost('email'));
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
            return redirect()->to('/pembeli/ganti_password/' . $this->request->getPost('email'));
        }
    }

    public function detail()
    {
        $email = session()->get('email');
        $id_barang = $this->uri->getSegment(3);
        if(!$id_barang)
        {
            return redirect()->back();
        }
        $data = [
            'title' => 'Niaga 11',
            'user' => $this->pemModel->getByEmail($email),
            'barang' => $this->bModel->getBarangbyId($id_barang)
        ];
        echo view('pembeli/detail_barang', $data);
    }

    private function cekakses()
	{
		if(session()->get('level'))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}