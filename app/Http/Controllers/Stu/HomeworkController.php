<?php

namespace App\Http\Controllers\Stu;

use App\Models\Classes;
use App\Models\Homework;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeworkController extends Controller
{
    public function gettime($time){
        $time = explode(' - ', $time);
        $start_time = date('Y-m-d H:i:s ', strtotime($time[0]));
        $stop_time = date('Y-m-d H:i:s ', strtotime($time[1]));
        if ($start_time == $stop_time)
            $stop_time = date('Y-m-d H:i:s', strtotime($start_time . '+24 hours'));
        return [
            'start_time'=>$start_time,
            'stop_time'=>$stop_time
        ];
    }

    /**
     * 创建作业
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store($id,Request $request)
    {
        $classe=Classes::find($id);
        $time=$this->gettime($request->input('time'));
        $data = [
            'title' => $request->input('title'),
            'content' => clean($request->input('content')),
            'start_time' => $time['start_time'],
            'stop_time' => $time['stop_time'],
            'class_id' => $id,
            'teacher_id'=>Auth::id(),
        ];
        Homework::create($data);
        return redirect(route('classes.show',$id))->with('success','发布成功');
    }

    /***
     * 获取作业
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id)
    {
        $this->authorize('view',Homework::find($id));
        $homework=Homework::with('publisher','classes','posters')->find($id);
        return view('stu.homework.show',compact('homework'));
    }

    /**
     * 获取修改作业
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id)
    {
        $this->authorize('update',Homework::find($id));
        $homework=Homework::with('publisher','classes','posters')->find($id);
        return view('stu.homework.edit',compact('homework'));

    }

    /**
     * 获取作业
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update',$id);
        $homework=Homework::find($id);
        $time=$this->gettime($request->input('time'));
        $data = [
            'title' => $request->input('title'),
            'content' => clean($request->input('content')),
            'start_time' => $time['start_time'],
            'stop_time' => $time['stop_time'],
            'teacher_id'=>Auth::id(),
        ];
        $homework->update($data);
        return redirect(route('classes.show',[$homework->class_id,'tab'=>'homework']))->with('success','修改成功');
    }

    /**
     * 批改作业
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function correct($id){
        $this->authorize('correct',Homework::find($id));
        $stuhomeworks=Homework::find($id)->posters()->with('homework')->paginate(15);
        return view('stu.homework.correct',compact('stuhomeworks'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     */
    public function destroy($id,Request $request)
    {
        $this->authorize('destroy',$id);
        $this->validate($request, [
            'ids.*' => 'required|exists:homeworks,id',
        ]);
        $classe = Classes::find($id);
        $ids = $request->input('ids');
        try {
            $classe->homeworks()->delete($ids);
        } catch (\Exception $exception) {
            return redirect(route('classes.show', [$classe->id, 'tab' => 'homework']))->with('error','发生错误');
        }
        return redirect(route('classes.show', [$classe->id, 'tab' => 'homework']))->with('success','删除成功');

    }
}
