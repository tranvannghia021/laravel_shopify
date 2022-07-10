<?php
namespace App\Repositories\Services;

use Illuminate\Support\Facades\Http;

class WebhookService{
    // tạo quyền webhook
    public function create($domain, $token, $arrayCreate,$arrayUpdate,$arrayDelete)
    {
        foreach($arrayCreate as $topic){

            Http::withHeaders([
               'X-Shopify-Access-Token' => $token,
               'Content-Type' => 'application/json'
           ])->post('https://' . $domain . '/admin/api/2022-07/webhooks.json', [
               'webhook' => [
                   'topic' => $topic,
                   'address' => ''.env('DOMAIN_NGORK').'/api/webhook/create',
                   'format' => 'json'
   
               ]
           ]);
        }
        foreach($arrayUpdate as $topic){
            Http::withHeaders([
                'X-Shopify-Access-Token' => $token,
                'Content-Type' => 'application/json'
            ])->post('https://' . $domain . '/admin/api/2022-07/webhooks.json', [
                'webhook' => [
                    'topic' => $topic,
                    'address' => ''.env('DOMAIN_NGORK').'/api/webhook/update',
                    'format' => 'json'
    
                ]
            ]);
        }
        foreach($arrayDelete as $topic){
            Http::withHeaders([
                'X-Shopify-Access-Token' => $token,
                'Content-Type' => 'application/json'
            ])->post('https://' . $domain . '/admin/api/2022-07/webhooks.json', [
                'webhook' => [
                    'topic' => $topic,
                    'address' => ''.env('DOMAIN_NGORK').'/api/webhook/delete',
                    'format' => 'json'
    
                ]
            ]);
        }
    }
    
    // đếm có bao nhiêu quyền
    public function countRole($token,$domain)
    {
        $response = Http::withHeaders([
            'X-Shopify-Access-Token' => $token,
        ])->get('https://'.$domain.'/admin/api/2022-07/webhooks/count.json');
        return $response->json('count');
    }
}
?>