<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\DB;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Console\Command;
use Goutte;


class crawlData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl data from website dantri';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
            if($this->delete()){
                $url = 'https://dantri.com.vn/su-kien.htm';
                $crawler = Goutte::request('GET', $url);
                $crawler->filter('div.list article.article-item')->each(function ($node) {
                     
                    $title = $node->filter('h3.article-title a')->text();
                    $description=$node->filter('div.article-excerpt a')->text();
                    $thum_sub=$node->filter('div.article-excerpt a')->attr('href');
                    $thumb='https://dantri.com.vn'.$thum_sub;
                    $img=$node->filter('div.article-thumb a img ')->attr('data-src');
                   $id_last= DB::table('crawls')->insertGetId([
                        'title'=>$title,
                        'description'=>$description,
                        'thumb'=>$thumb,
                        'img'=>$img
                    ]);
                    
                    $this->crawls_detail($thum_sub,$id_last);
                    });
                echo '-----Success-----';
                return 0;
            }else{
                echo "------Error-----";
            }
        
        
       
        return 0;
    }
    public function crawls_detail($thumb,$id_last){
        $url = 'https://dantri.com.vn/'.$thumb;
        $crawler = Goutte::request('GET', $url);
        $this->id=$id_last;
        
        $crawler->filter('article.singular-container')->each(function ($node) {
            $description_sub=$node->filter('div.singular-content')->html();
            
            DB::table('crawls_detail')->insert([
                'crawl_id'=>$this->id,   
                'description'=>$description_sub,
             
                
            ]);
          
            });

    }
    public function isCheckDatabase(){
        $data=DB::table('crawls')->get();
        if($data->count() > 0){
            return true;
        }
        return false;
    }
    public function delete(){
        try {
            DB::beginTransaction();
            DB::table('crawls')->delete();
            DB::table('crawls_detail')->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
        return true;
    }
}
