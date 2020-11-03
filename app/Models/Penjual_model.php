<?php 
namespace App\Models;

use CodeIgniter\Model;

class Penjual_model extends Model 
{
    protected $table = 't_penjual';
    protected $allowedFields = ['nama_lengkap', 'nama_toko', 'email', 'nomor_telepon'];
    protected $useTimestamps = true;

    public function search($keyword)
    {
        return $this->table('t_penjual')->like('nama_lengkap', $keyword)->orLike('nama_toko', $keyword)->orLike('email', $keyword)->orLike('nomor_telepon', $keyword);
    }
}