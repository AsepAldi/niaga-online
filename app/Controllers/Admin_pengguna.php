<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Admin_pengguna extends BaseController
{
    protected $pModel;

    public function __construct()
    {
        $this->pModel = new \App\Models\Pengguna_model();
    }

    public function index()
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

        ];        
        echo view('layout/header', $data);
        echo view('admin_pengguna/index');
        echo view('layout/footer');
    }
}