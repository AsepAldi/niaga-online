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
            return $this->table()->select('t_barang.id_barang, t_barang.id_barang, t_pengguna.nama_pengguna AS nama_penjual, t_barang.nama_barang, t_barang.banyak_barang, t_barang.harga_barang')
                ->join('t_pengguna', 't_pengguna.id_pengguna = t_barang.id_penjual')
                    ->like('nama_penjual', $keyword)->orLike('nama_barang', $keyword)->orLike('banyak_barang', $keyword)->orLike('harga_barang', $keyword)
                        ->get()->getResultArray();
        }
        else
        {
            return $this->table()->select('t_barang.id_barang, t_barang.id_barang, t_pengguna.nama_pengguna AS nama_penjual, t_barang.nama_barang, t_barang.banyak_barang, t_barang.harga_barang')
                ->join('t_pengguna', 't_pengguna.id_pengguna = t_barang.id_penjual')
                    ->get()->getResultArray();
        }
    }
}