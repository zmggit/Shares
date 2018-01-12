<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class People extends Model
{
    //评论用户
    use SoftDeletes,Notifiable;
    public $incrementing=false;
    protected $table='people';
    protected $primaryKey='open_id';
    protected $fillable=['open_id','name','head_image'];

    public function news()
    {
        return $this->belongsToMany('App\Model\News','new_people','wei_id','new_id'
        );
  }

    public function comment()
    {
        return $this->hasMany('App\Model\Comment','wei_ip','open_id');
  }
}
