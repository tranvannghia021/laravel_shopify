<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Repositories\Mysqls\AccountShopifyMysql;
use App\Repositories\Mysqls\CategoryMysql;
use App\Repositories\Mysqls\ImageMysql;
use App\Repositories\Mysqls\ProductMysql;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    protected $productsMysql;
    protected $categorysMysql;
    protected $imagesMysql;
    protected $shopifyMysql;
    public function __construct(ProductMysql $productsMysql,
                                CategoryMysql $categorysMysql,
                                ImageMysql  $imagesMysql ,
                                AccountShopifyMysql $shopifyMysql  ){
        $this->productsMysql=$productsMysql;
        $this->categorysMysql=$categorysMysql;
        $this->imagesMysql=$imagesMysql;
        $this->shopifyMysql=$shopifyMysql;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products=$this->productsMysql->getAll($request);
        $status_sum=$this->productsMysql->status_sum();
        return view('admin.products.list',compact('products','status_sum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $result=$this->categorysMysql->getAll();    
       $categorys=$this->categorysMysql->cate_tree($result);
        return view('admin.products.add',compact('categorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
           $isFiles=$this->isCheckFile($request);
           if($isFiles){
                $result=$this->productsMysql->create($request);
                if($result){
                    return redirect()->route('products.list')->with([
                                    'message'=>'Thêm thành công',
                                    'class'=>'message-success'
                                    ]);
                }else{
                    return back()->with([
                        'message'=>'Có lỗi,Thêm không thành công',
                        'class'=>'message-error'
                    ]);
                }
           }else{
                    return back()->with([
                    'message'=>'Có lỗi,Thêm không thành công',
                    'class'=>'message-error'
                ]);
           }
                 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products=$this->productsMysql->getShow($id);
        $images=$this->imagesMysql->getId($id);
        return view('admin.products.show',compact('products','images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products=$this->productsMysql->getId($id);
        $images=$this->imagesMysql->getId($id);
        $result=$this->categorysMysql->getAll();    
       $categorys=$this->categorysMysql->cate_tree($result);
       
        return view('admin.products.edit',compact('categorys','products','images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd(count($request->file('images')));
        
        if($request->hasFile('images')){
            $isFiles=$this->isCheckFile($request);
            if($isFiles){
                $result=$this->productsMysql->update($request,$id);
            }else{
                return back()->with([
                    'message'=>'Có lỗi,Cập nhập không thành công',
                    'class'=>'message-error'
                ]);
            }
        }else{
            $result=$this->productsMysql->update($request,$id);
           
        }
        if(!$result){
            return back()->with([
                'message'=>'Có lỗi,Cập nhập không thành công',
                'class'=>'message-error'
            ]);
        }
        return redirect()->route('products.list')->with([
            'message'=>'Cập nhập thành công',
            'class'=>'message-success'
    ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   $isCheck=$this->productsMysql->getId($id);
        if(!is_null($isCheck)){
            $result=$this->productsMysql->delete($id);
            
            if($result){
                return redirect()->route('products.list')->with([
                    'message'=>'Xóa thành công',
                    'class'=>'message-success'
                ]);
            }
        }
        return redirect()->route('products.list')->with([
            'message'=>'Xóa không thành công',
            'class'=>'message-error'
         ]);

    }
    // nhận vào 1 tham só và trả về kiểu bool
    // tham số chưa $files
    public function isCheckFile($request){
        
        $file_extension=['png','jpg','jpeg','gif'];
        if($request->hasFile('images'))
        {
           foreach( $request->file('images') as $file_item){ 
                $ext=$file_item->getClientOriginalExtension();
                if(!in_array($ext,$file_extension)){
                    return false;
                }
                $size=$file_item->getSize();
                    if($size > 5000000){
                        return false;
                    }
              }
             return true;
        }else{
            return false;
        }
    }
    
  
}
