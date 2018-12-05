<?php

namespace App\Console\Commands;

use App\WebSocket\Ws;
use Illuminate\Console\Command;

class ChartWServer extends Command
{
    public static $ws;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ws:chart-start';

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
    public function handle()
    {
        Ws::instance()->ws;
    }
}
