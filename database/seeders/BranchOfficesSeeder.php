<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class BranchOfficesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('config_company')->insert([
            'name'      =>  'Drogueria Ramirez',
            'address'   =>  'Calle falsa n 123-27',
            'resolucion_dian' =>  '122342-8',
            
            'phone'     =>  '+0315269712',
            'nit'       =>  '777888111-8'
        ]);
    }
}
