<?php

use InterviewCamp\LinkedList\LinkedList;


try {
    require_once __DIR__.'/../vendor/autoload.php';

    function printValues(array $value_lists)
    {
        foreach ($value_lists as $list)
        {
            $list->printValues();
        }
    }

    function sortLinkedList(LinkedList $input) : LinkedList
    {
        $value_lists = [
            new LinkedList(),
            new LinkedList(),
            new LinkedList(),
        ];

        $node = $input->getHead();
        do {
            $value_lists[$node->getData()]->append($node);

            $next = $node->getNext();
            $node->setNext(null);
            $node = $next;

        } while(!is_null($node));

        /** @var LinkedList $result */
        $result = $value_lists[0];
        for ($idx = 1; $idx < count($value_lists); $idx++)
        {
            $result->appendList($value_lists[$idx]);
        }

        return $result;
    }


    // Sort linked list w/ values 0,1, or 2
    $input = new LinkedList();
    $input->buildFromArray([0,2,1,0,2,1,1,0,0,2,2,1]);

    $sorted = sortLinkedList($input);
    $sorted->printValues();

} catch (Throwable $e)
{
    print $e->getMessage();
}
