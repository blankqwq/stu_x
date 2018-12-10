<?php

namespace App\Http\Controllers\Stu;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FunctionController extends Controller
{
    public function upload(Request $request)
    {
        $this->validate($request, [
            'myfile' => 'image',
        ]);
        $file = $request->myfile;
        $ret = Storage::disk('public')->putfile('uploads/editer', $file);

        $data=[
            "errno" => 0,
            "data" => [
                '/storage/'.$ret
            ]
        ];
        return json_encode($data);

    }
}
