<?php
namespace Kader\Support;

interface PageableInterface
{

    /**
     * Return the offset of the underlying page
     *
     * @return mixed
     */
    public function getOffset();

    /**
     * Returns the 1-based page number
     *
     * @return int
     */
    public function getPageNumber();

    /**
     * Return the page size
     *
     * @return integer
     */
    public function getPageSize();
}