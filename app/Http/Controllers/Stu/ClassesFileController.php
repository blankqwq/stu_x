<?php

namespace App\Http\Controllers\Stu;

use App\Models\Classes;
use App\Models\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ClassesFileController extends Controller
{
    public function storefolder($id,$file,Request $request){
        $fileid=$file;
        $input = $request->only('name');
        $classfile=Classes::find($id)->files()->find($fileid);
        if ($classfile) {
            $input['pid']=$fileid;
            $input['path']=$classfile->path.'/'.$input['pid'];
        }else{
            $input['pid']=$fileid;
            $input['path']='0';
        }
        $input['url']='';
        Classes::find($id)->files()->create($input);
        return redirect(route('classes.show', [$id, 'tab' => 'file']));
    }

    public function storefile($id,$file,Request $request){
        $fileid=$file;
        $classfile=Classes::find($id)->files()->find($fileid);
        if ($file) {
            $input['pid']=$fileid;
            $input['path']=$classfile->path.'/'.$input['pid'];
        }else{
            $input['pid']=$fileid;
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
        Classes::find($id)->files()->create($input);
        return redirect(route('classes.show', [$id, 'tab' => 'file']));
    }

    public function show($id,$file){
        $classe=Classes::with('creator','type')->find($id);
        //判断权限
        $fileid=$file;
        $this->authorize('view',$classe);
        $files=Classes::find($id)->files()->where('pid', $file)->paginate(15);
        $parent=File::find($file)->pid;
        return view('stu.classhome._file',compact('classe','fileid','files','parent'));
    }

    public function destroy($id,Request $request){
        $this->validate($request, [
            'ids.*' => 'required|exists:files,id',
        ]);
        $ids = $request->input('ids');
        try{
            foreach ($ids as $fid){
                if (Classes::find($id)->files()->find($fid)){
                    Classes::find($id)->files()->find($fid)->delete();
                    File::where('path','like','%'.$fid.'%')->delete();
                }
            }
            return redirect('/classhome/'.$id.'/file.html');
        }catch (\Exception $exception){
            abort('400');
        }
    }
}
