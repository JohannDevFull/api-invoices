<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    
    protected $fillable = [ 
        'client_id',
        'branch_office_id',
        'consecutive_invoice', 
        'value_without_iva',
        'iva', 
        'value_pay',
        'date_invoice'
    ];

    protected $casts = [
        'created_at'    =>'datetime:Y-m-d H:i:s',
        'updated_at'    =>'datetime:Y-m-d H:i:s'
    ];
}
