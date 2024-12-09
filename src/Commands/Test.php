<?php

namespace JscorpTech\Websocket\Commands;

use Illuminate\Console\Command;
use JscorpTech\Websocket\Services\WebsocketService;
use Workerman\Worker;
use Predis\Client;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jst:websocket-test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test websocket server';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        WebsocketService::sendGroupMessages("default", json_encode([
            "name" => "JscorpTech",
            "email" => "admin@jscorp.com",
            "github" => "JscorpTech",
            "repo" => "https://github.com/JscorpTech/websocket/",
        ]));
    }
}
