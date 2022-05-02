<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $list_products='[
            {
                "name":"Acetaminofen 400mg",
                "description":"",
                "value_unitary":400.00,
                "units":40
            },
            {
                "name":"Ibuprofeno 400mg",
                "description":"",
                "value_unitary":400.00,
                "units":100
            },
            {
                "name":"Test uno",
                "description":"",
                "value_unitary":4500.00,
                "units":100
            },
            {
                "name":"Test dos",
                "description":"",
                "value_unitary":3100.00,
                "units":100
            }
        ]';

        $products=json_decode($list_products);

        foreach ($products as $key ) 
        {
            // code...
            DB::table('products')->insert([
                'name'          =>  $key->name,
                'description'   =>  $key->description,
                'value_unitary' =>  $key->value_unitary,
                'units'         =>  $key->units
            ]);
        }

    }
}
