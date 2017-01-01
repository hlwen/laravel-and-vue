<?php

namespace App\Http\Controllers\admin;

use App\ArticleType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleTypeController extends Controller
{
    public function ArticleTypes(Request $request)
    {

        $data =$request->input();
        $per_page=$data['per_page'];
        $id = $data['id'];
        $ArticleType = ArticleType::where('parentId', $id)->paginate($per_page);
        return response()->json([
            'status' => 'success',
            'data' => $ArticleType
        ]);
    }
    public function allArticleType(Request $request)
    {
//        $data =$request->input();
//        $id = $data['id'];
        $ArticleType = ArticleType::get();
        return response()->json([
            'status' => true,
            'data' => $ArticleType,
        ]);
    }
    public function save(Request $request)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);
        $data =$request->input();
//        $ArticleType = new ArticleType();
//        $ArticleType ->title = $data['title'];
//        $ArticleType ->introduce = $data['introduce'];
//        $ArticleType ->path = $data['path'];
//        $ArticleType ->ioc = $data['ioc'];
//        $ArticleType ->parentId = $data['parentId'];
        //'title', 'path', 'ioc', 'parentId'
//        dd($request->input());

//        if($ArticleType->save()){


        if(ArticleType::create($data)){
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
        if(ArticleType::find($id)->update($data)){
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
        if(ArticleType::find($id)->delete()){
            return response()->json([
                'status' => true,
                'msg' => '删除成功',
                'data' => null,
            ]);
        }
    }
    //
}
