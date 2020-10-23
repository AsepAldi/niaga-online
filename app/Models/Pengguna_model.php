<?php 
namespace App\Models;

use CodeIgniter\Model;

class Pengguna_model extends Model 
{
    protected $table = 't_pengguna';
    protected $allowedFields = ['nama_pengguna', 'email', 'nomor_telepon', 'password', 'is_active'];
    protected $useTimestamps = true;    

    public function getByEmail($email)
    {
        return $this->db->table('t_pengguna')->getWhere(['email' => $email])->getRowArray();
    }

    public function deletePengguna($email)
    {
        $this->db->table('t_pengguna')->delete(['email' => $email]);
        return true;
    }

    public function updateActive($email)
    {
        $this->db->table('t_pengguna')->set('is_active', 1)->where('email', $email)->update();
        return true;
    }

    public function search($keyword)
    {
        return $this->table('t_pengguna')->like('nama_pengguna', $keyword)->orLike('email', $keyword)->orLike('nomor_telepon', $keyword)->orLike('level', $keyword);
    }
}