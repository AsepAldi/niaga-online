<?php 
namespace App\Models;

use CodeIgniter\Model;

class Pengguna_model extends Model 
{
    protected $table = 't_pengguna';
    protected $allowedFields = ['nama_pengguna', 'email', 'password', 'level', 'is_active'];
    protected $useTimestamps = true;    

    public function getByEmail($email)
    {
        return $this->db->table('t_pengguna')->getWhere(['email' => $email])->getRowArray();
    }

    public function getByEmailandLevel($email, $level)
    {
        return $this->db->table('t_pengguna')->getWhere(['email' => $email, 'level' => $level])->getRowArray();
    }

    public function deletePengguna($email)
    {
        $this->db->table('t_pengguna')->delete(['email' => $email]);
        return true;
    }

    public function updateActive($email)
    {
        $this->db->table('t_pengguna')->set('is_active', 1)->where('email', $email)->where('is_active', 0)->update();
        $this->useTimestamps;
        return true;
    }

    public function search($keyword)
    {
        return $this->table('t_pengguna')->like('nama_pengguna', $keyword)->orLike('email', $keyword)->orLike('level', $keyword);
    }

    public function gantiPassword($email, $level, $password)
    {
        $this->db->table('t_pengguna')->set('password', password_hash($password, PASSWORD_DEFAULT))->where('email', $email)
            ->where('level', $level)->update();
        $this->useTimestamps;
        return true;
    }

    public function ubahData($data, $level)
    {
        $this->db->table('t_pengguna')->set($data)->where('email', $data['email'])->where('level', $level)->update();
        $this->useTimestamps;
    }
}