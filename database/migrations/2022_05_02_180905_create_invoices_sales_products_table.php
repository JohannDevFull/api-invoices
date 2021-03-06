<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesSalesProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices_sales_products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('invoices_id')->references('id')->on('invoices_sales');
            $table->foreignId('products_id')->references('id')->on('products');
            $table->integer('cant');
            $table->integer('value_unitary');
            $table->integer('iva')->default(19);
            $table->integer('value_total');

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
        Schema::dropIfExists('invoices_sales_products');
    }
}
