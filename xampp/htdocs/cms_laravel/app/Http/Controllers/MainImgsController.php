<?php

namespace App\Http\Controllers;
use App\MainImg;
use Illuminate\Support\Facades\DB; //追加
use Illuminate\Support\Facades\Auth; //ユーザー 追加
use Illuminate\Http\Request;

class MainImgsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $title = 'メイン画像設定';
        $main_imgs = DB::table('main_imgs')->get();
        return view('mainimg/index', compact('title','main_imgs'));

    }
    public function upload(Request $request){
        $mainimg_array = $request->input('main');
        if($mainimg_array != ''){
            foreach($mainimg_array as $mainimg){
                $main_img_first = new \App\MainImg;
                $main_img_first->main = $mainimg;
                $main_img_first->save();
            }
        }
       
        

       
        return redirect('/cms-admin/bloginfo/mainimg/');
    }
    public function tmp_file(Request $request){
        
        $file = $request->file('files');
        if(!empty($file)){
            $filename = str_shuffle(time().$file->getClientOriginalName()). '.' . $file->getClientOriginalExtension();//ファイル名をユニークするためstr_shuffleを使う
            $move = $file->move('public/upload/mainimg',$filename);
            return $filename;
        }
    }

    // public function delete(Request $request,MainImg $main){
    //     $main = MainImg::find($request->id);
    //     $main->delete();
    //     //$delete_id = DB::table('main_imgs')->delete($delete);
    //     return $main;
    // }

    public function delete(Request $request,$id){
        
       
        $delete_id = DB::table('main_imgs')->delete($id);
        return $delete_id;
    }

}
