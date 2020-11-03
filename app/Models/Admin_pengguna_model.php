<?php 
namespace App\Models;

use CodeIgniter\Model;

class Admin_pengguna_model extends Model 
{
    protected $table = 't_admin_pengguna';
    protected $allowedFields = ['nama', 'email', 'nomor_telepon'];
    protected $useTimestamps = true;

    public function search($keyword)
    {
        return $this->table('t_admin_pengguna')->like('nama', $keyword)->orLike('email', $keyword)->orLike('nomor_telepon', $keyword);
    }

    public function getByEmail($email)
    {
        return $this->db->table('t_admin_pengguna')->getWhere(['email' => $email])->getRowArray();
    }
    
    public function editData($data)
    {
        $this->db->table('t_admin_pengguna')->set($data)->where('email', $data['email'])->update();
        $this->useTimestamps;
        return true;
    }
}