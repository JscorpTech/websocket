<?php

namespace JscorpTech\Websocket\Commands;

use Illuminate\Console\Command;
use JscorpTech\Websocket\Services\WebsocketService;
use JscorpTech\Websocket\Services\WorkerService;
use Workerman\Worker;
use Predis\Client;
use Workerman\Timer;

class Websocket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jst:websocket {}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run websocket server';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $service = new WorkerService();
        $service->run();
    }
}
