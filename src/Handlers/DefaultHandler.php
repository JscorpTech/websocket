<?php

namespace JscorpTech\Websocket\Handlers;

use JscorpTech\Websocket\Interfaces\WebsocketInterface;

class DefaultHandler implements WebsocketInterface
{
    public function onConnect($connection, $service): void
    {
        $service->addGroup($connection->params['chat_id'], $connection);
        // TODO: Implement onConnect() method.
    }

    public function onMessage($connection, $message, $service): void
    {
        print("new message: $message");
        $service->sendGroupMessage($connection->params['chat_id'], $message);
        // TODO: Implement onMessage() method.
    }

    public function onClose($connection, $service): void
    {
        print("close connection");
        $service->removeGroup($connection->params['chat_id'], $connection);
    }
}
