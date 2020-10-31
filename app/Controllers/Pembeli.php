<?php namespace App\Controllers;

class Pembeli extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Niaga 11'
        ];
        echo view('layout/pembeli_header', $data);
    }
}