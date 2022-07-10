<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductShopify extends Model
{
    use HasFactory;
    protected $table='product_shopifys';
    
    protected $fillable=[
        'id_shopify',
        'name_category',
        'title',
        'body_html',
        'vendor',
        'status',
        
    ];
}
