<?php
namespace Kader\Data\Impl;

use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\SerializedName;
use Kader\Data\PageableInterface;
use Kader\Data\PageInterface;
use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * Class PageImpl
 * @package Kader\Data\Impl
 *
 * @ExclusionPolicy("all")
 */
class PageImpl implements PageInterface
{

    /**
     * @var array
     * @Expose
     */
    private $content;

    /**
     * @var PageableInterface
     * @Expose
     */
    private $pageable;

    /**
     * @var int
     * @Expose
     */
    private $total;

    /**
     * @var int
     * @Expose
     */
    private $totalPages = 0;

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

        if ($this->pageable->getPageSize() != PHP_INT_MAX) {
            $this->totalPages = ceil($this->total / $this->pageable->getPageSize());
        } else {
            $this->totalPages = $this->total > 0 ? 1 : 0;
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
    public function getPageable()
    {
        return $this->pageable;
    }

    /**
     * @inheritDoc
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @inheritDoc
     */
    public function getTotalPages()
    {
        return $this->totalPages;
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