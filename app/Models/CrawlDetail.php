<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrawlDetail extends Model
{
    use HasFactory;
    protected $table = 'crawls_detail';
    public $timesTamps=false;
    protected $fillable = [
        'crawl_id',
        'title',
        'description',
        'description_sub',
        'created_at',
        'updated_at',
    ];
}
