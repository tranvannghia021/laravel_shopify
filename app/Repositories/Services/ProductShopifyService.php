<?php
namespace App\Repositories\Services;

use Illuminate\Support\Facades\Http;

class ProductShopifyService{
    function getAll($token,$domain){
        $response=Http::withHeaders([
            'X-Shopify-Access-Token'=>$token,
        ])->get('https://'.$domain.'/admin/api/2022-07/products.json?presentment_currencies=USD');
            
        return $response->collect('products')->toArray();
    }
    
    public function create($token,$domain,$author,$request){
        $response=Http::withHeaders([
            'X-Shopify-Access-Token'=>$token,
            'Content-Type'=>'application/json',
        ])->post('https://'.$domain.'/admin/api/2022-07/products.json',[
            'product'=>[
                'title'=>$request->input('title_pr'),
                'body_html'=>$request->input('description'),
                'vendor'=>$author,
                'product_type'=>$request->input('category'),
                'status'=>$request->input('status'),
                'tags'=>[
                    'quan',
                    'ao',
                ]
            ]
        ]);

        $datas=$response->collect()->toArray();
        
       return $datas['product'];
    }
    // delete product from shopify and return to status_code (200=>success)
    public function delete($account,$id_product){
        $response=Http::withHeaders([
            'X-Shopify-Access-Token'=>$account->access_token
        ])->delete('https://'.$account->name.'.myshopify.com/admin/api/2022-07/products/'.$id_product.'.json');
        
    }
    function createVariants($account,$id_product,$title,$price,$quantity){
       
        $response=Http::withHeaders([
            'X-Shopify-Access-Token'=>$account->access_token,
            'Content-Type'=>'application/json'
        ])->post('https://'.$account->domain.'/admin/api/2022-07/products/'.$id_product.'/variants.json',[
            'variant'=>[
                'option1'=>$title,
                'price'=>$price,
                'inventory_management'=>'shopify'
               
            ]
        ]);
        $datas=$response->collect()->toArray();
        $this->updateQuantity($account,$quantity,$datas['variant']['inventory_item_id']);
        
        return $datas['variant']['id'];
    }
    function update($account,$request,$id_product){
        Http::withHeaders([
            'X-Shopify-Access-Token'=>$account->access_token,
            'Content-Type'=>'application/json'
        ])->put('https://'.$account->domain.'/admin/api/2022-07/products/'.$id_product.'.json',[
            'product'=>[
                'id'=>$id_product,
                'title'=>$request->input('title_pr'),
                'body_html'=>$request->input('description'),
                'product_type'=>$request->input('category'),
                'status'=>$request->input('status'),
                
            ]
        ]);
    }
    function updateVarianst($account,$request ,$id_varianst,$i){
        $response=Http::withHeaders([
            'X-Shopify-Access-Token'=>$account->access_token,
            'Content-Type'=>'application/json'
        ])->put('https://'.$account->domain.'/admin/api/2022-07/variants/'.$id_varianst.'.json',[
            'variant'=>[
                'id'=>$id_varianst,
                'option1'=>$request->input('title_' . $i),
                'price'=>$request->input('price_' . $i),
                'inventory_management'=>'shopify'
            ]
        ]);
        $datas=$response->collect()->toArray();
        $this->updateQuantity($account,$request->input('quantity_' . $i),$datas['variant']['inventory_item_id']);
    }
    function updateQuantity($account,$quantity,$id_inventory){
        $response_inventory_location=Http::withHeaders([
            'X-Shopify-Access-Token'=>$account->access_token,
        ])->get('https://'.$account->domain.'/admin/api/2022-07/inventory_levels.json?inventory_item_ids='.$id_inventory.'');
        $response_inventory_location= $response_inventory_location->collect()->toArray();

        Http::withHeaders([
            'X-Shopify-Access-Token'=>$account->access_token,
            'Content-Type'=>'application/json'
        ])->post('https://'.$account->domain.'/admin/api/2022-07/inventory_levels/set.json',[
            'location_id'=>$response_inventory_location['inventory_levels'][0]['location_id'],
            'inventory_item_id'=>$response_inventory_location['inventory_levels'][0]['inventory_item_id'],
            'available'=>$quantity
        ]);
    }
}
?>