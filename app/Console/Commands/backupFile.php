<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class backupFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backupdata:file {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'backup database to file ';

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
        // $products=DB::table('products')->limit(10)->get();
        
        // $products=DB::table('products')->orderBy('id')->get()->chunk(10);
        $current_id=1;
        $limit=10;
        $i=0;
        $name=$this->argument('name');
        $products=$this->queryDB($current_id,$limit);
        while(true){
            if(file_exists('storage/'.$name.'-'.$i.'.csv'))
                unlink('storage/'.$name.'-'.$i.'.csv');
            
            $filename= fopen('storage/'.$name.'-'.$i.'.csv','w');
            foreach($products  as $product){
                fputcsv($filename,(array)$product);
                $current_id=$product->id;
               }
               fclose($filename);
            if(count($products->toArray()) < $limit){
                break;
            }else{
                $products=$this->queryDB($current_id,$limit);
                $i++;
            }
        }
         $number=$products->count();
            $name=$this->argument('name');
         for($i=0;$i < $number ;$i++){
             $filename= fopen('storage/'.$name.$i.'.csv','w');
           
             foreach($products[$i]  as $product){
                 fputcsv($filename,(array)$product);
                }
                fclose($filename);
            }
            // for($i=0;$i < $number ;$i++){
            // Storage::disk('s3')->put('uploads/' . $name.$i.'.csv', fopen('storage/'.$name.$i.'.csv', 'r+'));
            // }
           
               
            echo '----success-----';
         
        
        return 0;
    }
    function queryDB($current_id,$limit){
       return DB::table('products')->orderBy('id')->where('id','>',$current_id)->limit($limit)->get();
    }
}
