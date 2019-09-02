<?php

namespace InterviewCamp\LinkedList;

class LruCache extends LinkedList
{
    /** @var int */
    protected $cache_size;

    /** @var array */
    protected $map = [];

    public function __construct(int $cache_size)
    {
        $this->cache_size = $cache_size;
    }

    protected function isFull(): bool
    {
        return $this->count >= $this->cache_size;
    }

    public function read($value)
    {
        return $this->map[$value] ?? null;
    }

    public function write($value)
    {
        if (!is_null($mru = $this->read($value))) {
            $this->moveCachedToTail($mru);
        } else {
            $this->append(new Node($value));
        }
    }

    public function append(Node $tail): LinkedList
    {
        if ($this->isFull()) {
            $this->dropLru();
        }

        $this->map[$tail->getData()] = $tail;
        return parent::append($tail);
    }

    protected function dropLru()
    {
        $lru = $this->getHead();
        $lru->getNext()->setPrev(null);
        $this->setHead($lru->getNext());
        unset($this->map[$lru->getData()]);
        $this->count--;
    }

    protected function moveCachedToTail(Node $mru)
    {
        if ($mru === $this->getTail()) {
            return;
        } elseif ($mru === $this->head) {
            $this->setHead($mru->getNext());
            $mru->getNext()->setPrev(null);
        } else {
            $mru->getPrev()->setNext($mru->getNext());
        }

        $mru->setNext(null);
        $this->getTail()->setNext($mru);
        $this->setTail($mru);
    }
}