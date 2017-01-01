<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    protected $fillable =['name', 'describe', 'ioc', 'parentId'];
//关闭时间
    public $timestamps = true;
    public static function getMenu(){

        return 'sdf';
    }
}
