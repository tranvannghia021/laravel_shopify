<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crawl extends Model
{
    use HasFactory;
    protected $table = 'crawls';
    
    protected $fillable = [
        'title',
        'description',
        'thumb',
        'img',
        'status',
        'created_at',
        'updated_at',
    ];
}
