<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Repositories\Mysqls\CrawlMysql;
use Illuminate\Http\Request;


class CrawlController extends Controller
{
   
    protected $crawlMysql;
    public function __construct(CrawlMysql $crawlMysql){
        $this->crawlMysql=$crawlMysql;
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=$this->crawlMysql->getAll();
        return view('admin.crawls.list',compact('posts'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        // $posts=$this->crawlMysql->getId($id);
        // return view('admin.crawls.show',compact('posts'));
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts=$this->crawlMysql->findEditId($id);
        
        return view('admin.crawls.edit',compact('posts'));
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
        
        $result=$this->crawlMysql->update($request,$id);
        if($result){
            return response()->json([
                'error'=>false,
                'message'=>'Cập Nhập Thành Công!'
            ]);
        }else{
            return response()->json([
                'error'=>true,
                'message'=>'Cập Nhập Thất Bại!'
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
     
        $result=$this->crawlMysql->delete($request);
        if($result){
            return response()->json([
                'error'=>false,
                'message'=>'Xóa thành công!'
            ]);
        }
        return response()->json([
            'error'=>true,
            'message'=>'Xóa Thất Bại!'
        ]);
    }
}
