<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB; //追加
use Illuminate\Support\Facades\Auth; //ユーザー 追加
use Illuminate\Http\Request;

class CmsAdminsController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        $title = 'ダッシュボード';
        $posts = DB::table('posts')->orderBy('id', 'desc')->get();
        $fixeds = DB::table('fixeds')->orderBy('id', 'desc')->get();
        
        $users = DB::table('users')->orderBy('id', 'desc')->get();
        return view('cms_admin/index', compact('title','posts','fixeds','users'));  
    }
   
}
