<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;
    protected $table='catgorys';
    public $timesTamps=false;
    protected $fillable=[
        'id_category',
        'name',
        'created_at',
        'updated_at',
    ];
    public function product(){
        return $this->hasMany(Product::class,'category_id');
    }
}
