<?php

namespace App\Http\Controllers\Stu;

use App\Handlers\Util;
use App\Models\Homework;
use App\Models\StuHomework;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StuHomeworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request,$id)
    {
        $homework = Homework::find($id);
        $input['content']= clean($request->input('content'));
        $input['attachment'] = $this->upload($request);
        $input['user_id'] = Auth::id();
        $input['homework_id']=$homework->id;
        try{
            $stuhomework=StuHomework::create($input);

        }catch (\Exception $exception){
            return redirect(route('classes.show',[$homework->classes->id,'tab'=>'fraction']))
                ->with('warnning','已提交请勿重复提交，或者系统异常');
        }
        return redirect(route('classes.show',[$homework->classes->id,'tab'=>'fraction']))
            ->with('success','已提交，等待分数');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stuhomework=StuHomework::find($id);
        return view('stu.stuhomework.show',compact('stuhomework'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $stuhomework=StuHomework::find($id);
        $fraction=$request->input('fraction');
        $comment=$request->input('comment');
        $stuhomework->fraction=$fraction;
        $stuhomework->comment=clean($comment);
        $stuhomework->save();
        $class_id=$stuhomework->homework->classes->id;
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('attachment')) {
            $file = $request->attachment;
            $filename=Auth::user()->name.date("Y/m/d").$file->getClientOriginalName();
            $res = Storage::disk('qiniu')->put($filename, file_get_contents($file->getRealPath()));
            if ($res){
                $ret=Storage::disk('qiniu')->downloadUrl($filename)->setDownload($filename);
                return $ret->geturl();
            }else{
                abort('500');
            }
        }
        return "";
    }
}
