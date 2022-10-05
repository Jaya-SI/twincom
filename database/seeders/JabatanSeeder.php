<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jabatans')->insert([
            'nama' => 'Admin'
        ]);

        DB::table('jabatans')->insert([
            'nama' => 'Admin Keuangan'
        ]);

        DB::table('jabatans')->insert([
            'nama' => 'HRD'
        ]);

        DB::table('jabatans')->insert([
            'nama' => 'BM'
        ]);

        DB::table('jabatans')->insert([
            'nama' => 'GM'
        ]);

        DB::table('jabatans')->insert([
            'nama' => 'Direktur'
        ]);
    }
}
