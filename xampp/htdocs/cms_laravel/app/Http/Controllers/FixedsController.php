<?php

namespace App\Http\Controllers;
use App\Fixed;
use Illuminate\Support\Facades\DB; //追加
use Illuminate\Support\Facades\Auth; //ユーザー 追加
use Illuminate\Http\Request;

class FixedsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index (Request $request)
    {
    //$fixeds = DB::table('fixeds')->get();
    //$fixeds = DB::table('fixeds')->paginate(2);
    $title = '固定ページ一覧';

    $data = $request->message;
    $table_search = $request->input('table_search');
    $query = Fixed::query();
    if(!empty($table_search)){
        $query->where('fixed_title', 'LIKE', "%{$table_search}%")->orWhere('fixed_user', 'LIKE', "%{$table_search}%");
    }
    $fixeds = $query->orderBy('id', 'desc')->paginate(10);
    $users = DB::table('users');
    //return view('fixed/index', ['fixeds' => $fixeds]);
    //return view('fixed/index', compact('title','fixeds','data','search'));  
    return view('fixed/index', compact('title','fixeds','data','users'));  
    }
    public function create()
    {
        $title = '固定ページ新規作成';
        $users = DB::table('users');
        return view('fixed/create', compact('title','users'));
    }

    public function create_post(Request $request){
        $validate_rule = [
            'fixed_title' => 'required',
            'fixed_excerpt' => 'between:30,110',
            'fixed_guid' => 'image',
            'fixed_url' => 'required',
            'fixed_user'=> 'required',
            //'fixed_guid' => 'mimes:jpg,png,gif',
        ];
        $this->validate($request,$validate_rule);

        $fixed = new \App\Fixed;
        $fixed->fixed_title = $request->input('fixed_title');
        $fixed->fixed_content = $request->input('fixed_content');
        $fixed->fixed_excerpt = $request->input('fixed_excerpt');
        $fixed->fixed_url = $request->input('fixed_url');
        $fixed->fixed_status = $request->input('fixed_status');

        

        $file = $request->file('fixed_guid');
        
        $fixed_guid_hidden = $request->input('fixed_guid_hidden');
        if(!empty($file)){
            $filename = str_shuffle(time().$file->getClientOriginalName()). '.' . $file->getClientOriginalExtension();//ファイル名をユニークするためstr_shuffleを使う
            if(empty($fixed_guid_hidden)){
                $filename = "";
            }else{
                $move = $file->move('public/upload/',$filename);
            }
        }else{
            $filename = "";
        }
        $fixed->fixed_guid = $filename;


        $fixed->fixed_user = $request->input('fixed_user');
        $fixed->seo_title = $request->input('seo_title');
        $fixed->meta_description = $request->input('meta_description');
        $fixed->meta_keywords = $request->input('meta_keywords');
        $fixed->save();
      
        return redirect('/cms-admin/fixed/');
    }

    public function store(Request $request)
    {
        //
    }
   
    public function show($id)
    {
        $title = '表示';
        //$fixeds_id = DB::table('fixeds')->find($id);
        $fixeds_id = DB::table('fixeds')->find($id);
        $users_id = DB::table('users')->find($fixeds_id->fixed_user);
        return view('fixed/show', compact('title','fixeds_id','users_id'));
    }

    public function edit($id)
    {
        $title = '編集';
        $fixeds_id = DB::table('fixeds')->find($id);
        $users = DB::table('users');
        return view('fixed/edit', compact('title','fixeds_id','users'));
    }

    public function update(Request $request,$id)
    {
        $validate_rule = [
            'fixed_title' => 'required',
            'fixed_excerpt' => 'between:30,110',
            'fixed_guid' => 'image',
            'fixed_url' => 'required',
            'fixed_user'=> 'required',
            //'fixed_guid' => 'mimes:jpg,png,gif',
        ];
        $this->validate($request,$validate_rule);

        $fixeds_id = DB::table('fixeds')->find($id);
        
        $fixeds_form = Fixed::find($request->id);
        $fixeds_form->fixed_title = $request->input('fixed_title');
        $fixeds_form->fixed_content = $request->input('fixed_content');
        $fixeds_form->fixed_excerpt = $request->input('fixed_excerpt');
        $fixeds_form->fixed_url = $request->input('fixed_url');
        $fixeds_form->fixed_status = $request->input('fixed_status');

        $fixeds_form->fixed_user = $request->input('fixed_user');

        //エラー$fixeds_form->fixed_guid = $request->input('fixed_guid');

        $file = $request->file('fixed_guid');
        
        if(!empty($file)){
            //$filename = $file->getClientOriginalName();
            $filename = str_shuffle(time().$file->getClientOriginalName()). '.' . $file->getClientOriginalExtension();//ファイル名をユニークするためstr_shuffleを使う
            $move = $file->move('public/upload/',$filename);
            
        }else{
            $filename = "";
            if($fixeds_id->fixed_guid == $request->input('fixed_guid_hidden') && $fixeds_id->fixed_guid != null){
                $filename = $request->input('fixed_guid_hidden');
            }
        }
        $fixeds_form->fixed_guid = $filename;
        


        $fixeds_form->seo_title = $request->input('seo_title');

        $fixeds_form->seo_title = $request->input('seo_title');
        $fixeds_form->meta_description = $request->input('meta_description');
        $fixeds_form->meta_keywords = $request->input('meta_keywords');

        $fixeds_form->update();
        return redirect('/cms-admin/fixed/edit/'.$id);
        
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
        $fixeds_id = DB::table('fixeds')->delete($id);
        return redirect('/cms-admin/fixed/');
    }

    public function destroy_all()
    {
        //
        $fixeds_id = DB::table('fixeds')->delete();
        return redirect('/cms-admin/fixed/');
    }

}
