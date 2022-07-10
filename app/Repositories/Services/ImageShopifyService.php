<?php

namespace App\Repositories\Services;

use Illuminate\Support\Facades\Http;


class ImageShopifyService
{
    function create($account, $id_products, $base64_images, $name_images)
    {
        $response = Http::withHeaders([
            'X-Shopify-Access-Token' => $account->access_token,
            'Content-Type' => 'application/json'
        ])->post('https://' . $account->domain . '/admin/api/2022-07/products/' . $id_products . '/images.json', [
            'image' => [
                'variant_ids'=>[],
                'attachment' => $base64_images,
                'filename' => $name_images
            ]
        ]);
        $datas = $response->collect()->toArray();
        
        return $datas['image']['id'];
    }
    function update($account, $id_images, $id_products, $base64_images, $name_images)
    {
        $status_code=$this->delete($account,$id_products,$id_images);
        if($status_code == 200){
            $response=$this->create($account, $id_products, $base64_images, $name_images);
            
            return $response;
          
        }
    }
    function delete($account,$id_products,$id_images){
        $response=Http::withHeaders([
            'X-Shopify-Access-Token' => $account->access_token,
        ])->delete('https://'.$account->domain.'/admin/api/2022-07/products/'.$id_products.'/images//'.$id_images.'.json');
            return $response->status();
    }
    function updateVarian($account,$id_products,$id_images,$id_varian){
        $array_id_varian=[$id_varian];
        Http::withHeaders([
            'X-Shopify-Access-Token' => $account->access_token,
            'Content-Type'=>'application/json'
        ])->put('https://'.$account->domain.'/admin/api/2022-07/products/'.$id_products.'/images//'.$id_images.'.json',[
            'image'=>[
                'id'=>$id_images,
                'variant_ids'=>$array_id_varian
            ]
        ]);
    }
}
