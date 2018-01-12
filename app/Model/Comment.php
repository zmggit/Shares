<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Comment extends Model
{
    //评论
    use SoftDeletes,Notifiable;
    protected $table='comment';
    protected $primaryKey='id';
    protected $fillable=['new_id','wei_ip','like','comment'];

    public function com_new()
    {
        return $this->belongsTo('App\Model\News','new_id','id');
    }

    public function com_people()
    {
        return $this->belongsTo('App\Model\People','wei_ip','open_id');
    }
}
