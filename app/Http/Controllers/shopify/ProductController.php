<?php

namespace App\Http\Controllers\shopify;

use App\Http\Controllers\Controller;
use App\Repositories\Mysqls\AccountShopifyMysql;
use App\Repositories\Mysqls\ImageShopifyMysql;
use App\Repositories\Mysqls\ProductShopifyDetailMysql;
use App\Repositories\Mysqls\ProductShopifyMysql;
use App\Repositories\Services\ProductShopifyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    protected $product_shopify;
    protected $image_shopify;
    protected $product_shopify_detail;
    protected $product_shopify_service;
    protected $account_shopify;


    public function __construct(
        ProductShopifyMysql $product_shopify,
        ImageShopifyMysql $image_shopify,
        ProductShopifyDetailMysql $product_shopify_detail,
        ProductShopifyService $product_shopify_service,
        AccountShopifyMysql $account_shopify

    ) {
        $this->product_shopify = $product_shopify;
        $this->image_shopify = $image_shopify;
        $this->product_shopify_detail = $product_shopify_detail;
        $this->account_shopify = $account_shopify;
        $this->product_shopify_service = $product_shopify_service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Session::get('merchan_id');
        $accounts = $this->account_shopify->findById($id);
        $products = $this->product_shopify->getAll($accounts->name);

        return view('admin.product-shopify.list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product-shopify.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        for ($i = 0; $i < $request->input('total'); $i++) {
            $result = $this->isCheckFile($request, 'images_' . $i . '');
            if (!$result) {
                return back()->with([
                    'class' => 'message-error',
                    'message' => 'Vui lòng kiểm tra lại files '
                ]);
            }
        }
        $id = Session::get('merchan_id');
        $accounts = $this->account_shopify->findById($id);
        // lưu lên api shopify
        $data_product = $this->product_shopify_service->create($accounts->access_token, $accounts->domain, $accounts->vendor, $request);

        // lưu vào db

        $result_product = $this->product_shopify->insertDB($request, $data_product);
        if ($result_product) {
            return redirect(route('shopify.product.list'))->with([
                'class' => 'message-success',
                'message' => 'Thêm thành công!'
            ]);
        } else {
            return back()->with([
                'class' => 'message-error',
                'message' => 'Thêm thất bại!'
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
        $products = $this->product_shopify->getId($id);
        return view('admin.product-shopify.edit', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $accounts = $this->account_shopify->findById(Session::get('merchan_id'));
        $products = $this->product_shopify->getId($id);
        // cập nhập sản phẩm api
        $this->product_shopify_service->update($accounts, $request, $products->id_shopify);
        for ($i = 0; $i < $request->input('total'); $i++) {


            if ($request->hasFile('images_' . $i)) {
                $result = $this->isCheckFile($request, 'images_' . $i . '');
                if (!$result) {
                    return back()->with([
                        'class' => 'message-error',
                        'message' => 'Vui lòng kiểm tra lại files '
                    ]);
                }
                $nameImages = $request->file('images_' . $i . '')->getClientOriginalName();

                // cập nhập ảnh va api
                $base64_images = base64_encode(file_get_contents($request->file('images_' . $i . '')->path()));
                $result_images = $this->image_shopify->updateDB($accounts, $nameImages, $request->input('id_images_' . $i), $products->id_shopify, $base64_images);


                if (!$result_images) {
                    return back()->with([
                        'class' => 'message-error',
                        'message' => 'Có lỗi,Đã có lỗi xảy ra chỗ hình ảnh! '
                    ]);
                }
                $request->file('images_' . $i . '')->storeAs('public/shopify', $request->file('images_' . $i . '')->getClientOriginalName());
            }

            $productShopifyDetail = $this->product_shopify_detail->findByid($request->input('id_products_detail_' . $i));
            // update api
            $this->product_shopify_service->updateVarianst($accounts, $request, $productShopifyDetail->id_shopify_detail, $i);
            $result_detail = $this->product_shopify_detail->updateDB($request, $request->input('id_products_detail_' . $i), $i);
            if (!$result_detail) {
                return back()->with([
                    'class' => 'message-error',
                    'message' => 'Có lỗi,Đã có lỗi xảy ra chỗ varian! '
                ]);
            }
        }
        // cập nhập products
        $result_product = $this->product_shopify->updateDB($request, $id);

        if (!$result_product) {
            return back()->with([
                'class' => 'message-error',
                'message' => 'Cập nhập không thành công! '
            ]);
        } else {
            return redirect()->route('shopify.product.list')->with([
                'class' => 'message-success',
                'message' => 'Cập nhập thành công! '
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $isCheck = $this->product_shopify->getId($request->input('id'));
        $products = $this->product_shopify->getId($request->input('id'));
        $id = Session::get('merchan_id');
        $accounts = $this->account_shopify->findById($id);
        if (!is_null($isCheck)) {
            $result = $this->product_shopify->deleteDB($request->input('id'));
            // xoas api
            $this->product_shopify_service->delete($accounts, $products->id_shopify);
            // del api even
            if ($result) {
                return redirect()->route('shopify.product.list')->with([
                    'message' => 'Xóa thành công',
                    'class' => 'message-success'
                ]);
            }
        }
        return redirect()->route('shopify.product.list')->with([
            'message' => 'Xóa không thành công',
            'class' => 'message-error'
        ]);
    }
    public function isCheckFile($request, $namefile)
    {

        $file_extension = ['png', 'jpg', 'jpeg', 'gif'];
        if ($request->hasFile($namefile)) {
            foreach ($request->file($namefile) as $file_item) {
                $ext = $file_item->getClientOriginalExtension();
                if (!in_array($ext, $file_extension)) {
                    return false;
                }
                $size = $file_item->getSize();
                if ($size > 5000000) {
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    }
}
