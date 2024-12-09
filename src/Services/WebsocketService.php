<?php


namespace JscorpTech\Websocket\Services;


use Exception;
use Predis\Client;

class WebsocketService
{
    public array $groups;

    public function addGroup($group, $connection): int
    {
        $this->groups[$group][$connection->id] = $connection;
        return $connection->id;
    }

    public function sendGroupMessage($group, $data): void
    {
        $redis = new Client([
            "host" => config("websocket.redis.host"),
            "port" => config("websocket.redis.port"),
            "password" => config("websocket.redis.password"),
        ]);
        $redis->rpush("websocket", ["send_message_:_" . $group . "_:_$data"]);
    }

    /**
     * @throws Exception
     */
    public function getGroup($group): array
    {
        return $this->groups[$group] ?? [];
    }

    public function removeGroup($group, $connection): int
    {
        unset($this->groups[$group][$connection->id]);
        return $connection->id;
    }
}
