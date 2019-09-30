<?php

$input = [5, 7, 4, 6, 5, 3, 3];
$k = 8;

try {
    print "{$k}th smallest value: " . findKthSmallest($input, $k) . "\n";
} catch (Exception $e) {
    print $e->getMessage() . PHP_EOL;
}

/**
 * For unsorted array of integers, find the Kth-smallest value
 *
 * @param array $input
 * @param int $k -- Kth index (eg k=1 --> smallest value, k=2 --> 2nd smallest)
 * @return int
 */
function findKthSmallest(array $input, int $k): int
{
    if (empty($input))
    {
        throw new Exception("Input array cannot be empty");
    }

    if ($k < 1 || $k > count($input)) {
        throw new Exception("Invalid K value");
    }


    // Initial subarray is the entire input array
    return helperKthSmallest($input, $k, 0, count($input) - 1);
}

/**
 * Process subarray by recursive Selection partitioning
 * --> Each iteration of partitioning will result in the $pivot value being in its
 * correct sorted-index, with all values <= $pivot to the left, and all values > $pivot
 * to the right.
 *
 * @param array $input
 * @param int $k
 * @param int $start
 * @param int $end
 * @return int
 */
function helperKthSmallest(array $input, int $k, int $start, int $end): int
{
    // Randomly select pivot value
    $pivot_index = rand($start, $end);

    // Partition array around $pivot -- $pivot will end up in it's correct sort-index
    $partitioned_index = partition($input, $pivot_index, $start, $end);

    //
    if ($partitioned_index == ($k - 1)) {
        return $input[$partitioned_index];
    } elseif ($partitioned_index < ($k - 1)) {
        return helperKthSmallest($input, $k, $partitioned_index + 1, $end);
    } else {
        return helperKthSmallest($input, $k, $start, $partitioned_index - 1);
    }
}

/**
 * reorder sub-array from $start to $end such that all elements <= $pivot
 * are left of the $pivot value, and all elements > $pivot are right of the $pivot value
 * --> Return index of the pivot value.
 * --> Note: $pivot value will be in it's correct sorted index, though the rest of array is not
 *
 * @param array $input
 * @param int $pivot_index
 * @param int $start
 * @param int $end
 * @return int
 */
function partition(array &$input, int $pivot_index, int $start, int $end): int
{
    $pivot = $input[$pivot_index];
    $less_than_index = $start; // Tracks highest index of values less than $pivot

    // Start with $pivot value in Start Index
    swap($input, $pivot_index, $start);

    // Iterate through all other values in subarray
    for ($i = $start + 1; $i <= $end; $i++) {
        // Any values <= pivot must be grouped together in left partition
        if ($input[$i] < $pivot) {
            swap($input, $i, $less_than_index + 1);
            $less_than_index++;
        }
        // Values greater than $pivot will be swapped out by further right values
        // that are smaller than $pivot
    }

    // Final position of rightmost 'less than' value is where $pivot must go
    swap($input, $start, $less_than_index);

    return $less_than_index;
}

function swap(array &$input, int $index_1, int $index_2): void
{
    $temp = $input[$index_1];
    $input[$index_1] = $input[$index_2];
    $input[$index_2] = $temp;
}
