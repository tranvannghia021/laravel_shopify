<?php

namespace App\Jobs;

use App\Repositories\Mysqls\ProductShopifyMysql;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class WebHookCreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $datas;
    
    
    public function __construct($datas)
    {
        $this->datas=$datas;
     
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ProductShopifyMysql $productShopifyMysql)
    {
        $newid=$this->datas['id'];
        $isCheck=$productShopifyMysql->getIdShopify($newid);
        if(is_null($isCheck)){
            $result= $productShopifyMysql->createWebhook($this->datas);

        }
    }
}
