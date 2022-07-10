<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Image;

class Product extends Model
{
    use HasFactory;
    protected $table='products';
    public $timesTamps=false;

    protected $fillable=[
        'title',
        'price',
        'category_id',
        'quantity',
        'description',
        'status',
        'created_at',
        'updated_at',
    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function image(){
        return $this->hasMany(Image::class,'product_id');
    }
}
