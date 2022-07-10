<?php

namespace App\Repositories\Mysqls;

use App\Models\ProductShopifydetail;
use Illuminate\Support\Facades\DB;

class ProductShopifyDetailMysql
{
    function sumQuantity($id)
    {
        return ProductShopifydetail::where('id_products_shopify', $id)->sum('quantity');
    }
    function getId($id)
    {
        return ProductShopifydetail::where('id_products_shopify', $id)->get();
    }
    function updateDB($request, $id,$i)
    {
        try {
            DB::beginTransaction();
            ProductShopifydetail::where('id', $id)->update([
                'title' => $request->input('title_' . $i),
                'price' => $request->input('price_' . $i),
                'quantity' => $request->input('quantity_' . $i)
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
        return true;
    }
    function findByid($id){
        return ProductShopifydetail::where('id',$id)->first();
    }
}
