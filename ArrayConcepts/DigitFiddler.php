<?php

namespace InterviewCamp\ArrayConcepts;

// PROBLEM: given an input number, rearrange the digits to produce the minimum larger number

$input = 653421;

$fiddler = new FirstDipDigitFiddler($input);
print $fiddler->getNextLargest() . PHP_EOL;

abstract class BaseDigitFiddler
{
    protected $input;
    protected $input_digits;

    public function __construct(int $input)
    {
        // @todo validate input
        $this->input = $input;
        $this->input_digits = str_split((string)$input, 1);
    }

    abstract public function getNextLargest(): int;
}

class FirstDipDigitFiddler extends BaseDigitFiddler
{
    /**
     * Going right to left, find first digit that is smaller than the previous
     * -->leave remaining digits in place
     * -->swap first dip value with next-largest in suffix
     * -->order remaining suffix digits in ascending order
     * @return int
     * @throws Exception
     */
    public function getNextLargest(): int
    {
        // @todo: duplicate digits
        // @todo: less than 2 digits

        $first_dip_index = $this->findFirstDipIndex();

        // Digits before dip remain the same
        $prefix = array_slice($this->input_digits, 0, $first_dip_index);
        $suffix = $this->getSuffixDigits($first_dip_index);

        $next_largest_digits = array_merge($prefix, $suffix);

        return (int) implode('', $next_largest_digits);
    }

    /**
     * swap first dip value with next largest suffix digit,
     * -->follow with remaining digits sorted in asc order
     * @param int $first_dip_index
     * @return array
     */
    private function getSuffixDigits(int $first_dip_index): array
    {
        $suffix_digits = array_slice($this->input_digits, $first_dip_index);
        sort($suffix_digits);

        $dip_val = $this->input_digits[$first_dip_index];
        $next_largest_index = array_search($dip_val, $suffix_digits)+1;

        $suffix = [$suffix_digits[$next_largest_index]];
        unset($suffix_digits[$next_largest_index]);

        return array_merge($suffix, $suffix_digits);
    }

    /**
     * @return int
     * @throws Exception
     */
    private function findFirstDipIndex(): int
    {
        $index = count($this->input_digits)-1;
        $digit = $this->input_digits[$index];
        do {
            if ($index <= 0) {
                throw new Exception("input is largest value");
            }

            $prev_digit = $digit;
            $digit = $this->input_digits[--$index];
        } while ($digit > $prev_digit);

        return $index;
    }
}

// Brute Force approach O(C^n)
class BruteForceDigitFiddler extends BaseDigitFiddler
{
    /**
     * @return int
     * @throws Exception
     */
    public function getNextLargest(): int
    {
        $ordered = $this->generatePermutations($this->input_digits);
        sort($ordered);
        $input_index = array_search($this->input, $ordered);

        if ($input_index == count($ordered) - 1) {
            throw new Exception("input is largest value");
        }

        return (int)$ordered[$input_index + 1];
    }

    /**
     * @param array $digits
     * @return array
     */
    private function generatePermutations(array $digits): array
    {
        if (empty($digits)) {
            return [''];
        }

        $permutations = [];
        foreach ($digits as $index => $digit) {
            $pass_digits = $digits;
            unset($pass_digits[$index]);

            foreach ($this->generatePermutations($pass_digits) as $suffix) {
                $permutations[] = $digit . $suffix;
            }
        }

        return $permutations;
    }
}