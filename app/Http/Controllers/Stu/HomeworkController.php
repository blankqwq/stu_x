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
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * 保存
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

    /**
     * Display the specified resource.
     *  展示作业
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $homework=Homework::with('publisher','classes','posters')->find($id);
        return view('stu.homework.show',compact('homework'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $homework=Homework::with('publisher','classes','posters')->find($id);
        return view('stu.homework.edit',compact('homework'));

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
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function correct($id){
        $stuhomeworks=Homework::find($id)->posters()->with('homework')->paginate(15);
        return view('stu.homework.correct',compact('stuhomeworks'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
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
