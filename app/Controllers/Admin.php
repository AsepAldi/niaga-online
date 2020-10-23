<?php namespace App\Controllers;

use CodeIgniter\Controller;
use Config\App;

class Admin extends BaseController
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
            'pengguna' => $this->pModel->findAll(),
            'barang' => $this->bModel->findAll()
            // 'transaksi' => $this->
        ];
        echo view('layout/header', $data);
        echo view('admin/dashboard');
        echo view('layout/footer');
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
            'nama' => $this->pModel->getByEmail($email),
            'pengguna' => $pengguna->paginate(6, 'pengguna'),
            'pager' => $pengguna->pager,
            'currentPage' => $currentPage,
            'hasil' => $pengguna

        ];
        echo view('layout/header', $data);
        echo view('admin/pengguna');
        echo view('layout/footer');
    }

    public function barang()
    {
        $email = session()->get('email');
        $currentPage = $this->request->getGet('page_barang') ? $this->request->getGet('page_barang') : 1;

        if($this->request->getPost('keyword'))
        {
            $barang = $this->bModel->getBarang($this->request->getPost('keyword'));
        }
        else
        {
            $barang = $this->bModel;
        }
                
        $data = [
            'title' => 'Admin | Niaga 11',
            'nama' => $this->pModel->getByEmail($email),
            'barang' => $barang->paginate(6, 'barang'),
            'pager' => $barang->pager,
            'currentPage' => $currentPage
       ];
        echo view('layout/header', $data);
        echo view('admin/barang');
        echo view('layout/footer');
    }

}