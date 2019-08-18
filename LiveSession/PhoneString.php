<?php

$input = '1234567';
//$input = '123';
$phoneString = new PhoneString();
$phoneString->printStrings($input);

class PhoneString
{
    const MAPPING = [
        0 => [''],
        1 => [''],
        2 => ['A', 'B', 'C'],
        3 => ['D', 'E', 'F'],
        4 => ['G', 'H', 'I'],
        5 => ['J', 'K', 'L'],
        6 => ['M', 'N', 'O'],
        7 => ['P', 'Q', 'R', 'S'],
        8 => ['T', 'U', 'V'],
        9 => ['W', 'X', 'Y', 'Z']
    ];

    public function printStrings(string $phone_number)
    {
        // @todo: validation

        $index = strlen($phone_number) - 1;
        $digits = array_map(function($digit) { return (int) $digit; }, str_split($phone_number, 1));

        $permutations = $this->getPermutations($digits, $index);
        foreach ($permutations as $permutation) {
            print $permutation . PHP_EOL;
        }
    }

    // @todo: get this to work with Generator?
    public function getPermutations(array $digits, int $index): array
    {
        if ($index < 0) {
            return [''];
        }

        $permutations = [];
        $digit = $digits[$index];
        foreach(self::MAPPING[$digit] as $char)
        {
            foreach($this->getPermutations($digits, $index-1) as $prefix)
            {
                $permutations[] = $prefix.$char;
            }
        }

        return $permutations;
    }
}