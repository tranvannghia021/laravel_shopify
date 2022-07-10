<?php
namespace App\Repositories\Mysqls;

use App\Models\AccountShopify;
use App\Models\ImageShopify;
use App\Models\ProductShopifydetail;
use App\Repositories\Services\ImageShopifyService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ImageShopifyMysql{
   function getThumbByid($id){
    return ImageShopify::where('id',$id)->first();
   }
   function updateDB($account,$nameImages,$id,$id_product_shopify,$base64_img){
    try {
        DB::beginTransaction();
        $images=ImageShopify::where('id',$id)->first();
        
        
        $id_img=(new ImageShopifyService)->update($account,$images->id_shopify_image,$id_product_shopify,$base64_img,$nameImages);

        if($images){
            $images->update([
                'id_shopify_image'=>$id_img,
                'thumb'=>$nameImages
            ]);
        }
        
        if(file_exists('storage/shopify/'.$images->thumb)){
            unlink('storage/shopify/'.$images->thumb);
        }
        DB::commit();
    } catch (\Exception $e) {
        DB::rollBack();
        return false;
    }
    return true;
   }
}
?>