<?php

namespace JscorpTech\Websocket\Services;

use JscorpTech\Websocket\Handlers\DefaultHandler;
use Predis\Client;
use Workerman\Timer;
use Workerman\Worker;

class WorkerService
{
    public function run(): void
    {
        $handler = new (config('websocket.handler', DefaultHandler::class))();
        $port = config('websocket.port', 8000);
        $host = config('websocket.host', '127.0.0.1');

        $worker = new Worker(socket_name: "websocket://$host:$port");
        $service = new WebsocketService();
        $worker->onWebSocketConnect = function ($connection, $header) use ($service, $handler) {
            $connection->params = $_GET;
            $handler->onConnect($connection, $service);
            $service->addGroup("all", $connection);
        };
        $worker->onMessage = function ($connection, $data) use ($handler, $service) {
            $handler->onMessage($connection, $data, $service);
        };
        $worker->onClose = function ($connection) use ($service, $handler) {
            $service->removeGroup("all", $connection);
            $handler->onClose($connection, $service);
        };
        $worker->onWorkerStart = function () use ($service) {
            $redis_config = config('websocket.redis');
            $redis = new Client([
                "host" => $redis_config['host'],
                "port" => $redis_config['port'],
                "password" => $redis_config['password'] ?? null,
            ]);
            Timer::add(0.1, function () use ($redis, $service) {
                $data = $redis->rpop(config("websocket.redis.channel", "websocket"));
                if ($data) {
                    preg_match("/^(.*)_:_(.*)_:_(.*)$/", $data, $matches);
                    $action = $matches[1];
                    $group = $matches[2];
                    $message = $matches[3];
                    if ($action == "send_message") {
                        foreach ($service->getGroup($group) as $connection) {
                            try {
                                $connection->send($message);
                            } catch (\Exception $exception) {
                                print_r($exception->getMessage());
                            }
                        }
                    }
                }
            });
        };
        Worker::runAll();
    }
}
