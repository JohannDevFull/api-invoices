<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('client_id')->references('id')->on('clients');
            $table->foreignId('branch_office_id')->references('id')->on('invoices');

            $table->string('consecutive_invoice');
            
            $table->decimal('value_without_iva', $precision = 13, $scale = 2); 
            $table->decimal('iva', $precision = 13, $scale = 2); 
            $table->decimal('value_pay', $precision = 13, $scale = 2); 

            $table->dateTime('date_invoice');
            //$table->date('date_invoice');
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
        Schema::dropIfExists('invoices');
    }
}
