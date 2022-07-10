<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $table = 'accounts';
    public $timesTamps=false;
    protected $fillable = [
        'usename',
        'email',
        'password',
        'role',
        'created_at',
        'updated_at',
    ];
}
