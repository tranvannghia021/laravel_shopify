<?php

namespace App\Http\Controllers\shopify;

use App\Http\Controllers\Controller;
use App\Repositories\Mysqls\AccountShopifyMysql;
use App\Repositories\Mysqls\ProductShopifyMysql;
use App\Repositories\Services\AccountShopifyService;

use App\Repositories\Services\ProductShopifyService;
use App\Repositories\Services\WebhookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    protected $shopifyMysql;
    protected $productShopify;
    protected $accountShopifyService;
    protected $webhookService;
    protected $productShopifyService;
    public function __construct(AccountShopifyMysql $shopifyMysql,
                                ProductShopifyMysql $productShopify,
                                AccountShopifyService $accountShopifyService,
                                WebhookService $webhookService ,
                                ProductShopifyService $productShopifyService)
    {
        $this->shopifyMysql = $shopifyMysql;
        $this->productShopify = $productShopify;
        $this->accountShopifyService = $accountShopifyService;
        $this->webhookService = $webhookService;
        $this->productShopifyService = $productShopifyService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Session::get('merchan_id')) {
            return redirect()->route('admin.dashboard');
        }

        return view('client.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->input('domain');
        $domain = $name . '.myshopify.com';
        $scope='write_products,read_products,read_orders,write_orders,read_inventory,write_inventory,read_locations,write_locales';
        // kiểm tra shop đã tạo hay chưa
       $response= $this->accountShopifyService->isCheckShop($name);
        // thông báo khi không có
        if ($response == 404) {
            return back()->with([
                'class' => 'message-error',
                'message' => 'Shops không tồn tại!'
            ]);
        } else {
            // xin hmac và code 
            return redirect('https://' . $name . '.myshopify.com/admin/oauth/authorize?client_id=a2c26dfe2e1f069d05ff6fa0ccc8987b&scope='.$scope.'&redirect_uri='.env('DOMAIN_NGORK').'/shopify/install/res');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getData(Request $request)
    {
    
        // array các quyền webhook
        $topicCreate = ['products/create','inventory_items/create','locations/create'];
        $topicUpdate = ['products/update','inventory_items/update','locations/update'];
        $topicDelete=['products/delete','inventory_items/delete','locations/delete'];
        // code ,hmac trả về
        $isCheckHmac=$this->verifyHmacAuthen($request);
        if($isCheckHmac){

            $code = $request->input('code');
            $shop = $request->input('shop');
            $isChechLogin = $this->shopifyMysql->findByShop($shop);
            if (!is_null($isChechLogin)) {
                $request->session()->flush();
                $request->session()->put("merchan_id", $isChechLogin->id);
                $this->getProductShop($isChechLogin->id);
                return redirect()->route('admin.dashboard');
            } else {
                /// xin access_token
                $token=$this->accountShopifyService->getAccessToken($shop,$code);
                // xin thông tin shop
                $responseShop =$this->accountShopifyService->getInfoShop($token,$shop);
                // lưu db
                $result = $this->shopifyMysql->create($responseShop->json('shop'), $token);
               
    
                if ($result == -1) {
                    return redirect()->route('shopify.index')->with('message', 'Có lỗi,Vui lòng thử lại');
                } else {
                    //xin quyền webhook
                    $numberRole=$this->webhookService->countRole($token,$shop);
    
                    if ($numberRole == 0) {
                        $this->webhookService->create($shop,$token,$topicCreate,$topicUpdate,$topicDelete);
                    }
                    $this->getProductShop($result);
                    $request->session()->flush();
                    $request->session()->put("merchan_id", $result);
    
                    return redirect()->route('admin.dashboard');
                }
            }
        }else{
            return  redirect()->route('shopify.index')->with('message', 'Có lỗi,Vui lòng thử lại');
        }
    }
    
    public function getProductShop($id){
        
            $shopifys=$this->shopifyMysql->findById($id);
         
            if($shopifys->get_data == 'no'){
               $datas= $this->productShopifyService->getAll($shopifys->access_token,$shopifys->domain);
               
              $this->productShopify->saveDbAllFromWebHook($datas,$id);
            }
        
    }
    public function verifyHmacAuthen($request){
        $queryString = http_build_query(array(
                    'code' => $request->input('code'),
                    'host' => $request->input('host'),
                    'shop' => $request->input('shop'),
                    'timestamp' => $request->input('timestamp'),
                ));
    
        $hmacShopify = $request->input('hmac');
    
        $hmacApp = hash_hmac('sha256', $queryString, env('API_SECRET_KEY_SHOPIFY_APP'));
    
        if($hmacShopify === $hmacApp){
            return true;
        }
    
        return false;
    }
    
    
}
