<?php
namespace App\Repositories\Mysqls;

use App\Models\CategoryShopify;


class CategoryShopifyMysql{
  function getAll(){
    return CategoryShopify::all();
  }
  function getName($id){
    return CategoryShopify::where('id',$id)->first();
  }   
}
?>