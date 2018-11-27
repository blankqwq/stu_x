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
//        return redirect(route('classes.show',));
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
