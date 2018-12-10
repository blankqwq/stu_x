<?php

namespace App\Http\Controllers\Stu;

use App\Console\Commands\ChartWServer;
use App\Handlers\ImageUploadHandler;
use App\Http\Requests\ClassRequest;
use App\Models\Classes;
use App\Models\ClassType;
use App\Models\TopicType;
use App\Models\User;
use App\WebSocket\Ws;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     * 全部班级
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classes::where('user_allow', '>', '0')->with('type', 'creator')->paginate(15);
        return view('stu.class.index', compact('classes'));
    }

    /**
     * 小型class信息
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function smallshow($id){
        $classe = Classes::with('type', 'creator')->find($id);
        if (!$classe)
            return "<h3>null</h3>";
        $types = ClassType::all();
        return view('stu.class.small', compact('classe', 'types'));

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 获取我创建的班级
     */
    public function my()
    {
        $classes = Classes::where('user_id', Auth::id())->with('type', 'creator')->paginate(15);
        return view('stu.class.index', compact('classes'));
    }

    /**
     * 获取我加入的班级
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function me(){
        $classes = User::find(Auth::id())->classes()->withPivot('created_at')->with('type', 'creator')->paginate(15);;
        return view('stu.class.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *  创建页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = ClassType::all();
        return view('stu.class.create',compact('types'));
    }

    /**
     * 保存
     * @param ClassRequest $request
     * @param ImageUploadHandler $upload
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ClassRequest $request,ImageUploadHandler $upload)
    {
        $input = $request->only('name', 'password', 'verification','type_id');
        if ($request->avatar) {
            $reslut=$upload->save($request->avatar,'class',str_random(5),362);
            $input['avatar'] = $reslut['path'];
        }
        $input['numbers']=1;
        $input['user_id']=Auth::id();
        Classes::create($input);
        return redirect(route('classes.my'))->with('success','创建成功');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id)
    {

        $classe=Classes::with('creator','type')->where('user_allow','>',0)->find($id);
        //判断权限
        if (!$classe)
           return redirect(route('classes.my'))->with('danger','该班级未通过审核或不存在');
        $this->authorize('view',$classe);
        $types=TopicType::where('is_main',false)->get();
        $count_homework=Classes::find($id)->homeworks()->count();
        $count_notice=Classes::find($id)->notices()->count();
        $count_need=Classes::find($id)->needs()->count();
        return view('stu.classhome.index',compact('classe','count_need','count_notice','count_homework','types'));
    }


    /**
     * 更新用户信息
     * @param ClassRequest $request
     * @param $id
     * @param ImageUploadHandler $upload
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ClassRequest $request, $id,ImageUploadHandler $upload)
    {
        $input = $request->only('name', 'password', 'verification');
        if ($request->avatar) {
            $reslut=$upload->save($request->avatar,'class',str_random(5),362);
            $input['avatar'] = $reslut['path'];
        }
        Classes::find($id)->update($input);
        return redirect(route('classes.my'))->with('更改成功');
    }

    /**
     * 班级下的学生
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function users($id){
        $users=Classes::find($id)->student()->paginate(15);
        return view('stu.user.table',compact('users','id'));
    }

    /**
     * 获取未授权的班级
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function verify(){
        $classes = Classes::with('type', 'creator')->where('user_allow', '=', null)
            ->orWhere('user_allow', '=', "0")->paginate(15);
        return view('stu.class.verify', compact('classes'));
    }

    /**
     * 获取已被授权的班级
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getagree(){
        $classes = Classes::with('type', 'creator')->where('user_allow', '>', 0)
            ->paginate(15);
        return view('stu.class.verify', compact('classes'));
    }

    /**
     * 获取拒绝授权的班级
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getdisagree(){
        $classes = Classes::with('type', 'creator')->where('user_allow', '=', 0)
            ->paginate(15);
        return view('stu.class.verify', compact('classes'));
    }


    /**
     * 同意审批班级
     * @param $id
     * @param Request $request
     * @return string
     */
    public function agree(Request $request,$id,$message=null){

        $classe = Classes::find($id);
        $classe->update(['user_allow' => Auth::id()]);
        if ($message!="")
            Auth::user()->unreadNotifications()->where('id',$message)->update(['read_at' => Carbon::now()]);
        return "1";
    }

    /**
     * @param $id
     * @param null $message
     * @param Request $request
     * @return string
     */
    public function disagree(Request $request,$id,$message=null){
        try {
            $classe = Classes::find($id);
            $classe->update(['user_allow' => 0]);

            if ($message!="")
                Auth::user()->unreadNotifications()->where('id',$message)->update(['read_at' => Carbon::now()]);
        } catch (\Exception $exception) {
            return "0";
        }
        return "1";
    }


    /**
     * 清除不需要的人
     * @param $id
     * @param Request $request
     * @return string
     */
    public function deleteuser($id, Request $request)
    {
        $this->validate($request, [
            'ids.*' => 'required|exists:classes,id',
        ]);
        $classe = Classes::find($id);
        $ids = $request->input('ids');
        $classe->users()->detach($ids);
        return "1";
    }


}
