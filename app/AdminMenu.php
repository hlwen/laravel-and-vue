<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminMenu extends Model
{
    protected $table = 'admin_menu';

    protected $fillable =['title', 'path', 'ioc', 'parentId','introduce'];
    public $timestamps = true;

    public static function getMenu(){

        return 'sdf';
    }
    //
}
