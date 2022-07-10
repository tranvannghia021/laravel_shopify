<?php
namespace App\Repositories\Mysqls;

use App\Models\Crawl;
use App\Models\CrawlDetail;
use Illuminate\Support\Facades\DB;

class CrawlMysql{
    function getAll(){
        return DB::table('crawls')->orderBy('id')->cursorPaginate(5);
    }
    function getAllByPublish(){
        return DB::table('crawls')->orderBy('id')->where('status','publish')
                    ->cursorPaginate(5);
    }
    function getId($id){
        return DB::table('crawls_detail')->where('crawl_id',$id)->get();
    }
    function findEditId($id){
        return Crawl::join('crawls_detail','crawls_detail.crawl_id','=','Crawls.id')
                    ->where('crawls_detail.crawl_id',$id)
                    ->first(['crawls_detail.description as description_sub','Crawls.*']);
    }
    function update($request,$id){
        try {
            DB::beginTransaction();
                CrawlDetail::where('crawl_id',$id)->update([
                    'description'=>$request->input('sub_desc'),
                    'updated_at'=>date('Y-m-d H:i:s')
                ]);
                Crawl::where('id',$id)->update([
                    'title'=>$request->input('title'),
                    'description'=>$request->input('desc'),
                    'status'=>$request->input('status'),
                    'updated_at'=>date('Y-m-d H:i:s')
                ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
        return true;
    }
   function delete($request){
        try {
            DB::beginTransaction();
            Crawl::where('id',$request->input('idDelete'))->delete();
            CrawlDetail::where('crawl_id',$request->input('idDelete'))->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
        return true;
   }

}