<?php

namespace JscorpTech\Websocket\Interfaces;

interface WebsocketInterface
{
    public function onConnect($connection, $service);
    public function onMessage($connection, $message, $service);
    public function onClose($connection, $service);
}
