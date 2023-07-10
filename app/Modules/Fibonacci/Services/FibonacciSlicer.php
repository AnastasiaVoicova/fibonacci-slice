<?php

namespace App\Modules\Fibonacci\Services;

class FibonacciSlicer
{
    public function __construct(private FibonacciStorage $fibonacciStorage)
    {
    }

    public function getSlice(int $from, int $to): array
    {
        $sequenceSlice = $this->getFromCache($from, $to);

        if ($this->isFullSequence($sequenceSlice, $from, $to)) {
            return $sequenceSlice;
        }

        return $this->fillSequence($sequenceSlice, $from, $to);
    }

    private function isFullSequence(array $sequenceSlice, int $from, int $to): bool
    {
        $sliceLength = count($sequenceSlice);

        return $to - $from < $sliceLength;
    }

    private function fillSequence(array $sequenceSlice, int $from, int $to): array
    {
        $lastTwoElementsInCache = $this->fibonacciStorage->zrevrange(0, 1);

        if (empty($lastTwoElementsInCache)) {
            return array_slice($this->calculateSequence(2, $to, 0, 1, [0, 1]), $from);
        }

        [$second, $first] = array_values($lastTwoElementsInCache);
        $maxIdInCache = array_key_first($lastTwoElementsInCache);

        $fibonacciSequence = $this->calculateSequence($maxIdInCache + 1, $to, $first, $second, $sequenceSlice);
        $this->setToCache($fibonacciSequence);
        $index = $this->calculateFirstIndexOfResultSequence($sequenceSlice, $from, $maxIdInCache + 1);

        return array_slice($fibonacciSequence, $index);
    }

    private function getFromCache(int $from, int $to): array
    {
        return array_map('intval', $this->fibonacciStorage->zrange($from, $to));
    }

    private function setToCache(array $fibonacciSubsequence)
    {
        $this->fibonacciStorage->zadd($fibonacciSubsequence);
    }

    private function calculateSequence(int $start, int $to, int $first, int $second, array $fibonacciSequence): array
    {
        for ($i = $start; $i <= $to; $i++) {
            $fibonacciSequence[$i] = $first + $second;
            $first = $second;
            $second = $fibonacciSequence[$i];
        }

        $this->setToCache($fibonacciSequence);

        return $fibonacciSequence;
    }

    private function calculateFirstIndexOfResultSequence(array $sequenceSlice, int $from, int $start): bool
    {
        return empty($sequenceSlice) ? $from - $start : 0;
    }
}
