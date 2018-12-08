<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CalculateHomework extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stu:cache-homework';

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
    public function handle(User $user)
    {
        $this->info("开始计算...");

        $user->caculateAllHomework();

        $this->info("成功生成！");
    }
}
