<?php 
namespace App\Models;

use CodeIgniter\Model;

class Pembeli_model extends Model 
{
    protected $table = 't_pembeli';
    protected $allowedFields = ['nama', 'tanggal_lahir', 'jenis_kelamin', 'email', 'nomor_telepon'];
    protected $useTimestamps = true;
}