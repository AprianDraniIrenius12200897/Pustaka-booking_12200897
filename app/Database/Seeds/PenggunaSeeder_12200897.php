<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PenggunaSeeder_12200897 extends Seeder
{
    public function run()
    {
        //
        $data = [
            [
                'nama'      => 'Aprian Drani Irenius',
                'password'  => md5('12200897')
            ],
            [
                'nama'      => 'admin',
                'password'  => md5('23456')
            ],
            [
                'nama'      => '12200897',
                'password'  => md5('Aprian Drani Irenius')
            ]
        ];

        $p = new Pengguna();
        $p->insertBatch($data);
    }
}