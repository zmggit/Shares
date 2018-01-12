<?php

namespace App\Http\Controllers\Upload;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;
use YueCode\Cos\QCloudCos;
use Intervention\Image\Facades\Image;

class UploadController extends Controller
{
    protected $file;
    protected $scaling;
    function __construct($file,$scaling)
    {
        $this->file = $file;
        $this->scaling = $scaling;
    }
    public function upload()
    {
        $bucket = "photo";
        $folder = "share";
        $files=$this->file;
        $scaling=$this->scaling;
        $srcPath = $files->getRealPath();
        $choice=$files->getClientOriginalExtension();
        if ($choice=='mp4'||$choice=='3gp'||$choice=='wmv'||$choice=='rm'||$choice=='avi'||$choice=='rmvb'||$choice=='wmv'){
            $ClientOriginalName = time() . rand(10000, 9999999) . '.' . $files->getClientOriginalExtension();
            $dstPath = "$folder/$ClientOriginalName";
            $upload = QCloudCos::upload($bucket,$srcPath,$dstPath);
            $upload_json=json_decode($upload);
            $data=$upload_json->data;
            if ($upload_json->code==0){
                return [
                    'data'=>$data->source_url,
                    'ok'=>'true'
                ];
            }else{
                return [
                    'ok'=>'false'
                ];
            }
        }else{
            $ClientOriginalName = time() . rand(10000, 9999999) . '.' . $files->getClientOriginalExtension();
            $dstPath = "$folder/$ClientOriginalName";
            if ($scaling==null){
                $img = Image::make($files);
                $width=$img->width();
                $height=$img->height();
                $bi=$width/$height;
                if ($width>1440){
                    $width=1440;
                }
                $height=$width/$bi;
                $resoult=$img->resize($width,$height)->save('photo/'.$ClientOriginalName);
                $src='photo/'.$ClientOriginalName;
                $upload = QCloudCos::upload($bucket,$src,$dstPath);
                unlink($src);
                $upload_json=json_decode($upload);
                $data=$upload_json->data;
                if ($upload_json->code==0){
                    return [
                        'data'=>$data->source_url,
                        'ok'=>'true'
                    ];
                }else{
                    return [
                        'ok'=>'false'
                    ];
                }
            }else{
                $img = Image::make($files);
                $width=$img->width();
                if ($width>1440){
                    $width=1440;
                }
                $height=$width/$this->scaling;
                $resoult=$img->resize($width,$height)->save('photo/'.$ClientOriginalName);
                $src='photo/'.$ClientOriginalName;
                $upload = QCloudCos::upload($bucket,$src,$dstPath);
                unlink($src);
                $upload_json=json_decode($upload);
                $data=$upload_json->data;
                if ($upload_json->code==0){
                    return [
                        'data'=>$data->source_url,
                        'ok'=>'true'
                    ];
                }else{
                    return [
                        'ok'=>'false'
                    ];
                }
            }
        }

        }





}
