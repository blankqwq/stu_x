<?php

namespace App\Http\Controllers;

use App\Models\Homework;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>'index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home(User $u,Homework $homework)
    {
        $user=Auth::user();
        $homework_get = $u->getHomework(Auth::id());
        $classe=$user->classes()->first();
        $stuhomework=$user->stuhomeworks()->orderby('updated_at','Desc')->first();
        $messages=$user->notification_count;
        $file=$user->files()->count();
        $stuhomeworks=$user->stuhomeworks()->with('homework')->orderby('updated_at','Desc')->take(6)->get();
        return view('stu.index',compact('user','homework_get',
            'classe','file','messages','stuhomework','homework','stuhomeworks'));
    }

    public function index(){
        return view('welcome');
    }
}
