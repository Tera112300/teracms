<?php

namespace App\Http\Controllers;

use App\Theme;
use Illuminate\Support\Facades\DB; //追加
use Illuminate\Support\Facades\Auth; //ユーザー 追加

use Illuminate\Http\Request;

class ThemesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $title = 'テーマ管理';
        $data = $request->stylesheet;
        $themes_dir = public_path().'/themes/';
       $theme_first = DB::table('themes')->first();
      if( is_readable($themes_dir) ) {
        // ディレクトリ内のファイルを取得
        $themes_files = scandir($themes_dir);
        
        foreach($themes_files as $themes_file) {
            // 「.」「..」以外のファイルと拡張子有りファイル以外を出力
            if( !preg_match( '/^(\.|\.\.)$/', $themes_file) && !preg_match('/(.*)(?:\.([^.]+$))/',$themes_file)) {

            //送られてきたクエリ文字列とファイル名が一緒なら実行
              if($data == $themes_file){
                  //最初の値があれば更新、なければデータ作成
                if(!empty(Theme::first())){
                    $theme_first = Theme::first();
                    $theme_first->cms_name = $data;
                    $theme_first->update();
                }else{
                    $theme_first = new \App\Theme;
                    $theme_first->cms_name = $data;
                    $theme_first->save();
                }
            }

            }
          }

    }

    //設定
    
    

        return view('theme/index', compact('title','themes_files','theme_first'));
    }
    // public function test_dir(){
    //     $title = 'テスト';
    //     return view('test_dir/index', compact('title'));
    // }
}
