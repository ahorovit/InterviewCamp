<?php


require_once __DIR__ . '/../vendor/autoload.php';

use InterviewCamp\LinkedList\LinkedList;
use InterviewCamp\LinkedList\Node;


function reverse(LinkedList $input)
{
    if ($input->empty()) {
        return;
    }
    // set aside
    $new_tail = $input->getHead();

    $prev = null;
    $curr = $input->getHead();
    $next = $curr->getNext();

    do {
        $curr->setNext($prev);
        $prev = $curr;

        $curr = $next;
        $next = is_null($curr) ? null : $curr->getNext();
    } while (!is_null($curr));

    $input->setHead($prev);
    $input->setTail($new_tail);
}

try {
    $input = new LinkedList();
    $input->buildFromArray([0, 1, 2, 3, 4, 5]);

    reverse($input);

    $input->printValues();
} catch (Throwable $e) {
    print $e->getMessage();
}

