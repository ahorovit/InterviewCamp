<?php


// Question:ClimbingStepsProblemLet’s say you have to climb N steps. You can jump 1 step, 3 steps or 5 steps at a time.
// How many ways are there to get to the top of the steps?

// Top-Down (Recursion)

function num_ways(int $steps, array &$memo = [])
{
    if ($steps == 1 || $steps == 0) {
        return 1;
    } elseif ($steps < 0) {
        return 0;
    }

    if (!isset($memo[$steps])) {
//        print "Calculating for $steps\n";

        $memo[$steps] = num_ways($steps - 1, $memo)
            + num_ways($steps - 3, $memo)
            + num_ways($steps - 5, $memo);
    }

    return $memo[$steps];

//    print "Calculating for $steps\n";
//    return num_ways($steps - 1) + num_ways($steps - 3) + num_ways($steps - 5);

}

// NOTE:

try {
    print "Num_Ways: ".num_ways(200) . PHP_EOL;
} catch (Throwable $e)
{
    print $e->getMessage().PHP_EOL;
}