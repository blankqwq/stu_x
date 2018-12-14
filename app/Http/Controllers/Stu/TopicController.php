<?php

namespace App\Http\Controllers\Stu;

use App\Handlers\FileUploadHandler;
use App\Http\Requests\TopicRequest;
use App\Models\Classes;
use App\Models\Topic;
use App\Models\TopicType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    /**
     * @param $id
     * @param TopicRequest $request
     * @param FileUploadHandler $upload
     * @return \Illuminate\Http\RedirectResponse
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
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id)
    {
        $topic=Topic::with('replies','sender','type')->find($id);
        $this->authorize('view',Topic::find($id));
        return view('stu.topic.show',compact('topic'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id)
    {
        $topic=Topic::with('type','sender')->find($id);
        $types=TopicType::where('is_main',false)->get();
        $this->authorize('update',$topic);
        return view('stu.topic.edit',compact('topic','types'));
    }

    /**
     * @param TopicRequest $request
     * @param $id
     * @param FileUploadHandler $upload
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(TopicRequest $request,Topic $topic,FileUploadHandler $upload)
    {
        $this->authorize('update',$topic);
        $input=$request->only('title','type_id','content','can_reply','level');
        if ($request->attachment){
            $result=$upload->save($request->attachment,'attach',Auth::id());
            if ($result){
                $input['att_name']=$result['name'];
                $input['att_url']=$result['path'];
            }
        }
        $input['content']=clean($input['content']);
        $topic->update($input);
        return redirect(route('classes.show',$topic->class_id))->with('success','修改成功');

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * 删除文章
     */
    public function destroy(Request $request)
    {
        $this->validate($request, [
            'ids.*' => 'required|exists:topics,id',
        ]);
        $ids=$request->input('ids');
        foreach ($ids as $id){
            $topic=Topic::find($id);
           if ( Auth::user()->can('update',$topic))
                $topic->destroy($id);
        }
        return redirect()->back();
        //权限判定

    }



}
