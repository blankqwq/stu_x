<?php

namespace App\Http\Controllers\Stu;

use App\Handlers\FileUploadHandler;
use App\Http\Requests\TopicRequest;
use App\Models\Classes;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *  保存topic
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id,TopicRequest $request,FileUploadHandler $upload)
    {
        //权限保存
        $input=$request->only('title','type_id','content','can_reply','level');
        $input['user_id']=Auth::id();
        $input['class_id']=$id;
        if ($request->attachment){
            $result=$upload->save($request->attachment,'attach',Auth::id());
            if ($result){
                $input['att_name']=$result['name'];
                $input['att_url']=$result['path'];
            }
        }
        $input['content']=clean($input['content']);
        Topic::create($input);
        return redirect(route('classes.show',$id))->with('success','发布成功');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //权限判定
        $topic=Topic::with('replies','sender','type')->find($id);
        return view('stu.topic.show',compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     *  编辑topic
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //权限判定
        $topic=Topic::with('type','')->find($id);
        return view('stu.topic.edit',compact('topic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TopicRequest $request,$id,FileUploadHandler $upload)
    {
        //权限判定
        $input=$request->only('title','type_id','content','can_reply','level');
        $input['user_id']=Auth::id();
        $input['class_id']=$id;
        if ($request->attachment){
            $result=$upload->save($request->attachment,'attach',Auth::id());
            if ($result){
                $input['att_name']=$result['name'];
                $input['att_url']=$result['path'];
            }
        }
        $input['content']=clean($input['content']);
        Topic::find($id)->update($input);
        return redirect(route('classes.show',$id))->with('success','修改成功');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //权限判定

    }
}
