<?php 
namespace App\Models;

use CodeIgniter\Model;

class Penjual_model extends Model 
{
    protected $table = 't_penjual';
    protected $allowedFields = ['nama_lengkap', 'nama_toko', 'email', 'nomor_telepon',];
    protected $useTimestamps = true;
}