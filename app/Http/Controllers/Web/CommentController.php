<?php

namespace App\Http\Controllers\Web;

use App\Model\Comment;
use App\Model\News;
use App\Model\People;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    //用户写评论
    public function comment(Request $request,$id)
    {
        //用户open_id
        $open_id=$request->get('open_id');
        //用户头像
        $head_image=$request->get('head_image');
        //用户名
        $name=$request->get('name');
        //用户添加的评论
        $comment=$request->get('comment');

        $re=News::find($id)->whereHas('people',function ($sq) use ($open_id){
            $sq->where('open_id',$open_id);
        })->first();;
        if ($re){
            return $this->jsonResponse('1', '你已评论过这篇文章');
        }
        $people=People::create([
        'open_id'=>$open_id,
        'head_image'=>$head_image,
        'name'=>$name,
    ]);
        $comment=Comment::create([
            'comment'=>$comment,
            'new_id'=>$id,
            'wei_ip'=>$open_id
        ]);
        $resoult=News::find($id)->people()->attach($open_id, ['created_at' => date('Y-m-d H-i-s'), 'updated_at' => date('Y-m-d H-i-s')]);
        if ($request) {
            return $this->jsonSuccess();
        } else {
            return $this->jsonResponse('1', '评论失败');
        }

    }

//查看具体的文章 。。查看会增加阅读量
    public function info(Request $request,$id)
    {
        $open_id=$request->get('open_id');
        $re_open_id= Redis::get($id);
        if ($re_open_id==$open_id){
            return News::find($id)->with(['comment.com_people'])->first();
        }else{
            Redis::set($id,$open_id);
            $news= News::where('id',$id)->first();
            $news->view=$news->view+1;
            $news=$news->save();
            return News::find($id)->with(['comment.com_people'])->first();
        }


    }
    //具体文章下一共有多少评论
    public function count($id)
    {
         return News::find($id)->comment()->count();
    }
    //给评论点赞
    public function like(Request $request,$id)
    {
        $open_id=$request->get('open_id');
        $re_open_id= Redis::get($id);
        if ($re_open_id==$open_id){
            return $this->jsonResponse('1', '你已点过赞');
        }else{
            Redis::set($id,$open_id);
            $comment= Comment::where('id',$id)->first();
            $comment->like=$comment->like+1;
            $resoult=$comment->save();
            if ($resoult) {
                return $this->jsonSuccess();
            } else {
                return $this->jsonResponse('1', '点赞失败');
            }
        }
    }

    
}
