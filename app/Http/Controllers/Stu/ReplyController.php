<?php

namespace App\Http\Controllers\Stu;

use App\Http\Requests\ReplyRequest;
use App\Models\Replies;
use App\Notifications\TopicReplied;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReplyRequest $request)
    {
        $data=$request->only('topic_id','content');
        $data['user_id']=Auth::id();
        $data['pid']=0;
        Replies::create($data);
        return redirect()->back()->with('success','评论成功');
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
        //
    }

    /**
     * @param Replies $replies
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Replies $replies)
    {
       $this->authorize('delete',$replies);
       $replies->delete();
        return redirect()->back()->with('success','删除成功');
    }
}
