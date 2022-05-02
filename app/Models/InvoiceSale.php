<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceSale extends Model
{
    use HasFactory;

    protected $table = 'invoices_sales';

    protected $fillable = [ 
        'provider_id',
        'branch_office_id',
        'number_invoice', 
        'value_without_iva',
        'iva', 
        'value_pay',
        'date_invoice'
    ];

}
