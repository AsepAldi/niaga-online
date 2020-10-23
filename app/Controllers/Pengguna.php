<?php namespace App\Controllers;

class Pengguna extends BaseController
{

    protected $pModel;
    protected $bModel;

    public function __construct()
    {
        $this->pModel = new \App\Models\Pengguna_model();
        $this->bModel = new \App\Models\Barang_model();
    }

    public function index()
    {
        $email = session()->get('email');
        $data = [
            'title' => 'Admin | Niaga 11',
            'nama' => $this->pModel->getByEmail($email),            
        ];
        echo view('layout/header', $data);
        echo view('pengguna/dashboard');
        echo view('layout/footer');
    }
}