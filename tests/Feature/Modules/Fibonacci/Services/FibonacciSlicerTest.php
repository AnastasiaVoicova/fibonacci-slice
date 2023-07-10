<?php

namespace Tests\Feature\Modules\Fibonacci\Services;

use App\Modules\Fibonacci\Services\FibonacciSlicer;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class FibonacciSlicerTest extends TestCase
{
    /** @test
     *  @dataProvider data
     */
    public function getSlice(int $from, int $to, array $expected): void
    {
        $slicer = App::make(FibonacciSlicer::class);
        $fibonacciSlice = $slicer->getSlice($from, $to);

        $this->assertSame($expected, array_values($fibonacciSlice));
    }

    public static function data(): array
    {
        return [
            [0,1,[0,1]],
            [0,3,[0,1,1,2]],
            [3,7,[2,3,5,8,13]],
            [3,10,[2,3,5,8,13, 21,34,55]],
            [12,14,[144,233,377]],
        ];
    }
}
