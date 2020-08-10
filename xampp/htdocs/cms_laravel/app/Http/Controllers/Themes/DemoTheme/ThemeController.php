<?php


namespace App\Http\Controllers\Themes\DemoTheme;  // 編集
use App\Http\Controllers\Controller;
use App\BlogInfo; //追加記事
use App\Post;//追加記事
use App\Fixed;
use Illuminate\Support\Facades\DB; //追加
use Illuminate\Support\Facades\Auth; //ユーザー 追加
use Carbon\Carbon; //日付追加
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    public function index(){

        $query = Post::query();
       

        if(Auth::check()){
            $posts = DB::table('posts')->orderBy('updated_at', 'desc');
            $posts_paginate = $query->orderBy('updated_at', 'desc')->paginate(6);
            $fixeds = DB::table('fixeds')->orderBy('updated_at', 'desc');
        }else{
            $posts = DB::table('posts')->orderBy('updated_at', 'desc')->where('post_status','公開');
            $posts_paginate = $query->orderBy('updated_at', 'desc')->where('post_status','公開')->paginate(6);
            $fixeds = DB::table('fixeds')->orderBy('updated_at', 'desc')->where('fixed_status','公開');
        }

        $main_imgs = DB::table('main_imgs');
        $blog_info_first = BlogInfo::first();
        return view('DemoTheme/index', compact('main_imgs','posts','blog_info_first','posts_paginate','fixeds'));

    }

    public function blog(Request $request){
        $under_title = 'ブログ';
        $under_description = 'ブログページ';
        $under_keywords = 'ブログ';
        $query = Post::query();
        $blog_info_first = BlogInfo::first();
        $search = $request->input('search');

        //パンくずcurrent
        $current = 'ブログ';

        $fixeds = DB::table('fixeds')->orderBy('updated_at', 'desc');

        $pankuzu_array = array(url('/').'/'=>'ホーム');

        if(!empty($search)){
            $query->where('post_title', 'LIKE', "%{$search}%")->orWhere('post_excerpt', 'LIKE', "%{$search}%");
            $under_title = $search.' | 検索結果';
            $under_description = $search.'検索結果ページ';
            $under_keywords = $search.',検索結果';
        }

        //クエリ文字列取得
        $data = $request->p;
        $data_search = $request->search;
        $data_tag = $request->tag;
        $data_cat = $request->cat;
        $data_author = $request->author;
        $data_picker = $request->picker;
        
         //クエリ文字列取得
        if(!empty($data_tag)){
            $query->where('post_name', 'LIKE', '%'.$data_tag.',%');
            $under_title = $data_tag.' | タグ';
            $under_description = $data_tag.'タグページ';
            $under_keywords = $data_tag.',タグ';
        }

        if(!empty($data_cat)){
            $query->where('category',$data_cat);
            $under_title = $data_cat.' | カテゴリー';
            $under_description = $data_cat.'カテゴリーページ';
            $under_keywords = $data_cat.',カテゴリー';
        }

        if(!empty($data_author)){
            $users_id = DB::table('users')->find($data_author);
            $query->where('post_user',$data_author);
            $under_title = $users_id->name.' | ユーザー';
            $under_description = $users_id->name.'ユーザーページ';
            $under_keywords = $users_id->name.',ユーザー';
        }


        if(!empty($data_picker)){
            $query->where('updated_at', 'LIKE', "%{$data_picker}%");
            
            $under_title = (new Carbon($data_picker))->format('Y年m月d日').' | 日付';
            $under_description = (new Carbon($data_picker))->format('Y年m月d日').'日付ページ';
            $under_keywords = (new Carbon($data_picker))->format('Y年m月d日').',日付';
        }


        if(Auth::check()){
            $posts = DB::table('posts')->orderBy('updated_at', 'desc');
            $posts_ex = DB::table('posts')->orderBy('updated_at', 'desc');
            $posts_paginate = $query->orderBy('updated_at', 'desc')->paginate(9);
        }else{
            $posts = DB::table('posts')->orderBy('updated_at', 'desc')->where('post_status','公開');
            $posts_ex = DB::table('posts')->orderBy('updated_at', 'desc')->where('post_status','公開');
            $posts_paginate = $query->orderBy('updated_at', 'desc')->where('post_status','公開')->paginate(9);
        }

        // if($data_search != '' || $data_tag != '' || $data_cat != ''){
        //     $pankuzu_array = array(url('/').'/'=>'ホーム',url('/blog/').'/'=>'ブログ');
        //     $current = $data_cat;
        //     return view('DemoTheme/blog/index', compact('under_title','under_description','under_keywords','posts','blog_info_first','posts_paginate','data_search','data_tag','data_cat','fixeds','pankuzu_array','current'));
        // }
        if($data_search != ''){
            $current = '検索:'.$data_search;
        }
        if($data_tag != ''){
            $current = 'タグ:'.$data_tag;
        }

        if($data_cat != ''){
            $current = 'カテゴリー:'.$data_cat;
        }
        
        if($data_author != ''){
            $users_id = DB::table('users')->find($data_author);
            $current = 'ユーザー:'.$users_id->name;
        }

        if($data_picker != ''){
            $current = '日付:'.(new Carbon($data_picker))->format('Y年m月d日');
        }
        
        if($data_search != '' || $data_tag != '' || $data_cat != '' || $data_author != '' || $data_picker !=''){
            $pankuzu_array = array(url('/').'/'=>'ホーム',url('/blog/').'/'=>'ブログ');
           
            return view('DemoTheme/blog/index', compact('under_title','under_description','under_keywords','posts','blog_info_first','posts_paginate','data_search','data_tag','data_cat','data_author','data_picker','fixeds','pankuzu_array','current'));
        }

        foreach($posts->get() as $post){
           
            if($data == $post->id){
                $posts_id = DB::table('posts')->find($data);
                $user = DB::table('users')->find($posts_id->post_user);
                if($posts_id->seo_title == ''){
                    $under_title = $posts_id->post_title.' | '.$posts_id->category.' | ブログ';
                    $current =$posts_id->post_title;
                }else{
                    $under_title = $posts_id->seo_title.' | '.$posts_id->category.' | ブログ';
                    $current = $posts_id->seo_title;
                }
                
                if($posts_id->meta_description == ''){
                    $under_description = $posts_id->post_title;
                }else{
                    $under_description = $posts_id->meta_description;
                }
                if($posts_id->meta_keywords == ''){
                    $under_keywords = $posts_id->post_title;
                }else{
                    $under_keywords = $posts_id->meta_keywords.','.$posts_id->post_title;
                }
                
               
                
                $pankuzu_array = array(url('/').'/'=>'ホーム',url('/blog/').'/'=>'ブログ',url('blog/?cat='.$posts_id->category)=>$posts_id->category);
                return view('DemoTheme/blog/details', compact('under_title','under_description','under_keywords','blog_info_first','posts','posts_id','fixeds','pankuzu_array','current','posts_ex','user'));
            }
        }
        // if(empty($data_search)){

        // }

        if($data == ''){
            return view('DemoTheme/blog/index', compact('under_title','under_description','under_keywords','posts','blog_info_first','posts_paginate','data_search','data_tag','data_cat','fixeds','pankuzu_array','current'));
        }else{
            $under_title = '404';
            $under_description = '404ページ';
            $under_keywords = '404';
            return view('DemoTheme/404/index', compact('under_title','under_description','under_keywords','blog_info_first','posts','fixeds'));
        }
    }

    public function fixed($url){
        $under_title = 'ブログ';
        $under_description = 'ブログページ';
        $under_keywords = 'ブログ';
        $blog_info_first = BlogInfo::first();
        //$posts = DB::table('posts')->orderBy('updated_at', 'desc');
        //$fixeds = DB::table('fixeds')->orderBy('updated_at', 'desc');

        $pankuzu_array = array(url('/').'/'=>'ホーム');

        if(Auth::check()){
            $posts = DB::table('posts')->orderBy('updated_at', 'desc');
            $fixeds = DB::table('fixeds')->orderBy('updated_at', 'desc');
        }else{
            $posts = DB::table('posts')->orderBy('updated_at', 'desc')->where('post_status','公開');
            $fixeds = DB::table('fixeds')->orderBy('updated_at', 'desc')->where('fixed_status','公開');
        }

        foreach($fixeds->get() as $fixed){
            if($url == $fixed->fixed_url){
                $pankuzu_array = array(url('/').'/'=>'ホーム');
                $fixed_url = DB::table('fixeds')->where('fixed_url',$url)->first();
                if($fixed_url->seo_title == ''){
                    $under_title = $fixed_url->fixed_title;
                    $current =$fixed_url->fixed_title;
                }else{
                    $under_title = $fixed_url->seo_title;
                    $current = $fixed_url->seo_title;
                }

                if($fixed_url->meta_description == ''){
                    $under_description = $fixed_url->fixed_title;
                }else{
                    $under_description = $fixed_url->meta_description;
                }
                if($fixed_url->meta_keywords == ''){
                    $under_keywords = $fixed_url->fixed_title;
                }else{
                    $under_keywords = $fixed_url->meta_keywords.','.$fixed_url->fixed_title;
                }

                return view('DemoTheme/fixed/index', compact('under_title','under_description','under_keywords','blog_info_first','posts','fixed_url','fixeds','current','pankuzu_array'));
            }
        }
        if($url == ''){
            return view('DemoTheme/index', compact('main_imgs','posts','blog_info_first','posts_paginate','fixeds'));
        }else{
            $under_title = '404';
            $under_description = '404ページ';
            $under_keywords = '404';
            return view('DemoTheme/404/index', compact('under_title','under_description','under_keywords','blog_info_first','posts','fixeds'));
        }
    }

    


    


    public function toArray($id)
    {
        return [
            'created_at' => (new Carbon($this->created_at))->toDateTimeString(),
            'updated_at' => (new Carbon($this->updated_at))->toDateTimeString(),
        ];
    }
    
}

