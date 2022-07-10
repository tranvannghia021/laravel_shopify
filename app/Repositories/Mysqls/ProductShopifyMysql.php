<?php

namespace App\Repositories\Mysqls;

use App\Models\AccountShopify;
use App\Models\ImageShopify;
use App\Models\Product;
use App\Models\ProductShopify;
use App\Models\ProductShopifydetail;
use App\Repositories\Services\ImageShopifyService;
use App\Repositories\Services\ProductShopifyService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductShopifyMysql
{
  function getAll($author)
  {
    return ProductShopify::orderBy('id', 'DESC')->where('vendor','=',$author)
      ->cursorPaginate(5);
  }
  function getId($id)
  {
    return ProductShopify::where('id', $id)->first();
  }
  function getIdShopify($id)
  {
    return ProductShopify::where('id_shopify', $id)->first();
  }
 
  // lưu data từ webhook 
  function createWebhook($datas)
  {
    try {
      DB::beginTransaction();

      $products = ProductShopify::create([
        'id_shopify' => (int)$datas['id'],
        'name_category' => (string)$datas['product_type'],
        'title' => (string)$datas['title'],
        'body_html' => (string) $datas['body_html'],
        'vendor' => (string) $datas['vendor'],
        'status' => (string) $datas['status']
      ]);

      foreach ($datas['images'] as $img) {
        $images = ImageShopify::create([
          'id_shopify_image' => $img['id'],
          'id_product_shopifys' => $products->id,
          'thumb' => $img['src'],
        ]);

        foreach ($datas['variants'] as $varian) {
          ProductShopifydetail::create([
            'id_shopify_detail' => $varian['id'],
            'id_products_shopify' => $products->id,
            'id_image_shopify' => $images->id,
            'title' => $varian['title'],
            'price' => $varian['price'],
            'quantity' => $varian['inventory_quantity'],
          ]);
        }
      }


      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      return false;
    }
    return true;
  }


  // đồng bộ data của shop
  function saveDbAllFromWebHook($datas, $id)
  {
    try {
      DB::beginTransaction();
      foreach ($datas as $data) {
        $products = ProductShopify::create([
          'id_shopify' => (int)$data['id'],
          'name_category' => (string)$data['product_type'],
          'title' => (string)$data['title'],
          'body_html' => (string) $data['body_html'],
          'vendor' => (string) $data['vendor'],
          'status' => (string) $data['status']
        ]);
      
        foreach ($data['images'] as $img) {

          $images = ImageShopify::create([
            'id_shopify_image' => (int)$img['id'],
            'id_product_shopifys' => (int) $products->id,
            'thumb' => (string) $img['src'],
          ]);
       
          foreach ($data['variants'] as $varian) {

            ProductShopifydetail::create([
              'id_shopify_detail' => (int)$varian['id'],
              'id_products_shopify' => (int) $products->id,
              'id_image_shopify' => (int)$images->id,
              'title' => (string) $varian['title'],
              'price' => (int)$varian['price'],
              'quantity' => (int) $varian['inventory_quantity'],
            ]);
          }
        }
      }
      // cập nhập shop
      AccountShopify::where('id', $id)->update([
        'get_data' => 'yes',
      ]);
      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      return false;
    }
    return true;
  }

  //  update từ webhook
  function updateWebhook($datas)
  {
    try {
      DB::beginTransaction();
      $products = ProductShopify::where('id_shopify', $datas['id'])->first();
      ProductShopify::where('id_shopify', $datas['id'])->update([
        'name_category' => (string)$datas['product_type'],
        'title' => (string)$datas['title'],
        'body_html' => (string)$datas['body_html'],
        'vendor' => (string)$datas['vendor'],
        'status' => (string) $datas['status'],
      ]);
      ProductShopifydetail::where('id_products_shopify', $products->id)->delete();
      ImageShopify::where('id_product_shopifys', $products->id)->delete();
      if (!is_null($datas['images'])) {
        $array_id_img=[];
        foreach ($datas['images'] as $img) {

          $images = ImageShopify::updateOrCreate(
            ['id_shopify_image' => (int)$img['id']],
            [
              'id_product_shopifys' => (int) $products->id,
              'thumb' => $img['src'],
            ]
          );
          $array_id_img[]=$images->id;
        }
        foreach ($datas['variants'] as $key=> $data) {
         
          ProductShopifydetail::updateOrCreate(
            ['id_shopify_detail' => (int) $data['id']],
            [
              'id_products_shopify' => $products->id,
              'id_image_shopify' => $array_id_img[$key],
              'title' => $data['title'],
              'price' => $data['price'],
              'quantity' => $data['inventory_quantity'],
            ]
          );
        }

      } 

      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      return false;
    }
    return true;
  }


  // xóa từ webhook
  function deleteWebhook($datas)
  {
    try {
      DB::beginTransaction();
      $products = ProductShopify::where('id_shopify', $datas['id'])->first();
      if ($products) {
        $products->delete();
        ProductShopifydetail::where('id_products_shopify', $products->id)->delete();
        ImageShopify::where('id_product_shopifys', $products->id)->delete();
      }else{
        $products_detail=ProductShopifydetail::where('id_shopify_detail',$datas['id'])->first();
        if($products_detail){
          $products_detail->delete();
        }

      }
      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      return false;
    }
    return true;
  }


  // thêm data từ form
  function insertDB($request, $data_products)
  {
    $id = session()->get('merchan_id');
    $accont = AccountShopify::where('id', $id)->first();

    try {
      DB::beginTransaction();
      $id_products = ProductShopify::create([
        'id_shopify' => (int)$data_products['id'],
        'name_category' => (string) $request->input('category'),
        'title' => (string)$request->input('title_pr'),
        'body_html' => (string) $request->input('description'),
        'vendor' => (string) $accont->name,
        'status' => (string) $request->input('status'),
      ]);
      for ($i = 0; $i < $request->input('total'); $i++) {
        $name_images=$request->file('images_' . $i . '')->getClientOriginalName();
       
        $base64_images=base64_encode(file_get_contents($request->file('images_' . $i . '')->path()));
        
        $id_image_shopify = (new ImageShopifyService)->create($accont, $data_products['id'], $base64_images, $name_images);
        $id_image = ImageShopify::create([
          'id_shopify_image'=>$id_image_shopify,
          'id_product_shopifys' => $id_products->id,
          'thumb' => $name_images
        ]);
  
        $id_varian_shopify = (new ProductShopifyService)->createVariants(
          $accont,
          
          $data_products['id'],
          $request->input('title_' . $i),
          $request->input('price_' . $i),
          $request->input('quantity_' . $i)
        );
        (new ImageShopifyService)->updateVarian($accont,$data_products['id'],$id_image_shopify,$id_varian_shopify);
        ProductShopifydetail::create([
          'id_shopify_detail' => $id_varian_shopify,
          'id_products_shopify' => $id_products->id,
          'id_image_shopify' => $id_image->id,
          'title' => $request->input('title_' . $i),
          'price' => $request->input('price_' . $i),
          'quantity' => $request->input('quantity_' . $i)
        ]);
        $request->file('images_' . $i . '')->storeAs('public/shopify', $request->file('images_' . $i . '')->getClientOriginalName());
      }
      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      return false;
    }
    return true;
  }




  // update từ form
  function updateDB($request, $id)
  {
    try {
      DB::beginTransaction();
      ProductShopify::where('id', $id)->update([
        'name_category' => (string) $request->input('category'),
        'title' => (string)$request->input('title_pr'),
        'body_html' => (string) $request->input('description'),
        'status' => (string) $request->input('status'),
      ]);
      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      return false;
    }
    return true;
  }



  // xóa từ form
  function deleteDB($id)
  {
    try {
      DB::beginTransaction();
      ProductShopify::where('id', $id)->delete();
      ProductShopifydetail::where('id_products_shopify', $id)->delete();
      ImageShopify::where('id_product_shopifys', $id)->delete();
      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      return false;
    }
    return true;
  }
}
