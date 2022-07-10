<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Jobs\WebHookCreateJob;
use App\Jobs\WebHookDeleteJob;
use App\Jobs\WebHookUpdateJob;
use App\Repositories\Mysqls\AccountShopifyMysql;
use App\Repositories\Mysqls\ProductShopifyMysql;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

class ApiWebhookController extends Controller
{
    protected $shopifyMysql;
    protected $productShopifyMysql;
    public function __construct(
        AccountShopifyMysql $shopifyMysql,
        ProductShopifyMysql $productShopifyMysql
    ) {
        $this->shopifyMysql = $shopifyMysql;
        $this->productShopifyMysql = $productShopifyMysql;
    }
    
    public function listenWebHookCreate(Request $request)
    {
       
        $this->dispatch(new WebHookCreateJob($request->toArray()));
    
    
    }
    public function listenWebHookUpdate(Request $request)
    {
       
        $this->dispatch(new WebHookUpdateJob($request->toArray()));
    }
    public function listenWebHookDelete(Request $request)
    {
        $this->dispatch(new WebHookDeleteJob($request->toArray()));
    }
}
