<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting')->insert([
            [
                'nama_perusahaan' => 'Toko Saya',
                'alamat' => 'Jln. Aja dulu',
                'telepon' => '0986523178',
                'tipe_nota' => 1, //tipe kecil
                'diskon' => 5,
                'path_logo' => '/img/logo.png',
                'path_kartu_member' => '/img/member.png',
                'created_at' => Date('Y-m-d H:i:s'),
                'updated_at' => Date('Y-m-d H:i:s'),
            ]
        ]);
    }
}
