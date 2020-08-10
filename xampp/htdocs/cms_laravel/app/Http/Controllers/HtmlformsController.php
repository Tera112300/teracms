<?php

namespace App\Http\Controllers;
use App\Htmlform;
use Illuminate\Support\Facades\DB; //追加
use Illuminate\Support\Facades\Auth; //ユーザー 追加
use Illuminate\Http\Request;

class HtmlformsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index (Request $request)
    {
    $title = 'フォーム';

    $data = $request->message;
    $table_search = $request->input('table_search');
    $query = Htmlform::query();
    if(!empty($table_search)){
        $query->where('form_title', 'LIKE', "%{$table_search}%");
    }
    $forms = $query->orderBy('id', 'desc')->paginate(10);
    
    return view('form/index', compact('title','forms','data'));

    }

    public function create ()
    {
    $title = 'フォーム新規作成';
    return view('form/create', compact('title'));
    }

    public function create_post(Request $request){
        $validate_rule = [
            'form_title' => 'required',
            'action' => 'required|url',
        ];
        $this->validate($request,$validate_rule);

        $form = new \App\Htmlform;
        $form->form_title = $request->input('form_title');
        $form->action = $request->input('action');
        $form->html_tag = $request->input('html_tag');
        $form->save();
        return redirect('/cms-admin/form/');
    }

    public function edit($id)
    {
        $title = 'フォーム編集';
        $forms_id = DB::table('htmlforms')->find($id);
        return view('form/edit', compact('title','forms_id'));
    }

    public function update(Request $request,$id)
    {
        $validate_rule = [
            'form_title' => 'required',
            'action' => 'required|url',
        ];
        $this->validate($request,$validate_rule);

        $forms_id = DB::table('htmlforms')->find($id);
        $forms_form = Htmlform::find($request->id);
        $forms_form->form_title = $request->input('form_title');
        $forms_form->action = $request->input('action');
        $forms_form->html_tag = $request->input('html_tag');

        $forms_form->update();
        return redirect('/cms-admin/form/edit/'.$id);
        
    }



    public function destroy($id)
    {
        $posts_id = DB::table('htmlforms')->delete($id);
        return redirect('/cms-admin/form/');
    }

    public function destroy_all()
    {
        $posts_id = DB::table('htmlforms')->delete();
        return redirect('/cms-admin/form/');
    }


}
