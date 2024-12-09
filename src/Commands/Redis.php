<?php

namespace JscorpTech\Websocket\Commands;

use Illuminate\Console\Command;
use JscorpTech\Websocket\Services\WebsocketService;
use Workerman\Worker;
use Predis\Client;

class Redis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jst:redis';

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
        WebsocketService::sendGroupMessages("default", json_encode([
            "name" => "Samandar"
        ]));
    }
}
