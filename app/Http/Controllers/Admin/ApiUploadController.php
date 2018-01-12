<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Upload\UploadController;
use Illuminate\Http\Request;

class ApiUploadController extends Controller
{
    //
    public function upload(Request $request){
        $file=$request->file('file');
        $scaling=$request->get('scaling');
        $uploadresoult=new UploadController($file,$scaling);
        $url=$uploadresoult->upload();
        return $url;

    }

    public function code(Request $request){
        $code=$request->get('js_code');
        $resoult=file_get_contents('https://api.weixin.qq.com/sns/jscode2session?appid=wx3c84011a82d6c2cd&secret=c8f33fae936c74b869a4a4a80dfe39c1&js_code='.$code.'&grant_type=authorization_code');
        $kk=json_decode($resoult);
        return $kk->openid;
    }
}
