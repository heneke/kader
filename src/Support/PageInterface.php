<?php
namespace Kader\Support;

interface PageInterface extends \Iterator
{

    /**
     * @return array
     */
    public function getContent();

    /**
     * @return bool
     */
    public function hasNextPageable();

    /**
     * @return bool
     */
    public function hasPreviousPageable();

    /**
     * @return PageableInterface
     */
    public function nextPageable();

    /**
     * @return PageableInterface
     */
    public function previousPageable();
}