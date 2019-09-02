<?php

namespace InterviewCamp\LinkedList;

class LinkedList
{
    /** @var Node */
    protected $head;

    /** @var Node */
    protected $tail;

    /** @var int */
    protected $count = 0;

    public function append(Node $tail): LinkedList
    {
        if ($this->empty()) {
            $this->head = $tail;
        } else {
            $this->tail->setNext($tail);
        }

        $this->tail = $tail;
        $this->count++;
        return $this;
    }

    public function delete(Node $toDelete)
    {
        $prev = $toDelete->getPrev();

        if (is_null($toDelete)) {
            return;
        }

        if ($toDelete === $this->getHead()) {
            $this->setHead($toDelete->getNext());
        }

        if ($toDelete === $this->getTail()) {
            $this->setTail($prev);
            $prev->setNext(null);
        }

        if (!is_null($prev)) {
            $prev->setNext($toDelete->getNext());
        }
    }

    public function appendList(LinkedList $list): LinkedList
    {
        if (!$list->empty()) {
            $this->tail->setNext($list->getHead());
            $this->tail = $list->getTail();
        }

        return $this;
    }

    public function getHead()
    {
        return $this->head;
    }

    public function getTail()
    {
        return $this->tail;
    }

    public function setHead(Node $head): LinkedList
    {
        $this->head = $head;
        return $this;
    }

    public function setTail(Node $tail): LinkedList
    {
        $this->tail = $tail;
        return $this;
    }

    public function buildFromArray(array $data): LinkedList
    {
        foreach ($data as $node_value) {
            $this->append(new Node($node_value));
        }

        return $this;
    }

    public function printValues()
    {
        print '[';

        if (!$this->empty()) {
            $current = $this->head;
            do {
                print $current->getData() . ' ';
            } while (!is_null($current = $current->getNext()));
        }

        print ']' . PHP_EOL;
    }

    public function empty()
    {
        return is_null($this->head);
    }
}