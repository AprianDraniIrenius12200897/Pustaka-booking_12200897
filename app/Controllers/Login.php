<?php

namespace App\Controllers;

use App\Models\Pengguna_12200897;
use Config\Services;
use CodeIgniter\Model;

class Login extends BaseController
{
    public function cekLogin()
    {
        $e = $this->request->getPost('email');
        $s = $this->request->getPost('sandi');

        $v = $this->validate([
            'email' => 'required',
            'sandi' => 'required'
        ], [
            'email'=>[
                'required'    => 'Email tidak boleh kosong'
            ],
            'sandi' =>[
                'required'    => 'Sandi tidak boleh kosong'
            ]
        ]);

        $this->session->set('email', $e);
        $this->session->set('sandi', $s);

        if( $v == false ){
            $this->session->setFlashdata('validator', $this->validator);
            return redirect()->to('/login');
        }else{
            
            $vl = (new Pengguna_12200897())->cekLogin($e, $s);
            
            if($vl == null){
                return redirect()->to('/login')->with('error', 'User dan sandi salah');
            }else{
                $this->session->set('sudahLogin', true);
                return redirect()->to('/beranda');
            }
        }
        
    }

    public function beranda(){

    }

}