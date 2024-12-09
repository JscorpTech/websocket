<?php

use JscorpTech\Websocket\Handlers\DefaultHandler;

return [
    "handler" => DefaultHandler::class,
    "host" => "0.0.0.0",
    "port" => 9501,
    "redis" => [
        "host" => "127.0.0.1",
        "port" => 6379,
        "password" => null,
    ]
];
