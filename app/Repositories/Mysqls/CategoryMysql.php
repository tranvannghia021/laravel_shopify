<?php
namespace App\Repositories\Mysqls;
use Illuminate\Support\Facades\DB;

class CategoryMysql{
    function getAll(){
        return DB::table('categorys')->get();
    }
    function getSearch($search){
        $result= DB::table('categorys');
        if(!is_null($search)){
            $result->where('name','%'.$search.'%');
        }
        return $result->get();
    }
    function getId($id){
        return DB::table('categorys')->where('id',$id)->get();
    }
    function getIdParent($id){
        return DB::table('categorys')->where('id_category',$id)->get();
    }
    function update($request,$id){
        try {
            DB::beginTransaction();
            DB::table('categorys')->where('id',$id)->update([
                'id_category'=>$request->input('category_id'),
                'name'=>$request->input('category_name'),
                'updated_at'=>date('Y-m-d H:i:s')
            ]);
            DB::commit();
        } catch (\Exception $err) {
            DB::rollback();
            return false;
        }
        return true;
    }
    function delete($id){
        try {
            DB::beginTransaction();
            DB::table('categorys')->where('id',$id)->delete();
            DB::commit();
        } catch (\Exception $err) {
            DB::rollback();
            return false;
        }
        return true;
    }
    function cate_tree($array,$cate_id = 0,$level = 0){
        $result=[];
        foreach($array as $item){
            if($item->id_category == $cate_id ){
                $item->level = $level;
                array_push($result,$item);
                $child = $this->cate_tree($array,$item->id,$level + 1);
             $result = array_merge($result,$child);
            }
        }
        return $result;
    }
    function create($request){
        try {
            DB::beginTransaction();
            DB::table('categorys')->insert([
                'id_category'=>$request->input('category_id'),
                'name'=>$request->input('category_name'),
                'created_at'=>date('Y-m-d H:i:s')
            ]);
            DB::commit();
        } catch (\Exception $err) {
            DB::rollback();
            return false;
        }
        return true;
    }
   

}