<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model
{
    use HasFactory;

    protected $table = 'invoices_products';
    
    protected $fillable = [ 
        'invoices_id',
        'products_id',
        'cant', 
        'value_unitary',
        'value_total'
    ];

    protected $casts = [ 
        'created_at'    =>'datetime:Y-m-d H:i:s',
        'updated_at'    =>'datetime:Y-m-d H:i:s'
    ];
}
