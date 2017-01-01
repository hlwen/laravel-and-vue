

<?php
/**
 * 后台管理数据接口
 */
Auth::routes();

Route::get('/', 'admin\indexController@index');
Route::get('/index', 'admin\indexController@login');
//    菜单查询
Route::any('/menus', 'admin\menuController@menus');
Route::get('/userMenus', 'admin\menuController@userMenus');
Route::post('/menu', 'admin\menuController@save');
Route::put('/menu', 'admin\menuController@update');
Route::delete('/menu', 'admin\menuController@delete');
//文章
Route::any('/articles', 'admin\articleTypeController@articles');
Route::get('/allArticles', 'admin\articleTypeController@allArticles');
Route::post('/article', 'admin\articleController@save');
Route::put('/article', 'admin\articleController@update');
Route::delete('/article', 'admin\articleController@delete');
//文章分类
Route::any('/articleTypes', 'admin\articleTypeController@articleTypes');
Route::get('/allArticleType', 'admin\articleTypeController@allArticleType');
Route::post('/articleType', 'admin\articleTypeController@save');
Route::put('/articleType', 'admin\articleTypeController@update');
Route::delete('/articleType', 'admin\articleTypeController@delete');


Route::group(['prefix'=>'admin'],function (){


});