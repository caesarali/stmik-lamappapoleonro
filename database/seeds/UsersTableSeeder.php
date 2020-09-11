<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Mahasiswa;
use App\Tahun;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
    		'name' => 'Administrator',
    		'email' => 'admin@stmik-lamappapoleonro',
    		'password' => '$2y$10$iwLO2XesgEazE0mzLaLypuklg5AjqQSZ1x/Bo.jQ3XuX0O4okh9P6'
    	]);

        $tahun = Tahun::Create(['tahun' => '2014']);
        $stambuk = ['001', '002', '003', '004', '005', '006', '007', '008', '009', '010', '011', '012', '013', '014', '015'];

        $i = 1;
        foreach ($stambuk as $stb) {
            Mahasiswa::create([
                'name' => 'Mahasiswa-'.$i++,
                'stambuk' => '141401'.$stb,
                'jk' => 0,
                'tahun_id' => 1,
                'jurusan_id' => 1,
                'status' => 1,
            ]);
        }
    }
}
