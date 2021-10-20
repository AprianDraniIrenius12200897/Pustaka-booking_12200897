<?php

namespace App\Models;

use CodeIgniter\Model;

class Pengguna_12200897 extends Model
{
    protected $DBGroup              = 'koneksiku';
    protected $table                = 'pengguna_12200897';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $returnType           = 'array';
    protected $protectFields        = true;
    protected $allowedFields        = ['nama', 'password'];

    /**
     * method untuk cek login dari table pengguna
     * berdasarkan nama dan passsword
     * @var string $user
     * @var string pass
     */
    public function cekLogin($user, $pass){
        return $this->where('nama', $user)
                    ->where('password', md5($pass))->first();
    }
} 