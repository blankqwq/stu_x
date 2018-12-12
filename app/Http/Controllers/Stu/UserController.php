<?php

namespace App\Http\Controllers\Stu;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * 获取当前用户信息
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oneuser=Auth::user();
        return view('stu.user.show', compact('oneuser'));
    }


    /**
     * @param User $oneuser
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $oneuser=User::find($id);
        return view('stu.user.show',compact('oneuser'));
    }


    public function edit(User $user)
    {
        $this->authorize('update',$user);
        //权限判断policy
        return view('stu.user.edit',compact('user'));
    }


    public function update(UserRequest $request,User $user,ImageUploadHandler $upload)
    {
        $this->authorize('update',$user);
        $datas=$request->only('name','sign');
        $id=$user->id;
        if ($request->avatar) {
            $result=$upload->save($request->avatar, 'avatar', $id, 362);
            if ($result)
                $datas['avatar'] = $result['path'];
        }
        $user->update($datas);
        return redirect()->route('users.show',Auth::id())->with('success', '个人资料更新成功！');
    }

    /**
     * 查询界面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchindex(){
        return view('stu.user.search');
    }

    /**
     * 查询的结果集
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request){
        $users=User::where('email','like','%'.$request->input('search').'%')->paginate(15);
        return view('stu.user.table',compact('users'));
    }

    /**
     * 返回资料小卡片
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function small($id){
        $one=User::with('stuhomeworks')->withCount('classes')->find($id);
        return view('stu.user.small',compact('one'));
    }

}
