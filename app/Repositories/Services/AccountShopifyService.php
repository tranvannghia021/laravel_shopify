<?php
namespace App\Repositories\Services;

use Illuminate\Support\Facades\Http;

class AccountShopifyService{
    // nhận vào tên shop trả ra status
    function isCheckShop($nameShop){
        // kiểm tra shop đã tạo hay chưa
        $response = Http::get('https://' . $nameShop . '.myshopify.com/admin/api/2022-04/shop.json');
        return $response->status();
    }
    // nhận vào đomain và code return về token
    function getAccessToken($domain,$code){
        $response = Http::post('https://' . $domain . '/admin/oauth/access_token', [
            'client_id' => env('API_KEY_SHOPIFY_APP'),
            'client_secret' => env('API_SECRET_KEY_SHOPIFY_APP'),
            'code' => $code
        ]);
        return $response->json('access_token');
    }
    // nhận vào token và domain return về data info with shop
    function getInfoShop($token,$domain){
        return Http::withHeaders([
            'X-Shopify-Access-Token' => $token,
        ])->get('https://' . $domain . '/admin/api/2022-04/shop.json');
    }
}
?>