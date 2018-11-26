<?php

namespace App\Http\Controllers\Stu;

use App\Models\Classes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassHomeController extends Controller
{
    public function index($id){
//        ->withCount('messages')
        $classe=Classes::with('boss','types')->find($id);
        if (!$classe)
            abort('404','无班级');
        $homecount=Classes::find($id)->homeworks()->count();
        $gongaocount=Classes::find($id)->messages()->where('type_id','1')->count();
        $xuqiucount=Classes::find($id)->messages()->where('type_id','2')->count();
        $messages=Classes::find($id)->messages()->with('sender')->where('type_id','1')->orderby('created_at','desc')->paginate(15);
        return view('stu.classhome.index',compact('classe','messages','gongaocount','xuqiucount','homecount'));
    }
}
