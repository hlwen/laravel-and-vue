<?php

namespace App\Http\Controllers\admin;

use App\AdminMenu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class menuController extends Controller
{
    public function menus(Request $request)
    {

        $data =$request->input();
        $per_page=$data['per_page'];
        $id = $data['id'];
        $AdminMenu = AdminMenu::where('parentId', $id)->paginate($per_page);
        return response()->json([
            'status' => 'success',
            'data' => $AdminMenu
        ]);
    }
    public function userMenus(Request $request)
    {
//        $data =$request->input();
//        $id = $data['id'];
        $AdminMenu = AdminMenu::get();
        return response()->json([
            'status' => true,
            'data' => $AdminMenu,
        ]);
    }
    public function save(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'path' => 'required',
        ]);
        $data =$request->input();
//        $AdminMenu = new AdminMenu();
//        $AdminMenu ->title = $data['title'];
//        $AdminMenu ->introduce = $data['introduce'];
//        $AdminMenu ->path = $data['path'];
//        $AdminMenu ->ioc = $data['ioc'];
//        $AdminMenu ->parentId = $data['parentId'];
        //'title', 'path', 'ioc', 'parentId'
//        dd($request->input());

//        if($AdminMenu->save()){


        if(AdminMenu::create($data)){
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
            'path' => 'required'
        ]);
        $data =$request->input();
        $id = $data['id'];
        if(AdminMenu::find($id)->update($data)){
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
        if(AdminMenu::find($id)->delete()){
            return response()->json([
                'status' => true,
                'msg' => '删除成功',
                'data' => null,
            ]);
        }
    }
    //
}
