<?php

// Question:ClimbingStepsProblemLet’s say you have to climb N steps. You can jump 1 step, 3 steps or 5 steps at a time.
// How many ways are there to get to the top of the steps?

// Bottom-Up (Tabulation)

function num_ways(int $steps)
{
    $table = array_fill(0, $steps+1, 0);

    $table[0] = 1;

    for($i = 0; $i <= $steps; $i++)
    {
        $table[$i + 1] += $table[$i];
        $table[$i + 3] += $table[$i];
        $table[$i + 5] += $table[$i];
    }

    return $table[$steps];
}

try {
    print "Num_Ways: ".num_ways(200) . PHP_EOL;
} catch (Throwable $e)
{
    print $e->getMessage().PHP_EOL;
}
