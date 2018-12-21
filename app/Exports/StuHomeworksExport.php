<?php

namespace App\Exports;

use App\Models\Classes;
use App\Models\ClassUser;
use App\Models\Homework;
use App\Models\StuHomework;
use App\Models\User;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class StuHomeworksExport implements FromView
//    FromQuery, Responsable, WithMapping, WithHeadings,ShouldAutoSize
{
    use Exportable;
    public $hid;
    public $homework;
    public $users;

    public function __construct(int $hid)
    {
        $homework=Homework::find($hid);
        $this->users=Classes::find($homework->class_id)->student()->with('stuhomeworks')->get();
        $this->hid = $hid;
        $this->homework=$homework;
    }

    public function view(): View
    {
        return view('stu.stuhomework.table', [
            'datas' =>$this->users,
            'homework'=>$this->homework->title,
            'hid'=>$this->hid
        ]);
    }
//    public function headings(): array
//    {
//        return [
//            '#',
//            '姓名',
//            '作业名',
//            '分数',
//            '时间'
//        ];
//    }
//    public function map($stuhomework): array
//    {
//        $user=User::find($stuhomework->user_id);
//        return [
//            $stuhomework->id,
//            $user->name,
//            $this->homework->title,
//            $stuhomework->fraction,
//            $stuhomework->created_at->toDateTimeString(),
//        ];
//    }

//
//    public function query()
//    {
//        return StuHomework::query()->where('homework_id', $this->hid);
//    }

}
