<?php

namespace App\Console\Commands;

use App\Models\Homework;
use Illuminate\Console\Command;

class CaculateFractionAvg extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stu:cache-fraction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Homework $homework)
    {
        $this->info("开始计算...");

        $homework->caculateAllFraction();

        $this->info("成功生成！");
    }
}
