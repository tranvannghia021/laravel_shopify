<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountShopify extends Model
{
    use HasFactory;
    protected $table='account_shopifys';
    public $timesTamps=false;

    protected $fillable=[
        'name',
        'domain',
        'email',
        'shopify_domain',
        'access_token',
        'plan',
        'status',
        'get_data',
        'created_at',
        'updated_at',
    ];
}
