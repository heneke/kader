<?php
namespace Kader\Support;

use Kader\AbstractTest;

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