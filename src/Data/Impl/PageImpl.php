<?php
namespace Kader\Data\Impl;

use Kader\Data\PageableInterface;
use Kader\Data\PageInterface;
use Kader\Data\Impl\PageRequest;

class PageImpl implements PageInterface
{

    /**
     * @var array
     */
    private $content;

    /**
     * @var PageableInterface
     */
    private $pageable;

    /**
     * @var int
     */
    private $total;

    /**
     * @var \ArrayIterator
     */
    private $iterator;

    public function __construct(array $content, PageableInterface $pageable = null, $total = null)
    {
        $this->content = $content;

        if ($pageable != null) {
            $this->pageable = $pageable;
        } else {
            $this->pageable = new PageRequest(1, PHP_INT_MAX);
        }

        if ($total !== null) {
            if ($total < 0) {
                throw new \InvalidArgumentException('Total number of elements must be greater than or equal to 0!');
            }
            $this->total = intval($total);
        } else {
            $this->total = count($this->content);
        }
    }

    /**
     * @inheritDoc
     */
    public function current()
    {
        return $this->iter()->current();
    }

    /**
     * @inheritDoc
     */
    public function next()
    {
        $this->iter()->next();
    }

    /**
     * @inheritDoc
     */
    public function key()
    {
        return $this->iter()->key();
    }

    /**
     * @inheritDoc
     */
    public function valid()
    {
        return $this->iter()->valid();
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        $this->iter()->rewind();
    }

    /**
     * @inheritDoc
     */
    public function getContent()
    {
        return $this->content;;
    }

    /**
     * @inheritDoc
     */
    public function hasNextPageable()
    {
        return $this->total > (($this->pageable->getPageNumber() - 1) * $this->pageable->getPageSize()) + count($this->content);
    }

    /**
     * @inheritDoc
     */
    public function hasPreviousPageable()
    {
        return $this->pageable->getPageNumber() > 1;
    }

    /**
     * @inheritDoc
     */
    public function nextPageable()
    {
        if ($this->hasNextPageable()) {
            return $this->pageable->next();
        }
    }

    /**
     * @inheritDoc
     */
    public function previousPageable()
    {
        if ($this->hasPreviousPageable()) {
            return $this->pageable->previousOrFirst();
        }
    }

    private function iter()
    {
        if ($this->iterator == null) {
            $this->iterator = new \ArrayIterator($this->content);
        }
        return $this->iterator;
    }
}