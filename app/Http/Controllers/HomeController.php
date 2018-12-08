<?php

namespace App\Http\Controllers;

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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $u)
    {
        $user=Auth::user();
        $homework_get = $u->getHomework(Auth::id());
        $classe=$user->classes()->first();
        $stuhomework=$user->stuhomeworks()->first();
        $messages=$user->notification_count;
        $file=$user->files()->count();
        return view('stu.index',compact('user','homework_get','classe','file','messages','stuhomework'));
    }
}
