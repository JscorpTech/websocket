<?php

namespace JscorpTech\Websocket\Handlers;

use JscorpTech\Websocket\Interfaces\WebsocketInterface;

class DefaultHandler implements WebsocketInterface
{
    public function onConnect($connection, $service): void
    {
        $service->addGroup("chat_1", $connection);
        // TODO: Implement onConnect() method.
    }

    public function onMessage($connection, $message, $service): void
    {
        print("new message: $message");
        $service->sendGroupMessage("chat_1", $message);
        // TODO: Implement onMessage() method.
    }

    public function onClose($connection, $service): void
    {
        print("close connection");
        $service->removeGroup("chat_1");
    }
}
