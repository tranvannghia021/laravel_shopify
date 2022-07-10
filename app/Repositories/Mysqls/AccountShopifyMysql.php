<?php

namespace App\Repositories\Mysqls;

use App\Models\AccountShopify;

use Illuminate\Support\Facades\DB;

class AccountShopifyMysql
{
    function create($request,$token)
    {
        
        try {
            DB::beginTransaction();
           $result= AccountShopify::create(
                [
                    'name' => $request['name'],
                    'domain'=>$request['domain'],
                    'email'=>$request['email'],
                    'shopify_domain'=>$request['myshopify_domain'],
                    'access_token'=>$token,
                    'plan'=>$request['plan_name'],
                    'created_at'=>date('Y-m-d H:i:s')
                ]
            );
            DB::commit();
            $id=$result->id;
        } catch (\Exception $e) {
            DB::rollBack();
            return -1;
        }
        return $id ;
    }
    // search name
    function findByName($name){
        return AccountShopify::where('name',$name)->first();
    }
    // search id
    function findById($id){
        return AccountShopify::where('id',$id)->first();
    }
    // search domain
    function findByShop($shop){
        return AccountShopify::where('domain',$shop)->first();
    }
}
