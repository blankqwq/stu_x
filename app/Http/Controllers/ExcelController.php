<?php

namespace App\Http\Controllers;

use App\Exports\StuHomeworksExport;
use App\Models\Homework;
use Illuminate\Http\Request;
use \Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    //

    public function exportHomework(Homework $homework){
        return Excel::download(new StuHomeworksExport($homework->id),$homework->title.'数据.xlsx');
    }
}
