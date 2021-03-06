<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Auth extends BaseController
{

	protected $pModel;
	protected $tModel;
	protected $pemModel;
	protected $penModel;
	protected $email;	

	public function __construct()
	{			
		$this->pModel = new \App\Models\Pengguna_model();
		$this->tModel = new \App\Models\Token_model();
		$this->pemModel = new \App\Models\Pembeli_model();
		$this->penModel = new \App\Models\Penjual_model();
		$this->email = \Config\Services::email();		
	}

	public function formLoginPembeli()
	{		
		if($this->cekakses() == true)
		{
			return redirect()->back();
		}
		$data = [
			'title' => 'Login | Niaga 11',
			'validation' =>  \Config\Services::validation()
		];

		return view('auth/login', $data);		
	}

	public function formLoginPenjual()
	{
		if($this->cekakses() == true)
		{
			return redirect()->back();
		}
		
		$data = [
			'title' => 'Login Penjual | Niaga 11',
			'validation' =>  \Config\Services::validation()
		];		

		return view('auth/login', $data);
	}

	public function formRegisPembeli()
	{
		if($this->cekakses() == true)
		{
			return redirect()->back();
		}
		$data = [
			'title' => 'Register | Niaga 11',
			'validation' =>  \Config\Services::validation()
		];

		return view('auth/register', $data);
	}

	public function formLoginAdmin()
	{
		if($this->cekakses() == true)
		{
			return redirect()->back();
		}
		$data = [
			'title' => 'Login Admin | Niaga 11',
			'validation' =>  \Config\Services::validation()
		];		

		return view('auth/login', $data);
	}

	public function formRegisPenjual()
	{
		if($this->cekakses() == true)
		{
			return redirect()->back();
		}
		$data = [
			'title' => 'Register | Niaga 11',
			'validation' =>  \Config\Services::validation()
		];

		

		return view('auth/register', $data);
	}

	public function loginPembeli()
	{
		if($this->cekakses() == true)
		{
			return redirect()->back();
		}
		$val = $this->validate([
			'email' => [
				'rules' => 'required|trim|valid_email',
				'errors' => [
					'required' => 'kolom email tidak boleh kosong',
					'valid_email' => 'email tidak valid'
				]
			],
			'password' => [
				'rules' => 'required|trim|min_length[5]',
				'errors' => [
					'required' => 'password tidak boleh kosong',
					'min_length' => 'password minimal 5 karakter'
				]
			]
		]);

		if(!$val)
		{
			return redirect()->to(base_url() . '/auth/formloginpembeli')->withInput();
		}

		$email = $this->request->getPost('email');
		$password = $this->request->getPost('password');

		$dataPengguna = $this->pModel->getByEmailandLevel($email, 'pembeli');

		if($dataPengguna)
		{
			if($dataPengguna['is_active'] == 1)
			{
				if($dataPengguna['password'] == password_verify($password, $dataPengguna['password']))
				{
					$data = [
						'email' => $dataPengguna['email'],
						'level' => $dataPengguna['level']
					];

					session()->set($data);
					if($dataPengguna['level'] == 'pembeli')
					{
						return redirect()->to(base_url('/pembeli'));
					}
					else
					{
						session()->setFlashdata('pesan','
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							Login gagal, <strong>Akun tidak terdaftar</strong>.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						');
						return redirect()->to(base_url('/auth/formloginpembeli'));
					}
				}
				else
				{
					session()->setFlashdata('pesan','
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Login gagal, <strong>password salah</strong>.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					');
					return redirect()->to(base_url('/auth/formloginpembeli'));
				}
			}
			else
			{
				$dToken = $this->tModel->getToken($email);
				$waktuBuat = strtotime($dToken['created_at']);
				$tambah1jam = $waktuBuat + 60 * 60 * 24;
				$now = time();

				if($now < $tambah1jam)
				{
					session()->setFlashdata('pesan','
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Akun anda belum di aktivasi, <strong>silahkan cek email untuk aktivasi</strong>.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					');
					return redirect()->to(base_url('/auth/formloginpembeli'));
				}
				else
				{
					$this->tModel->deleteToken($email);
					$this->pModel->deletePengguna($email);
					session()->setFlashdata('pesan','
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Akun anda belum teraktivasi lebih dari 1 hari, <strong>Silahkan registrasi lagi</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					');
					return redirect()->to(base_url('/auth/formloginpembeli'));
				}

				
			}
		}
		else
		{
			session()->setFlashdata('pesan','
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Login gagal, <strong>Akun tidak terdaftar</strong>.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			');
			return redirect()->to(base_url('/auth/formloginpembeli'));
		}
	}

	public function loginPenjual()
	{
		if($this->cekakses() == true)
		{
			return redirect()->back();
		}
		$val = $this->validate([
			'email' => [
				'rules' => 'required|trim|valid_email',
				'errors' => [
					'required' => 'kolom email tidak boleh kosong',
					'valid_email' => 'email tidak valid'
				]
			],
			'password' => [
				'rules' => 'required|trim|min_length[5]',
				'errors' => [
					'required' => 'password tidak boleh kosong',
					'min_length' => 'password minimal 5 karakter'
				]
			]
		]);

		if(!$val)
		{
			return redirect()->to(base_url() . '/auth/formloginpenjual')->withInput();
		}

		$email = $this->request->getPost('email');
		$password = $this->request->getPost('password');

		$dataPengguna = $this->pModel->getByEmailandLevel($email,'penjual');

		if($dataPengguna)
		{
			if($dataPengguna['is_active'] == 1)
			{
				if($dataPengguna['password'] == password_verify($password, $dataPengguna['password']))
				{
					$data = [
						'email' => $dataPengguna['email'],
						'level' => $dataPengguna['level']
					];

					session()->set($data);
					if($dataPengguna['level'] == 'penjual')
					{
						return redirect()->to(base_url('/penjual'));
					}
					else
					{
						session()->setFlashdata('pesan','
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							Login gagal, <strong>Akun tidak terdaftar</strong>.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						');
						return redirect()->to(base_url('/auth/formloginpenjual'));
					}
				}
				else
				{
					session()->setFlashdata('pesan','
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Login gagal, <strong>password salah</strong>.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					');
					return redirect()->to(base_url('/auth/formloginpenjual'));
				}
			}
			else
			{
				$dToken = $this->tModel->getToken($email);
				$waktuBuat = strtotime($dToken['created_at']);
				$tambah1jam = $waktuBuat + 60 * 60 * 24;
				$now = time();

				if($now < $tambah1jam)
				{
					session()->setFlashdata('pesan','
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Akun anda belum di aktivasi, <strong>silahkan cek email untuk aktivasi</strong>.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					');
					return redirect()->to(base_url('/auth/formloginpenjual'));
				}
				else
				{
					$this->tModel->deleteToken($email);
					$this->pModel->deletePengguna($email);
					session()->setFlashdata('pesan','
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Akun anda belum teraktivasi lebih dari 1 hari, <strong>Silahkan registrasi lagi</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					');
					return redirect()->to(base_url('/auth/formloginpenjual'));
				}

				
			}
		}
		else
		{
			session()->setFlashdata('pesan','
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Login gagal, <strong>Akun tidak terdaftar</strong>.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			');
			return redirect()->to(base_url('/auth/formloginpenjual'));
		}
	}

	public function loginAdmin()
	{
		if($this->cekakses() == true)
		{
			return redirect()->back();
		}
		$val = $this->validate([
			'email' => [
				'rules' => 'required|trim|valid_email',
				'errors' => [
					'required' => 'kolom email tidak boleh kosong',
					'valid_email' => 'email tidak valid'
				]
			],
			'password' => [
				'rules' => 'required|trim|min_length[5]',
				'errors' => [
					'required' => 'password tidak boleh kosong',
					'min_length' => 'password minimal 5 karakter'
				]
			]
		]);

		if(!$val)
		{
			return redirect()->to(base_url() . '/auth/formloginadmin')->withInput();
		}

		$email = $this->request->getPost('email');
		$password = $this->request->getPost('password');

		$dataPengguna = $this->pModel->getByEmail($email);

		if($dataPengguna)
		{
			if($dataPengguna['is_active'] == 1)
			{
				if($dataPengguna['password'] == password_verify($password, $dataPengguna['password']))
				{
					$data = [
						'email' => $dataPengguna['email'],
						'level' => $dataPengguna['level']
					];

					session()->set($data);
					if($dataPengguna['level'] == 'admin_pengguna')
					{
						return redirect()->to(base_url('/admin_pengguna/pengguna'));
					}
					elseif($dataPengguna['level'] == 'admin_laporan')
					{
						return redirect()->to(base_url('/admin_laporan/pengguna'));
					}
					else
					{
						session()->setFlashdata('pesan','
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							Login gagal, <strong>Akun tidak terdaftar</strong>.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						');
						return redirect()->to(base_url('/auth/formloginadmin'));
					}
				}
				else
				{
					session()->setFlashdata('pesan','
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Login gagal, <strong>password salah</strong>.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					');
					return redirect()->to(base_url('/auth/formloginadmin'));
				}
			}
			else
			{
				$dToken = $this->tModel->getToken($email);
				$waktuBuat = strtotime($dToken['created_at']);
				$tambah1jam = $waktuBuat + 60 * 60 * 24;
				$now = time();

				if($now < $tambah1jam)
				{
					session()->setFlashdata('pesan','
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Akun anda belum di aktivasi, <strong>silahkan cek email untuk aktivasi</strong>.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					');
					return redirect()->to(base_url('/auth/formloginadmin'));
				}
				else
				{
					$this->tModel->deleteToken($email);
					$this->pModel->deletePengguna($email);
					session()->setFlashdata('pesan','
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Akun anda belum teraktivasi lebih dari 1 hari, <strong>Silahkan registrasi lagi</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					');
					return redirect()->to(base_url('/auth/formloginadmin'));
				}

				
			}
		}
		else
		{
			session()->setFlashdata('pesan','
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Login gagal, <strong>Akun tidak terdaftar</strong>.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			');
			return redirect()->to(base_url('/auth/formloginadmin'));
		}
	}

	public function daftarpembeli()
	{
		if($this->cekakses() == true)
		{
			return redirect()->back();
		}
		$val = $this->validate(
			[
				'nama' => [
					'rules' => 'required|trim|alpha_space',
					'errors' => [
						'required' => 'kolom {field} tidak boleh kosong',
						'alpha_space' => 'isi kolom {field} dengan huruf saja'
					]
				],
				'email' => [
					'rules' => 'required|valid_email|is_unique[t_pengguna.email,level,penjual]',
					'errors' => [
						'required' => 'Email tidak boleh kosong',
						'is_unique' =>'{field} sudah terdaftar',
						'valid_email' => '{field} tidak valid'
					]
				],
				'jenis_kelamin' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Jenis kelamin tidak boleh kosong'
					]
				],
				'no_telp' => [
					'rules' => 'required|trim|numeric',
					'errors' => [
						'required' => 'Nomor Telepon tidak boleh kosong',
						'numeric' => 'Isi kolom nomor telepon dengan angka saja'
					]
				],
				'password' => [
					'rules' => 'required|min_length[5]|matches[password2]',
					'errors' => [
						'required' => 'Password tidak boleh kosong',
						'min_length' => 'Password minimal 5 karakter',
						'matches' => 'Password tidak sesuai'
					]
				],
				'password2' => [
					'rules' => 'required|min_length[5]|matches[password]',
					'errors' => [
						'required' => 'Password tidak boleh kosong',
						'min_length' => 'Password minimal 5 karakter',
						'matches' => 'Password tidak sesuai'
					]
				],
			]
		  );
  
		if(!$val){			
			return redirect()->to(base_url() . '/auth/formregispembeli')->withInput();
		}
		$data = array(
			  'nama_pengguna' => $this->request->getPost('nama'),
			  'email' => $this->request->getPost('email'),
			  'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
			  'level' => 'pembeli',
			  'is_active' => 0
		  );
		$dataPembeli = array(
			'nama' => $this->request->getPost('nama'),
			'foto' => 'avatar.png',
			'email' => $this->request->getPost('email'),
			'nomor_telepon' => $this->request->getPost('no_telp'),
			'jenis_kelamin' => $this->request->getPost('jenis_kelamin')			
		);
		$token = bin2hex(random_bytes(15));
		$this->sendEmail($token, $data['email'], 'aktivasi');

		$this->pemModel->insert($dataPembeli);
		$this->pModel->insert($data);
		$this->tModel->insert(['email' => $data['email'], 'token' => $token]);
		
		session()->setFlashdata('pesan','
		<div class="alert alert-success alert-dismissible fade show" role="alert">
		  	Registrasi berhasil, <strong>Cek email anda untuk aktivasi akun</strong>.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
	  	</div>
		');
		return redirect()->to(base_url() . '/auth/formloginpembeli');
	}

	public function daftarpenjual()
	{
		if($this->cekakses() == true)
		{
			return redirect()->back();
		}
		$val = $this->validate(
			[
				'nama_lengkap' => [
					'rules' => 'required|trim|alpha_space',
					'errors' => [
						'required' => 'kolom {field} tidak boleh kosong',
						'alpha_space' => 'isi kolom {field} dengan huruf saja'
					]
				],
				'nama_toko' => [
					'rules' => 'required|is_unique[t_penjual.nama_toko]',
					'errors' => [
						'required' => 'kolom {field} tidak boleh kosong',
						'is_unique' => 'nama toko sudah ada'
					]
				],
				'email' => [
					'rules' => 'required|valid_email|is_unique[t_pengguna.email,level,pembeli]',
					'errors' => [
						'required' => 'Email tidak boleh kosong',
						'is_unique' =>'{field} sudah terdaftar',
						'valid_email' => '{field} tidak valid'
					]
				],				
				'no_telp' => [
					'rules' => 'required|trim|numeric',
					'errors' => [
						'required' => 'Nomor Telepon tidak boleh kosong',
						'numeric' => 'Isi kolom nomor telepon dengan angka saja'
					]
				],
				'password' => [
					'rules' => 'required|min_length[5]|matches[password2]',
					'errors' => [
						'required' => 'Password tidak boleh kosong',
						'min_length' => 'Password minimal 5 karakter',
						'matches' => 'Password tidak sesuai'
					]
				],
				'password2' => [
					'rules' => 'required|min_length[5]|matches[password]',
					'errors' => [
						'required' => 'Password tidak boleh kosong',
						'min_length' => 'Password minimal 5 karakter',
						'matches' => 'Password tidak sesuai'
					]
				],
			]
		  );
  
		if(!$val){			
			return redirect()->to(base_url() . '/auth/formregispenjual')->withInput();
		}
		$data = array(
			  'nama_pengguna' => $this->request->getPost('nama_lengkap'),
			  'email' => $this->request->getPost('email'),
			  'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
			  'level' => 'penjual',
			  'is_active' => 0
		  );
		$dataPenjual = array(
			'nama_lengkap' => $this->request->getPost('nama_lengkap'),
			'foto' => 'avatar.png',
			'nama_toko' => $this->request->getPost('nama_toko'),
			'email' => $this->request->getPost('email'),
			'nomor_telepon' => $this->request->getPost('no_telp'),
		);
		
		$token = bin2hex(random_bytes(15));
		$this->sendEmail($token, $data['email'], 'aktivasi');

		$this->penModel->insert($dataPenjual);
		$this->pModel->insert($data);
		$this->tModel->insert(['email' => $data['email'], 'token' => $token]);
		
		session()->setFlashdata('pesan','
		<div class="alert alert-success alert-dismissible fade show" role="alert">
		  	Registrasi berhasil, <strong>Cek email anda untuk aktivasi akun</strong>.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
	  	</div>
		');
		return redirect()->to(base_url() . '/auth/formloginpenjual');
	}

	public function lupaPassword()
	{
		if($this->cekakses() == true)
		{
			return redirect()->back();
		}
		$data = [
			'title' => 'Lupa Password | Niaga 11',
			'validation' =>  \Config\Services::validation()
		];		

		return view('auth/lupapassword', $data);
	}

	public function gantipassword()
	{
		if(!$this->validate([
			'email' => [
				'rules' => 'required|valid_email',
				'errors' => [
					'required' => 'email tidak boleh kosong',
					'valid_email' => 'email tidak valid'
				]
				],
			'level' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'level tidak boleh kosong'
				]
			]
		]))
		{
			return redirect()->to('/auth/lupapassword')->withInput();
		}

		

		$email = $this->request->getPost('email');
		$level = $this->request->getPost('level');
		$data = $this->pModel->getByEmailandLevel($email,$level);

		if($data['email'] == $email && $data['level'] == $level)
		{
			$char = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';			
			$passwordbaru = '';
			for($i =0; $i <= 6; $i++)
			{
				$passwordbaru .= $char[rand(0,  strlen($char) - 1)];
			}
			$this->pModel->gantiPassword($email, $level, $passwordbaru);
			$this->sendEmail($passwordbaru, $email, 'gantipassword');
			session()->setFlashdata('pesan','
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				Password anda telah berubah, <strong>Cek email untuk melihat password baru anda.</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			');
			return redirect()->to('/auth/formlogin' . $level);
		}
		else
		{
			session()->setFlashdata('pesan','
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Email tidak terdaftar
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			');
			return redirect()->to('/auth/lupapassword');
		}

	}

	public function aktivasi()
	{		
		$email = $this->request->getGet('email');
		$token = $this->request->getGet('token');
		
		$dataToken = $this->tModel->getToken($email);

		if($dataToken)
		{
			if($dataToken['token'] == $token)
			{
				$waktuBuat = strtotime($dataToken['created_at']);
				$tambah1hari = $waktuBuat + 60 * 60 * 24;
				$now = time();
				
				if($now < $tambah1hari)
				{
					$this->tModel->deleteToken($email);
					$level = $this->pModel->getByEmail($email);
					$this->pModel->updateActive($email);
					session()->setFlashdata('pesan','
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						Aktivasi berhasil, <strong>Anda bisa login sekarang</strong>.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					');
					return redirect()->to(base_url() . '/auth/formlogin' . $level['level']);
				}
				else
				{
					$this->tModel->deleteToken($email);
					$this->pModel->deletePengguna($email);
					session()->setFlashdata('pesan','
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						waktu aktivasi melebihi 1 hari, <strong>silahkan registrasi lagi.</strong> 
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					');
					return redirect()->to(base_url() . '/auth/formloginpembeli');
				}
			}
			else
			{
				session()->setFlashdata('pesan','
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					Gagal Aktivasi, <strong>Token salah.</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				');
				return redirect()->to(base_url() . '/auth/formloginpembeli');
			}
		}
		else
		{
			session()->setFlashdata('pesan','
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Gagal Aktivasi, <strong>Email tidak terdaftar.</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			');
			return redirect()->to(base_url() . '/auth/formloginpembeli');
		}
	}

	public function block()
	{
		$level = session()->get('level');
		$data['title'] = 'Akses Ditolak';
		if($level == null)
		{
			$data['link'] = '/';
		}
		else
		{
			$data['link'] = '/' . $level;
		}

		return view('auth/block', $data);
	}

	public function logout()
	{		
		if(!$this->cekakses() == true)
		{
			return redirect()->back();
		}
		session()->destroy();
		return redirect()->to(base_url());
	}

	private function sendEmail($token, $email, $status)
	{
		if($status == 'aktivasi')
		{
			$pesan = 'Klik <a href="' . base_url('/auth/aktivasi?email=') . $email . '&token=' . $token . '">disini</a> untuk aktivasi akun anda.<br>Note: <strong>Anda mempunyai waktu 1 hari untuk aktivasi akun.</strong>';
			$this->email->setFrom('niagaonline111@gmail.com', 'Niaga 11');
			$this->email->setTo($email);
			$this->email->setSubject('Niaga 11 | Aktivasi Akun');
			$this->email->setMessage($pesan);
		}
		elseif($status == 'gantipassword')
		{
			$pesan = 'Password anda telah di ganti menjadi <strong>' . $token . '</strong><br>
					Silahkan login lalu ganti password anda.';
			$this->email->setFrom('niagaonline111@gmail.com', 'Niaga 11');
			$this->email->setTo($email);
			$this->email->setSubject('Niaga 11 | Lupa Password');
			$this->email->setMessage($pesan);
		}
		

		if($this->email->send())
		{
			return true;
		}
		else
		{
			echo $this->email->printDebugger();
			die;
		}
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

	//--------------------------------------------------------------------

}