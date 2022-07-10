<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductShopifydetail extends Model
{
    use HasFactory;
    protected $table='product_shopify_details';
    public $timesTamps=false;

    protected $fillable=[
        'id_shopify_detail',
        'id_products_shopify',
        'id_image_shopify',
        'title',
        'price',
        'quantity',
        'created_at',
        'updated_at',
    ];
}
