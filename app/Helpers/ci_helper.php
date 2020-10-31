<?php


function login($status, $validate, $req)
{
    $auth = new \App\Controllers\Auth;
    $pmodel = new \App\Models\Pengguna_model();
    $tmodel = new \App\Models\Token_model();

    if(!$validate)
    {
        return redirect()->to(base_url() . '/auth/formloginpembeli')->withInput();
    }

    $email = $req['email'];
    $password = $req['password'];

    $dataPengguna =$pmodel->getByEmail($email);

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
                if($dataPengguna['level'] == $status)
                {
                    return redirect()->to(base_url('/' . $status));
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
                    // return redirect()->to(base_url('/auth/formlogin') . $status == 'pembeli' ? 'pembeli' : ($status == 'penjual' ? 'penjual' : 'admin'));
                    $auth->response->setHeader('Location', site_url('/auth/formlogin') . $status == 'pembeli' ? 'pembeli' : ($status == 'penjual' ? 'penjual' : 'admin'));
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
                // return redirect()->to(base_url('/auth/formlogin') . $status == 'pembeli' ? 'pembeli' : ($status == 'penjual' ? 'penjual' : 'admin'));
                $auth->response->setHeader('Location', site_url('/auth/formlogin') . $status == 'pembeli' ? 'pembeli' : ($status == 'penjual' ? 'penjual' : 'admin'));
            }
        }
        else
        {
            $dToken =$tmodel->getToken($email);
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
                // return redirect()->to(base_url('/auth/formlogin') . $status == 'pembeli' ? 'pembeli' : ($status == 'penjual' ? 'penjual' : 'admin'));
                $auth->response->setHeader('Location', site_url('/auth/formlogin') . $status == 'pembeli' ? 'pembeli' : ($status == 'penjual' ? 'penjual' : 'admin'));
            }
            else
            {
               $tmodel->deleteToken($email);
               $pmodel->deletePengguna($email);
                session()->setFlashdata('pesan','
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Akun anda belum teraktivasi lebih dari 1 hari, <strong>Silahkan registrasi lagi</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ');
                // return redirect()->to(base_url('/auth/formlogin') . $status == 'pembeli' ? 'pembeli' : ($status == 'penjual' ? 'penjual' : 'admin'));
                $auth->response->setHeader('Location', site_url('/auth/formlogin') . $status == 'pembeli' ? 'pembeli' : ($status == 'penjual' ? 'penjual' : 'admin'));
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
        // return redirect()->to(base_url('/auth/formlogin') . $status == 'pembeli' ? 'pembeli' : ($status == 'penjual' ? 'penjual' : 'admin'));
        $auth->response->setHeader('Location', site_url('/auth/formlogin') . $status == 'pembeli' ? 'pembeli' : ($status == 'penjual' ? 'penjual' : 'admin'));
    }
}