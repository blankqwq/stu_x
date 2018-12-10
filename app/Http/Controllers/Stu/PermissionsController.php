<?php

namespace App\Http\Controllers\Stu;

use App\Models\Classes;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class PermissionsController extends Controller
{
    public function giveclass($class,$id){
        $this->authorize('manage',Classes::find($class));
        $role=Role::where('name','class'.$class)->first();
        if ($role===null)
            $role=Role::create(['name'=>'class'.$class]);
        if (User::find($id)->hasRole('class'.$class)){
            return "<script>alert('该用户已经为管理员了');window.location.href='/class/$class'</script>";
        }else{
            $user=User::find($id)->assignRole($role);
        }
    }

    public function delclass($class,$id){
        $this->authorize('manage',Classes::find($class));
        $role=Role::where('name','class'.$class)->first();
        if (!User::find($id)->hasRole('class'.$class)){
            return "<script>alert('该用户已经为不是管理员了');window.location.href='/class/$class'</script>";
        }else{
            $user=User::find($id)->removeRole($role);
        }
    }
}
