<?php

namespace App\Http\Controllers\admin;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function Articles(Request $request)
    {

        $data =$request->input();
        $per_page=$data['per_page'];
        $id = $data['id'];
        $Article = Article::where('id', $id)->paginate($per_page);
        return response()->json([
            'status' => 'success',
            'data' => $Article
        ]);
    }
    public function allArticle(Request $request)
    {
//        $data =$request->input();
//        $id = $data['id'];
        $Article = Article::get();
        return response()->json([
            'status' => true,
            'data' => $Article,
        ]);
    }
    public function save(Request $request)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);
        $data =$request->input();
//        $Article = new Article();
//        $Article ->title = $data['title'];
//        $Article ->introduce = $data['introduce'];
//        $Article ->path = $data['path'];
//        $Article ->ioc = $data['ioc'];
//        $Article ->parentId = $data['parentId'];
        //'title', 'path', 'ioc', 'parentId'
//        dd($request->input());

//        if($Article->save()){


        if(Article::create($data)){
        return response()->json([
            'status' => true,
             'msg' => '新增成功',
            'data' => null,
        ]);
        }
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required'
        ]);
        $data =$request->input();
        $id = $data['id'];
        if(Article::find($id)->update($data)){
            return response()->json([
                'status' => true,
                'msg' => '修改成功',
                'data' => null,
            ]);
        }

    }
    public function delete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        $data =$request->input();
        $id = $data['id'];
        if(Article::find($id)->delete()){
            return response()->json([
                'status' => true,
                'msg' => '删除成功',
                'data' => null,
            ]);
        }
    }
    //
}
