<?php

namespace App\Http\Controllers;
use App\Post;
use App\User;
use Illuminate\Support\Facades\DB; //追加
use Illuminate\Support\Facades\Auth; //ユーザー 追加
use Illuminate\Support\Facades\Hash; //パスワード ハッシュ必要
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'ユーザー一覧';
        $data = $request->message;
        $table_search = $request->input('table_search');
        $query = User::query();
        
        if(!empty($table_search)){
            $query->where('name', 'LIKE', "%{$table_search}%")->orWhere('email', 'LIKE', "%{$table_search}%");
        }
        $users = $query->orderBy('id', 'desc')->paginate(10);
        $users_ex = DB::table('users')->orderBy('id', 'desc')->get();
        if(Auth::user()->user_status == "投稿者"){
            return abort(404);
        }else{
            return view('user/index', compact('title','users','data','users_ex'));
        }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = '新規ユーザー作成';
        if(Auth::user()->user_status == "投稿者"){
            return abort(404);
        }else{
            return view('user/create', compact('title'));
        }
        
    }

    public function create_user(Request $request){
        $validate_rule = [
            'name' => 'required|string|unique:users',
            'email' => 'required|email|string|max:255|unique:users',
            'password' => 'string|min:8|confirmed',
            //'user_img' => 'mimes:jpeg,png,gif',
            'user_img' => 'image',
            'user_status' => 'required',
        ];
        $this->validate($request,$validate_rule);

        $user = new \App\User;
       
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $password_is = $request->input('password');
        $user->password = Hash::make($password_is);
        $user->user_status = $request->input('user_status');
        

        $file = $request->file('user_img');
        
        $user_img_hidden = $request->input('user_img_hidden');
        if(!empty($file)){
            $filename = str_shuffle(time().$file->getClientOriginalName()). '.' . $file->getClientOriginalExtension();//ファイル名をユニークするためstr_shuffleを使う
            
            if(empty($user_img_hidden)){
                $filename = "";
            }else{
                $move = $file->move('public/upload/users/',$filename);
            }

        }else{
            $filename = "";
        }
        $user->user_img = $filename;


        $user->save();
        
        return redirect('/cms-admin/user/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'ユーザー編集';
        $users_id = DB::table('users')->find($id);
        return view('user/edit', compact('title','users_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        if(Auth::user()->user_status == "投稿者"){
            $validate_rule = [
                'email' => 'required|email|string|max:255|unique:users,email,'.$id,
                'password' => 'string|min:8',
                'user_img' => 'image',
            ];
        }elseif(Auth::user()->id == $request->id){
            $validate_rule = [
                'email' => 'required|email|string|max:255|unique:users,email,'.$id,
                'password' => 'string|min:8',
                'user_img' => 'image',
            ];
        }else{
            $validate_rule = [
                'email' => 'required|email|string|max:255|unique:users,email,'.$id,
                'password' => 'string|min:8',
                'user_img' => 'image',
                'user_status' => 'required',
            ];
        }
       
        $this->validate($request,$validate_rule);
        $users_form = User::find($request->id);
        
       
        $email_is = $request->input('email');
        if(!empty($email_is)){
            $users_form->email = $request->input('email');
        }

        
        $password_is = $request->input('password');
        
        if(!empty($password_is)){
            //値が入っていたら更新
            //$users_form->password = $request->input('password');
            $users_form->password = Hash::make($password_is);
        }

        
        $user_status_is = $request->input('user_status');
        if(!empty($user_status_is)){
            $users_form->user_status = $request->input('user_status');
        }

        $file = $request->file('user_img');

        if(!empty($file)){
            //$filename = $file->getClientOriginalName();
            $filename = str_shuffle(time().$file->getClientOriginalName()). '.' . $file->getClientOriginalExtension();//ファイル名をユニークするためstr_shuffleを使う
            $move = $file->move('public/upload/users/',$filename);
            
        }else{
            $filename = "";
            if($users_form->user_img == $request->input('user_img_hidden') && $users_form->user_img != null){
                $filename = $request->input('user_img_hidden');
            }
        }
        $users_form->user_img = $filename;





        $users_form->update();
        return redirect('/cms-admin/user/edit/'.$id);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request,$id)
    {
        //$id とリクエストの値が一緒でなければ更新
        if($id != $request->input('user_select')){
            $posts = DB::table('posts')->where('post_user',$id)->update(['post_user' => $request->input('user_select')]);
            $posts = DB::table('fixeds')->where('fixed_user',$id)->update(['fixed_user' => $request->input('user_select')]);
            if($id != Auth::user()->id){
                $users_id = DB::table('users')->delete($id);
            }
        }
      
      
        return redirect('/cms-admin/user/');
    }

    
}
