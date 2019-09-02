<?php

// Given a linked list and pointers to a node N and its previous node Prev, delete N from the linked list.



require_once __DIR__.'/../vendor/autoload.php';

use InterviewCamp\LinkedList\LinkedList;
use InterviewCamp\LinkedList\Node;


function delete(LinkedList $list, Node $toDelete, Node $prev)
{
    if (is_null($toDelete))
    {
        return;
    }

    if ($toDelete === $list->getHead())
    {
        $list->setHead($toDelete->getNext());
    }

    if ($toDelete === $list->getTail())
    {
        $list->setTail($prev);
        $prev->setNext(null);
    }

    if (!is_null($prev))
    {
        $prev->setNext($toDelete->getNext());
    }
}


