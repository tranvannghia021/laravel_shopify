<?php

namespace App\Jobs;

use App\Repositories\Mysqls\ProductShopifyMysql;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class WebHookDeleteJob implements ShouldQueue
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
        $isCheck=$productShopifyMysql->getIdShopify($this->datas['id']);
        if(!is_null($isCheck)){
            $result= $productShopifyMysql->deleteWebhook($this->datas);
            
        }
    }
}
