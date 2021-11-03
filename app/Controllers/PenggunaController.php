<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Pengguna;

class PenggunaController extends BaseController
{
    public function index(){
        return view('halaman/pengguna/table', [
            'pengguna' => (new Pengguna())->get()->getResult(),
            'error'    => $this->session->getFlashdata('error'),
            'data'     => $data
        ]);
    }

    public function form(){
        return view('halaman/pengguna/form', [
            'vd' => $this->session->getFlasdata('validator')
        ]);
    }
    
    private function validasi(){
        return validasi(
            [
                'nama'       => 'required',
                'password'   => 'required|min_length(6)',
                'password2'  => 'required|min_length(6)|matches(password)'
            ],
            [
                'nama'       => [ 'required' => 'Nama Pengguna Harus Diisikan' ],
                'password'   => [
                                'required' => 'Kata sandi harus diisikan',
                                'min_length' => 'Minimal karakter 6 huruf'
                            ],
                'password2'  => [
                                'required'     => 'Ulangi kata sandi harus diisikan',
                                'min_length'   => 'Minimal karakter 6 huruf',
                                'matches'      => 'Kata sandi tidak cocok'
                            ]
            ]
        );
    }

    public function simpan(){
        if( $this->validasi() ){
            return 'proses simpan dijalankan';
        }else{
            return redirect()->to('/pengguna')->with('validator', $this->validator);
        }
    }

    public function edit($id){
        $data = (new Pengguna())->where('id', $id->first);

        if($data == null){
            return redirect()->to('/pengguna-list')->with('erro', 'pengguna tidak ditemukan');
        }else{
            return $this->form($data);
        }
    }
    private function validasiPatch(){
        return validasi(
            [
                'nama'       => 'required',
            ],
            [
                'nama'       => [ 'required' => 'Nama Pengguna Harus Diisikan' ]
            ]
        );
    }
    public function patch(){

        $id = $this->request->getPost('id');
        $data = [
            'nama' => $this->request->getPost('nama'),
        ];

        if ($this->request->getPost('password') != '') {
            $data['password'] = md5($this->request->getPost('password'));
        }

        if( $this->validasiPatch() ){
            $r = (new Pengguna_12200897())->update($id, $data);
            if($r == true){
                return redirect()->to('/pengguna-list');
            }else{
                return redirect()->to('/pengguna/'.$id)->with('error', 'Data gagal diupdate');
            }
            
        }else{
            return redirect()->to('/pengguna/'.$id)->with('validator', $this->validator);
        }
        
    }

    public function delete(){
        $id = $this->request->getPost('id');
        $r = (new PenggunaModel_12200897())->delete($id);
        $rd = redirect()->to('/pengguna-list');
        if ($r == false) {
            $rd->with('error', 'Pengguna gagal dihapus');
        }
        return $rd;
    }
}
