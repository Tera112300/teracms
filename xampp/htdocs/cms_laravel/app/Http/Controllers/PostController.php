<?php

namespace App\Http\Controllers;
use App\Post;
use Carbon\Carbon; //日付追加
use Illuminate\Support\Facades\DB; //追加
use Illuminate\Support\Facades\Auth; //ユーザー 追加
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index (Request $request)
    {
    //$posts = DB::table('posts')->get();
    //$posts = DB::table('posts')->paginate(2);
    $title = '記事一覧';

    $data = $request->message;
    $table_search = $request->input('table_search');
    $query = Post::query();
    if(!empty($table_search)){
        $query->where('post_title', 'LIKE', "%{$table_search}%")->orWhere('post_user', 'LIKE', "%{$table_search}%");
    }
    $posts = $query->orderBy('id', 'desc')->paginate(10);
    $users = DB::table('users');
    
    //return view('post/index', ['posts' => $posts]);
    //return view('post/index', compact('title','posts','data','search'));
    return view('post/index', compact('title','posts','data','users'));
    }
    public function create()
    {
        $title = '投稿';
        $categories = DB::table('categories')->orderBy('id', 'desc')->get();
        $users = DB::table('users');
        return view('post/create', compact('title','categories','users'));
    }

    public function create_post(Request $request){
        $validate_rule = [
            'post_title' => 'required',
            'post_excerpt' => 'between:30,110',
            'post_guid' => 'image',
            'category' => 'required',
            'post_user' => 'required',
            //'post_guid' => 'mimes:jpg,png,gif',
        ];
        $this->validate($request,$validate_rule);

        $post = new \App\Post;
        $post->post_title = $request->input('post_title');
        $post->post_content = $request->input('post_content');
        $post->post_excerpt = $request->input('post_excerpt');
        $post->post_name = $request->input('post_name');
        $post->category = $request->input('category');
        $post->post_status = $request->input('post_status');

        $file = $request->file('post_guid');
        
        $post_guid_hidden = $request->input('post_guid_hidden');
        if(!empty($file)){
            $filename = str_shuffle(time().$file->getClientOriginalName()). '.' . $file->getClientOriginalExtension();//ファイル名をユニークするためstr_shuffleを使う
            if(empty($post_guid_hidden)){
                $filename = "";
            }else{
                $move = $file->move('public/upload/',$filename);
            }
        }else{
            $filename = "";
        }
        $post->post_guid = $filename;


        $post->post_user = $request->input('post_user'); //ユーザーの一意のid指定
        $post->seo_title = $request->input('seo_title');
        $post->meta_description = $request->input('meta_description');
        $post->meta_keywords = $request->input('meta_keywords');
        $post->save();
      
        return redirect('/cms-admin/post/');
    }

    public function store(Request $request)
    {
        //
    }
   
    public function show($id)
    {
        $title = '表示';
        //$posts_id = DB::table('posts')->find($id);
        $posts_id = DB::table('posts')->find($id);
        $users_id = DB::table('users')->find($posts_id->post_user);
        return view('post/show', compact('title','posts_id','users_id'));
    }

    public function edit($id)
    {
        $title = '編集';
        $posts_id = DB::table('posts')->find($id);
        //$users_id = DB::table('users')->find($posts_id->post_user);
        $users = DB::table('users');
        $categories = DB::table('categories')->orderBy('id', 'desc')->get();
        
        return view('post/edit', compact('title','posts_id','users','categories'));
    }

    public function update(Request $request,$id)
    {
        $validate_rule = [
            'post_title' => 'required',
            'post_excerpt' => 'between:30,110',
            'post_guid' => 'image',
            'category' => 'required',
            'post_user' => 'required',
            //'post_guid' => 'mimes:jpg,png,gif',
        ];
        $this->validate($request,$validate_rule);

        $posts_id = DB::table('posts')->find($id);
        
        $posts_form = Post::find($request->id);
        $posts_form->post_title = $request->input('post_title');
        $posts_form->post_content = $request->input('post_content');
        $posts_form->post_excerpt = $request->input('post_excerpt');
        $posts_form->post_name = $request->input('post_name');
        $posts_form->category = $request->input('category');
        $posts_form->post_status = $request->input('post_status');

        $posts_form->post_user = $request->input('post_user');

        //エラー$posts_form->post_guid = $request->input('post_guid');

        $file = $request->file('post_guid');
        
        if(!empty($file)){
            //$filename = $file->getClientOriginalName();
            $filename = str_shuffle(time().$file->getClientOriginalName()). '.' . $file->getClientOriginalExtension();//ファイル名をユニークするためstr_shuffleを使う
            $move = $file->move('public/upload/',$filename);
            
        }else{
            $filename = "";
            if($posts_id->post_guid == $request->input('post_guid_hidden') && $posts_id->post_guid != null){
                $filename = $request->input('post_guid_hidden');
            }
        }
        $posts_form->post_guid = $filename;
        


        $posts_form->seo_title = $request->input('seo_title');

        $posts_form->seo_title = $request->input('seo_title');
        $posts_form->meta_description = $request->input('meta_description');
        $posts_form->meta_keywords = $request->input('meta_keywords');

        $posts_form->update();
        return redirect('/cms-admin/post/edit/'.$id);
        
    }

    public function upload_img(Request $request){
        $file = $request->file('files');
        if(!empty($file)){
            $filename = str_shuffle(time().$file->getClientOriginalName()). '.' . $file->getClientOriginalExtension();//ファイル名をユニークするためstr_shuffleを使う
            //$move = $file->move('./upload/',$filename);
            $move = $file->move('public/upload/',$filename);
            return $filename;
        }
    }

    public function destroy($id)
    {
        //
        $posts_id = DB::table('posts')->delete($id);
        return redirect('/cms-admin/post/');
    }

    public function destroy_all()
    {
        //
        $posts_id = DB::table('posts')->delete();
        return redirect('/cms-admin/post/');
    }

    public function toArray($id)
    {
        return [
            'created_at' => (new Carbon($this->created_at))->toDateTimeString(),
            'updated_at' => (new Carbon($this->updated_at))->toDateTimeString(),
        ];
    }

}
