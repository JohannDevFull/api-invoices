<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices_sales', function (Blueprint $table) {
            $table->id();

            $table->foreignId('provider_id')->references('id')->on('providers');
            $table->foreignId('branch_office_id')->references('id')->on('config_company');

            $table->string('number_invoice');
            
            $table->decimal('value_without_iva', $precision = 13, $scale = 2); 
            $table->decimal('iva', $precision = 13, $scale = 2); 
            $table->decimal('value_pay', $precision = 13, $scale = 2); 

            $table->dateTime('date_invoice');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices_sales');
    }
}
