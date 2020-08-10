<?php

namespace App\Http\Controllers;
use App\BlogInfo;
use Illuminate\Support\Facades\DB; //追加
use Illuminate\Support\Facades\Auth; //ユーザー 追加
use Illuminate\Http\Request;

class BlogInfosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = '設定';
        $blog_info_first = DB::table('blog_infos')->first();
        return view('bloginfo/index', compact('title','blog_info_first'));
    }
    public function update(Request $request){
        $validate_rule = [
            'name' => 'required|string|max:150',
            'description' => 'required|string|max:300',
            'twitter_url' => 'string|url',
            'facebook_url' => 'string|url',
            'instagram_url' => 'string|url',
        ];
        $this->validate($request,$validate_rule);

        if(!empty(BlogInfo::first())){
            $blog_info_first = BlogInfo::first();
            $blog_info_first->name = $request->input('name');
            $blog_info_first->description = $request->input('description');
            $blog_info_first->twitter_url = $request->input('twitter_url');
            $blog_info_first->facebook_url = $request->input('facebook_url');
            $blog_info_first->instagram_url = $request->input('instagram_url');
           
            $blog_info_first->update();
        }else{
            $blog_info_first = new \App\BlogInfo;
            $blog_info_first->name = $request->input('name');
            $blog_info_first->description = $request->input('description');
            $blog_info_first->twitter_url = $request->input('twitter_url');
            $blog_info_first->facebook_url = $request->input('facebook_url');
            $blog_info_first->instagram_url = $request->input('instagram_url');
           

            $blog_info_first->save();
        }
       
        return redirect('/cms-admin/bloginfo/');
    }
}
