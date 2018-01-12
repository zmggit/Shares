<?php

namespace App\Http\Controllers\Web;

use App\Model\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //首页
    public function index(Request $request)
    {
        $per_page=$request->get('per_page');
        if ($per_page==null){
            $per_page=8;
            return News::where('status',0)->orderBy('created_at','desc')->paginate($per_page);
        }else{
            return News::where('status',0)->orderBy('created_at','desc')->paginate($per_page);
        }
    }



}
