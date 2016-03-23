<?php
namespace Kader\Data\Impl;

use Kader\AbstractTest;
use Kader\Data\Impl\PageImpl;
use Kader\Data\Impl\PageRequest;
use Kader\Data\PageableInterface;

class PageImplTest extends AbstractTest
{

    private function createArray($size, $value = 'test')
    {
        if ($size > 0) {
            return array_fill(0, $size, $value);
        } else {
            return [];
        }
    }

    private function createPageable($page, $size)
    {
        return new PageRequest($page, $size);
    }

    /**
     * @test
     * @dataProvider implementationDataProvider
     */
    public function implementation($expectedPrevious, $expectedNext, $expectedTotal, $expectedTotalPages, array $content, PageableInterface $pageable = null, $total = null)
    {
        $pi = new PageImpl($content, $pageable, $total);
        $this->assertEquals($expectedPrevious, $pi->hasPreviousPageable());
        if ($expectedPrevious) {
            $this->assertNotNull($pi->previousPageable());
        } else {
            $this->assertNull($pi->previousPageable());
        }
        $this->assertEquals($expectedNext, $pi->hasNextPageable());
        if ($expectedNext) {
            $this->assertNotNull($pi->nextPageable());
        } else {
            $this->assertNull($pi->nextPageable());
        }
        $this->assertEquals($expectedTotal, $pi->getTotal());
        $this->assertEquals($expectedTotalPages, $pi->getTotalPages());
    }

    public function implementationDataProvider()
    {
        return [
            [false, false, 0, 0, $this->createArray(0), null, null],
            [false, false, 0, 0, $this->createArray(0), $this->createPageable(1, 1), null],
            [false, false, 0, 0, $this->createArray(0), $this->createPageable(1, 1), 0],

            [false, false, 1, 1, $this->createArray(1), null, null],
            [false, false, 1, 1, $this->createArray(1), $this->createPageable(1, 1), null],
            [false, false, 1, 1, $this->createArray(1), $this->createPageable(1, 1), 1],

            [false, false, 100, 1, $this->createArray(100), null, null],
            [false, false, 100, 1, $this->createArray(100), $this->createPageable(1, 100), null],
            [false, false, 100, 1, $this->createArray(100), $this->createPageable(1, 100), 100],

            [false, true, 100, 10, $this->createArray(10), $this->createPageable(1, 10), 100],
            [false, false, 10, 1, $this->createArray(10), $this->createPageable(1, 10), 10],
            [true, false, 100, 10, $this->createArray(10), $this->createPageable(10, 10), 100],
            [true, true, 101, 11, $this->createArray(10), $this->createPageable(10, 10), 101],
            [true, false, 99, 10, $this->createArray(9), $this->createPageable(10, 10), 99],

            [true, true, 100, 10, $this->createArray(10), $this->createPageable(2, 10), 100],
            [true, false, 10, 1, $this->createArray(10), $this->createPageable(2, 10), 10],
        ];
    }

    /**
     * @test
     */
    public function iterator()
    {
        $array = ['a', 'b', 'c'];
        $pi = new PageImpl($array);
        foreach ($pi as $i => $content) {
            $this->assertEquals($array[$i], $content);
        }
        $pi->rewind();
        $this->assertEquals(0, $pi->key());
        $this->assertEquals($array[0], $pi->current());
        $this->assertEquals($array[0], $pi->current());
        $pi->next();
        $this->assertEquals(1, $pi->key());
        $this->assertEquals($array[1], $pi->current());
    }
}