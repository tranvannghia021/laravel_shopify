<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageShopify extends Model
{
    use HasFactory;
    protected $table='image_shopifys';
    public $timesTamps=false;

    protected $fillable=[
        'id_shopify_image',
        'id_product_shopifys',
        'thumb',
        'created_at',
        'updated_at',
    ];
}
