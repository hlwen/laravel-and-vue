<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleType extends Model
{
    protected $table = 'articles_type';

    protected $fillable =['name', 'describe', 'ioc', 'parentId'];
//关闭时间
    public $timestamps = false;
    public static function getMenu(){

        return 'sdf';
    }
    //
}
