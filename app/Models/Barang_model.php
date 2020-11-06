<?php 
namespace App\Models;

use CodeIgniter\Model;

class Barang_model extends Model
{
    protected $table = 't_barang';
    protected $allowedFields = ['id_penjual', 'nama_barang', 'foto_barang', 'harga_barang', 'banyak_barang', 'deskripsi_barang'];

    public function getBarang($keyword = null)
    {

        if($keyword)
        {            
            return $this->table('t_barang')->select('t_barang.id_barang, t_pengguna.nama_pengguna AS nama_penjual, t_barang.nama_barang, t_barang.banyak_barang, t_barang.harga_barang')
                ->join('t_pengguna', 't_pengguna.id_pengguna = t_barang.id_penjual')
                    ->like('nama_penjual', $keyword)->orLike('nama_barang', $keyword)->orLike('banyak_barang', $keyword)->orLike('harga_barang', $keyword);
        }
        else
        {
            return $this->table('t_barang')->select('t_barang.id_barang, t_pengguna.nama_pengguna AS nama_penjual, t_barang.nama_barang, t_barang.banyak_barang, t_barang.harga_barang')
                ->join('t_pengguna', 't_pengguna.id_pengguna = t_barang.id_penjual');
        }
    }

    public function getAllBarang($keyword = null)
    {
        if($keyword)
        {
            return $this->table('t_barang')->like('nama_barang', $keyword);
        }
        else
        {
            return $this->table('t_barang');
        }
    }

    public function getMyBarang($email, $keyword = null)
    {
        if($keyword)
        {
            return $this->db->table('t_barang')->select('t_barang.id_barang, t_penjual.nama_lengkap AS nama_penjual, t_penjual.email, t_barang.nama_barang, t_barang.banyak_barang, t_barang.harga_barang')
            ->join('t_penjual', 't_penjual.id_penjual = t_barang.id_penjual')
                ->where('email', $email)->from('t_barang')
                ->like('nama_barang', $keyword)->orLike('banyak_barang', $keyword)->orLike('harga_barang', $keyword);
        }
        else
        {
            return $this->table('t_barang')->select('t_barang.id_barang, t_penjual.nama_lengkap, t_penjual.email, t_barang.nama_barang, t_barang.foto_barang, t_barang.banyak_barang, t_barang.deskripsi_barang, t_barang.harga_barang')
                ->join('t_penjual', 't_penjual.id_penjual = t_barang.id_penjual')->where('email', $email);            
        }
    }

    public function getBarangbyId($id)
    {
        return $this->db->table('t_barang')->getWhere(['id_barang' => $id])->getRowArray();
    }

    public function updateBarang($data)
    {
        $this->db->table('t_barang')->set($data)->where('id_barang', $data['id_barang'])->update();
    }

    public function deletebyId($id_barang)
    {
        $this->db->table('t_barang')->where('id_barang', $id_barang)->delete();
    }    
}