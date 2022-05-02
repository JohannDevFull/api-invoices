<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('clients')->insert([
            'name'      =>  'Client Test',
            'email'     =>  'cl01@test.com',
            'nit'       =>  '77788811'
        ]);

        DB::table('providers')->insert([
            'name'      =>  'Client Test',
            'email'     =>  'cl01@test.com',
            'phone'     =>  '8786443',
            'nit'       =>  '77788811-8'
        ]);
    }
}
