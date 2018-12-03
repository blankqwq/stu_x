<?php

namespace App\Http\Controllers\Stu;

use App\Http\Requests\MessageRequest;
use App\Models\ClassUser;
use App\Models\User;
use App\Notifications\ClassCreate;
use App\Notifications\NewStuJinClass;
use App\Notifications\PersonMessage;
use App\Notifications\TopicReplied;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(){
//        $count_notice=
        $user=Auth::user();
        $count_notice=$user->notifications()->where('type',ClassCreate::class)->where('read_at',null)->count();
        $count_request=$user->notifications()->where('type',NewStuJinClass::class)->where('read_at',null)->count();
        $count_reply=$user->notifications()->where('type',TopicReplied::class)->where('read_at',null)->count();
        $count_pm=$user->notifications()->where('type',PersonMessage::class)->where('read_at',null)->count();

        $user->markAsRead();
        return view('stu.message.index',compact('count_notice','count_reply','count_request','count_pm','user'));
    }


    public function ignore($id){
        return "ok";
    }

    public function store(MessageRequest $request){
        User::find($request->input('user_id'))->notify(new PersonMessage(Auth::user(),
            clean($request->input('content'))));
        return redirect(route('messages.index'))->with('success','发送');
    }
}
