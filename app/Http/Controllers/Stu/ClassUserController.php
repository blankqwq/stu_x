<?php

namespace App\Http\Controllers\Stu;

use App\Http\Requests\ClassUserRequest;
use App\Models\Classes;
use App\Models\ClassUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClassUserController extends Controller
{

    /**
     * 获取所有的申请列表
     */
    public function index(Request $request){

        return "";
    }

    /**
     * Show the form for creating a new resource.
     *  加入班级
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $classe = Classes::where('user_allow', '>', 0)->find($id);
        if ($classe){
            if (Auth::user()->classes()->find($id))
                return redirect(route('classes.show',$id))->with('success','你已加入该团体');
            return view('stu.class.join', compact('classe'));
        }
        else
            return redirect(route('classes.index'))->with('danger','该团体为经过审核');
    }

    /**
     * 申请加入班级
     * @param $id
     * @param ClassUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($id,ClassUserRequest $request)
    {
        $classe=Classes::find($id);
        $data['class_id']=$classe->id;
        $data['user_id']=Auth::id();
        if ($classe->verification)
            $data['token']=$request->input('content');
        else
            $data['token']=null;
        if (!empty($classe->password)){
            if ($classe->password !== $request->input('password'))
                return redirect(route('classuser.create',$id))->with('danger','密码错误');
        }
        ClassUser::create($data);
        return redirect(route('classes.joining',$id))->with('success','申请成功');
    }


    /**
     * @param Request $request
     * @param $id
     * @param $message
     * @return string
     */
    public function agree($id,$message,Request $request)
    {
        $data=ClassUser::Where('token','<>',null)->where('id',$id)->first();
        $data->token=null;
        $data->save();
        if ($message!="")
            Auth::user()->unreadNotifications()->where('id',$message)->update(['read_at' => Carbon::now()]);
        return "1";

    }


    /**
     * @param Request $request
     * @param $id
     * @param $message
     * @return string
     */
    public function disagree( $id,$message,Request $request)
    {
        $data=ClassUser::where('token','<>',null)->where('id',$id)->first();
        $data->update(['token'=>0]);
        if ($message!="")
            Auth::user()->unreadNotifications()->where('id',$message)->update(['read_at' => Carbon::now()]);
        return "1";
    }

    /**
     * Remove the specified resource from storage.
     * 删除学生
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
