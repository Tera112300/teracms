<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Support\Facades\DB; //追加
use Illuminate\Support\Facades\Auth; //ユーザー 追加

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

   public function index(Request $request){
    $title = 'カテゴリー';

    $data = $request->message;
    $table_search = $request->input('table_search');
    $query = Category::query();
    if(!empty($table_search)){
        $query->where('name_category', 'LIKE', "%{$table_search}%");
    }
    $categories = $query->orderBy('id', 'desc')->paginate(2);
   
    return view('post/category/index', compact('title','categories','data'));
   }

   public function create(Request $request){

    $validate_rule = [
        'name_category' => 'required|unique:categories',
    ];
    $this->validate($request,$validate_rule);

    $category = new \App\Category;
    $category->name_category = $request->input('name_category');
    $category->save();
    return redirect('/cms-admin/post/category/');
}

public function edit($id)
{
    $title = 'カテゴリー編集';
    $categories_id = DB::table('categories')->find($id);
    return view('post/category/edit', compact('title','categories_id'));
}

public function update(Request $request,$id){
    $validate_rule = [
        'name_category' => 'required|unique:categories,name_category,'.$id,
    ];
    $this->validate($request,$validate_rule);
    $category_form = Category::find($request->id);
    $category_form->name_category = $request->input('name_category');
    $category_form->update();
    return redirect('/cms-admin/post/category/edit/'.$id);
}


   public function destroy($id)
    {
        $category_name = Category::find($id)->name_category;
        
        $posts = DB::table('posts')->where('category',$category_name)->update(['category' => '未分類']);
        //
        $categories_id = DB::table('categories')->delete($id);
        return redirect('/cms-admin/post/category/');
    }

    public function destroy_all()
    {
        $category_name = Category::find($id)->name_category;
        $posts = DB::table('posts')->where('category',$category_name)->update(['category' => '未分類']);
        //
        $categories_id = DB::table('categories')->delete();
        return redirect('/cms-admin/post/category/');
    }

}
