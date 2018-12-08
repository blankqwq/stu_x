<?php

namespace App\Http\Controllers\Stu;

use App\Models\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = Auth::user()->files()->where('path', '0')->paginate(15);
        return view('stu.file.index', compact('files'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storefile($id, Request $request)
    {

        $file=File::find($id);
        if ($file) {
            $input['pid']=$id;
            $input['path']=$file->path.'/'.$input['pid'];
        }else{
            $input['pid']=$id;
            $input['path']='0';
        }
        $input['type']='1';
        $wenjian=$request->file;
        $input['name']=$wenjian->getClientOriginalName();
        $res = Storage::disk('qiniu')->put( $input['name'], file_get_contents($wenjian->getRealPath()));
        if ($res)
            $input['url'] = Storage::disk('qiniu')->downloadUrl($input['name'])->setDownload($input['name']);
        else{
            abort('500');
        }
        Auth::user()->files()->create($input);
        if ($id!=0)
            return redirect(url('/files',$id));
        else
            return redirect('/files');

    }

    public function storefolder($id, Request $request)
    {
        $input = $request->only('name');
        $file=File::find($id);
        if ($file) {
            $input['pid']=$id;
            $input['path']=$file->path.'/'.$input['pid'];
        }else{
            $input['pid']=$id;
            $input['path']='0';
        }
        $input['url']='';
        Auth::user()->files()->create($input);
        if ($id!=0)
            return redirect(url('/files',$id));
        else
            return redirect(route('files.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $files = File::where('pid', $id)->paginate(15);
        $parent=File::find($id)->pid;
        return view('stu.file.index', compact('files', 'id','parent'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->validate($request, [
            'ids.*' => 'required|exists:files,id',
        ]);
        $ids = $request->input('ids');
        try{
            foreach ($ids as $id){
                if (Auth::user()->files()->find($id)){
                    Auth::user()->files()->find($id)->delete();
                    File::where('path','like','%'.$id.'%')->delete();
                }
            }
            return redirect('/files');
        }catch (\Exception $exception){
            abort('400');
        }

    }

    public function classfile(){
        $classes=Auth::user()->classes()->with('creator','homeworks')->paginate(15);
        return view('stu.file.classes',compact('classes'));
    }
}
