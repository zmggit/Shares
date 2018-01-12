<?php

namespace App\Http\Controllers\Admin;

use App\Model\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewController extends Controller
{
    //主显示
    public function index(Request $request){
             $per_page=$request->get('per_page');
             $new=News::query();
        if ($per_page==null){
            $per_page=8;
            return $new->orderBy('weight','desc')->paginate($per_page);
        }else{
            return $new->paginate($per_page);
        }
    }
//具体内容
    public function info($id)
    {
        return News::where('id',$id)->first();
    }
//修改状态
    public function status(Request $request,$id)
    {
        $status=$request->get('status');
     $resoult=News::where('id',$id)->update([
         'status'=>$status
     ]);
        if ($request) {
            return $this->jsonSuccess();
        } else {
            return $this->jsonResponse('1', '修改状态失败');
        }

    }
//添加数据
    public function store(Request $request)
    {
      $all=$request->only(['title','content','cov_image','weight']);
        if (empty($all['title'])){
            return $this->jsonResponse('1', '不能为空');
        }
        if (empty($all['content'])){
            return $this->jsonResponse('1', '不能为空');
        }
        if (empty($all['cov_image'])){
            return $this->jsonResponse('1', '不能为空');
        }
        $resoult=News::create($all);
        if ($request) {
            return $this->jsonSuccess();
        } else {
            return $this->jsonResponse('1', '添加失败');
        }

    }
   //修改数据
    public function edit(Request $request,$id)
    {
        $all=$request->only(['title','content','cov_image','weight']);
       $resoult=News::where('id',$id)->update($all);
        if ($request) {
            return $this->jsonSuccess();
        } else {
            return $this->jsonResponse('1', '修改失败');
        }

    }
  //删除数据
    public function destroy(Request $request,$id)
    {
        $resoult = News::destroy($id);
        if ($request) {
            return $this->jsonSuccess();
        } else {
            return $this->jsonResponse('1', '删除失败');
        }
    }
}
