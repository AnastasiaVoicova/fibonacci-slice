<?php

namespace App\Modules\Fibonacci\Services;

use Illuminate\Redis\RedisManager;

class FibonacciStorage
{
    private const KEY = 'fibonacci_sequence';
    private RedisManager $redisManager;

    public function __construct(RedisManager $redisManager)
    {
        $this->redisManager = $redisManager;
    }

    public function zrange(int $min, int $max)
    {
        return $this->redisManager->zrange(self::KEY, $min, $max, true);
    }

    public function zrevrange(int $min, int $max)
    {
        return $this->redisManager->zrevrange(self::KEY, $min, $max, true);
    }

    public function zadd(array $value): void
    {
        $this->redisManager->zadd(self::KEY, $value);
    }
}
