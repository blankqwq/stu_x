<?php

namespace App\Http\Controllers\Stu;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\ClassRequest;
use App\Models\Classes;
use App\Models\ClassType;
use App\Models\TopicType;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
     * Display the specified resource.
     *  展现班级的模块
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $classe=Classes::with('creator','type')->find($id);
        if (!$classe)
            abort('404','无班级');
        $types=TopicType::all();
        $count_homework=Classes::find($id)->homeworks()->count();
        $count_notice=Classes::find($id)->notices()->count();
        $count_need=Classes::find($id)->needs()->count();

        return view('stu.classhome.index',compact('classe','count_need','count_notice','count_homework','types'));
    }

    /**
     * Show the form for editing the specified resource.
     *  编辑班级信息
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function edit(Classes $classe)
//    {
//        //
//    }

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

    public function users($id){
        $users=Classes::find($id)->student()->paginate(15);
        return view('stu.user.table',compact('users'));
    }


}
