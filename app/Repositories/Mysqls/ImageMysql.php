<?php
namespace App\Repositories\Mysqls;
use Illuminate\Support\Facades\DB;

class ImageMysql{
    function create($name_file,$id){
        try {
            DB::beginTransaction();
            DB::table('images')->insert([
                'product_id'=>$id,
                'thumb'=>$name_file,
                'created_at'=>date('Y-m-d H:i:s')
            ]);
           DB::commit();
        } catch (\Exception $err) {
           DB::rollback();
           return false;
        }
        return true;
    }
    function update($name_file,$id){
        try {
            DB::beginTransaction();
            DB::table('images')->where('product_id',$id)->update([
                'product_id'=>$id,
                'thumb'=>$name_file,
                'updated_at'=>date('Y-m-d H:i:s')
            ]);
           DB::commit();
        } catch (\Exception $err) {
            DB::rollback();
            return false;
        }
        
        return true;
    }
   function getId($id){
    return DB::table('images')->where('product_id',$id)->get();
   }
   
}