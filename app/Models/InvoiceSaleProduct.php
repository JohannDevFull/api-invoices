<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceSaleProduct extends Model
{
    use HasFactory;

    protected $table = 'invoices_sales_products';
    
    protected $fillable = [ 
        'invoices_id',
        'products_id',
        'cant', 
        'value_unitary',
        'value_total',
        'iva'
    ];
    
}
