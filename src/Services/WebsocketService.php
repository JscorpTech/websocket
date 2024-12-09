<?php


namespace JscorpTech\Websocket\Services;


use Exception;
use Predis\Client;

class WebsocketService
{
    public array $groups;

    public function sendGroupMessage(string $group, string $message): void
    {
        ///
    }

    public function addGroup($group, $connection): int
    {
        $this->groups[$group][$connection->id] = $connection;
        return $connection->id;
    }

    public static function sendGroupMessages($group, $data): void
    {
        $redis = new Client([
            "host" => config("websocket.redis.host"),
            "port" => config("websocket.redis.port"),
            "password" => config("websocket.redis.password"),
        ]);
        $redis->rpush("websocket", ["send_message_" . $group . "_$data"]);
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
