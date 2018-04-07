<?php

use Illuminate\Database\Seeder;
use App\Jurusan;

class JurusanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jurusans = [
        	['name' => 'Teknik Informatika', 'jenjang' => 'S1', 'slug' => 'teknik-informatika'],
        	['name' => 'Sistem Informasi', 'jenjang' => 'S1', 'slug' => 'sistem-informasi'],
        	['name' => 'Manajemen Informatika', 'jenjang' => 'D3', 'slug' => 'manajemen-informatika']
        ];

        foreach ($jurusans as $jurusan) {
        	Jurusan::create($jurusan);
        }
    }
}
