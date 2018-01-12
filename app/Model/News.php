<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class News extends Model
{
    //新闻
    use SoftDeletes,Notifiable;
    protected $table='news';
    protected $primaryKey='id';
    protected $fillable=['title','content','weight','status','view','cov_image'];

    public function people()
    {
        return $this->belongsToMany('App\Model\People','new_people','new_id','people_id');
    }

    public function comment()
    {
        return $this->hasMany('App\Model\Comment','new_id','id');
    }

}
