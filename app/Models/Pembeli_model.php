<?php 
namespace App\Models;

use CodeIgniter\Model;

class Pembeli_model extends Model 
{
    protected $table = 't_pembeli';
    protected $allowedFields = ['nama', 'foto', 'tanggal_lahir', 'jenis_kelamin', 'email', 'nomor_telepon'];
    protected $useTimestamps = true;

    public function search($keyword)
    {
        return $this->table('t_pembeli')->like('nama', $keyword)->orLike('email', $keyword)->orLike('nomor_telepon', $keyword);
    }

    public function getByEmail($email)
    {
        return $this->db->table('t_pembeli')->getWhere(['email' => $email])->getRowArray();
    }

    public function editData($data)
    {
        $this->db->table('t_pembeli')->set($data)->where('email', $data['email'])->update();
        $this->useTimestamps;
        return true;
    }
}