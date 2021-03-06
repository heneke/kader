<?php
namespace Kader\Data\Impl;

use Kader\AbstractTest;
use Kader\Data\Impl\PageRequest;

class PageRequestTest extends AbstractTest
{

    /**
     * @test
     * @dataProvider offsetDataProvider
     */
    public function offset($pageNumber, $pageSize, $expectedOffset)
    {
        $pr = new PageRequest($pageNumber, $pageSize);
        $this->assertEquals($pageNumber, $pr->getPageNumber());
        $this->assertEquals($pageSize, $pr->getPageSize());
        $this->assertEquals($expectedOffset, $pr->getOffset());
        $this->assertNotNull($pr->next());
        $this->assertEquals($pageNumber + 1, $pr->next()->getPageNumber());
        $this->assertEquals($pageSize, $pr->next()->getPageSize());
        $this->assertNotNull($pr->previousOrFirst());
        if ($pageNumber == 1) {
            $this->assertEquals(1, $pr->previousOrFirst()->getPageNumber());
        } else {
            $this->assertEquals($pageNumber - 1, $pr->previousOrFirst()->getPageNumber());
        }
        $this->assertEquals($pageSize, $pr->previousOrFirst()->getPageSize());
    }

    public function offsetDataProvider()
    {
        return [
            [1, 20, 0],
            [2, 20, 20],
            [2, 10, 10],
            [10, 1, 9],
        ];
    }
}