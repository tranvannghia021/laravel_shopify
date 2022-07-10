<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;

class Helper
{


    public static function category($datas)
    {
        $html = '';
        $datas = array_reverse($datas);
        foreach ($datas as $key => $item) {
            $html .= '<tr>
            <td>' . ++$key . '</td>
            <td>' . $item->name . '</td>
            <td>' . date("d-m-Y", strtotime($item->created_at)) . '</td>

            <td style="">
                <a href="' . route("categorys.edit", ["id" => $item->id]) . '">
                    <button  type="button" class="btn btn-info btn-circle btn-lg"><i class="fas fa-edit"></i></button>
                </a>
                <a href="' . route("categorys.delete", ["id" => $item->id]) . '" >
                    <button class="btn btn-danger btn-circle btn-lg"><i class="fas fa-trash"></i></button>
                </a>
              
            </td>
          </tr>';
        }
        return $html;
    }
    public static function listPost($datas)
    {
        $html = '';
        foreach ($datas as $key => $item) {
            $html .= '<div class="father">
                        <div class="father__thumb">
                            <img src="' . $item->img . '" class="father__img" alt="">
                        </div>
                        <div class="father__content">
                            <div class="father__title">
                                <a href="#"><h3>' . $item->title . '</h3></a>
                            </div>
                            <div class="father__body">
                                <a href="#"><p>' . $item->description . '</p></a>
                            </div>
                        </div>
                        <div class="icon_btn">
                          <a href="' . route("crawls.edit", ["id" => $item->id]) . '"><button type="button" class="btn btn-info">Sửa</button></a>
                          <form id="form-delete"method="delete">
                          <input type="hidden" name="_token" value="' . csrf_token() . '" />
                          <input type="hidden" name="idDelete" value="' . $item->id . '" />
                          <button onclick="toggleClickRemove(\'/admin/crawls/destroy\')" type="button" class="btn btn-danger">Xóa</button></form>
                          <div class="status_post">Trạng thái: <p>' . $item->status . '</p></div>
                        </div>
                    </div>';
        }
        return $html;
    }
    public static function listPostClient($datas)
    {
        $html = '';
        foreach ($datas as $key => $item) {
            $html .= '<div class="father">
                        <div class="father__thumb">
                            <img src="' . $item->img . '" class="father__img" alt="">
                        </div>
                        <div class="father__content">
                            <div class="father__title">
                                <a href="' . route('posts.show', ['id' => $item->id]) . '"><h3>' . $item->title . '</h3></a>
                            </div>
                            <div class="father__body">
                                <a href="' . route('posts.show', ['id' => $item->id]) . '"><p>' . $item->description . '</p></a>
                            </div>
                        </div>
                        
                    </div>';
        }
        return $html;
    }
    public static function postDetail($datas)
    {


        $html = '<div class="text-center font-weight-bold">
                        <h1>' . $datas->title . '</h1>
                    </div>
                    <h4>' . $datas->description . '</h4>
                    <p>' . $datas->description_sub . '</p>';

        return $html;
    }
    public static function listProductShopify($datas)
    {

        $html = '';
        foreach ($datas as $key => $item) {
            $html .= ' <tr class="col">
            <td class="sorting_1 dtr-control">' . ++$key . '</td>
                <td style=""><a href="' . route('shopify.product.edit', ['id' => $item->id]) . '">' . $item->title . '</a></td>
                <td style="">' . $item->status . '</td>
                <td style="">' . \App\Repositories\Mysqls\ProductShopifyDetailMysql::sumQuantity($item->id) . '</td>
                <td style="">' . $item->name_category . '</td>
                <td style="">' . $item->vendor . '</td>
                <td>
                <form action="' . route('shopify.product.delete') . '" method="POST" >
                <input type="hidden" name="_token" value="'.csrf_token().'" />
                 <input type="hidden" name="id" value="' . $item->id . '">
                 <button type="submit" class="btn btn-danger">delete</button></form>
     
            </td>
                
        </tr>';
        }
        return $html;
    }
    public static function showVarianEdit($datas)
    {
        $html = '';
        $product_details = \App\Repositories\Mysqls\ProductShopifyDetailMysql::getId($datas->id);
        $number = count($product_details);
        foreach ($product_details as $key => $item) {
            $thumb = \App\Repositories\Mysqls\ImageShopifyMysql::getThumbByid($item->id_image_shopify);
            $pos = strpos($thumb->thumb, 'https');
            if($pos !== false){
                $img= $thumb->thumb;
            }else{
                $img=asset('storage/shopify/' . $thumb->thumb);
            }
            $html .= '<div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Variants ' . ++$key . ' </h3>
               
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col col-sm-6">
                        <div class="form-group">
                            <label for="title_sub">Tên loại </label>
                            <input type="text" class="form-control" id="title_sub" value="' . $item->title . '" name="title_' . --$key . '" placeholder="Tên loại">
                            <input type="hidden" class="form-control" id="title_sub" name="total" value="' . $number . '" placeholder="Tên loại">
                            <input type="hidden" class="form-control" id="title_sub" name="id_images_' . $key . '" value="' . $item->id_image_shopify . '" placeholder="Tên loại">
                            <input type="hidden" class="form-control" id="title_sub" name="id_products_detail_' . $key . '" value="' . $item->id . '" placeholder="Tên loại">
                        </div>
                    </div>
                    <div class="col col-sm-3">
                        <div class="form-group">
                            <label for="price">Giá</label>
                            <input type="text" class="form-control"  value="' . $item->price . '" id="price" name="price_' . $key . '" placeholder="Giá">
                        </div>
                    </div>
                    <div class="col col-sm-3">
                        <div class="form-group">
                            <label for="quantity">Số lượng</label>
                            <input type="text" class="form-control"  value="' . $item->quantity . '" id="quantity" name="quantity_' . $key . '" placeholder="Số lượng">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="images_' . $key . '">Hình ảnh</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="images_' . $key . '" id="images_' . $key . '">
                            <label class="custom-file-label" for="images_' . $key . '">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
            <a href="' . $img . '" target="_blank" >
            <img  src="' . $img . '" width=120 />
            </a>
            </div>
    
            </div>
        </div>';
        }
        return $html;
    }
}
