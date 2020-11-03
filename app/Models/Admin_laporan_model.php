<?php 
namespace App\Models;

use CodeIgniter\Model;

class Admin_laporan_model extends Model 
{
    protected $table = 't_admin_laporan';
    protected $allowedFields = ['nama', 'email', 'nomor_telepon'];
    protected $useTimestamps = true;

    public function search($keyword)
    {
        return $this->table('t_penjual')->like('nama', $keyword)->orLike('email', $keyword)->orLike('nomor_telepon', $keyword);
    }

    public function getByEmail($email)
    {
        return $this->db->table('t_admin_laporan')->getWhere(['email', $email])->getRowArray();
    }
}