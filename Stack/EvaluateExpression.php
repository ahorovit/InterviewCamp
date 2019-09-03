<?php

require_once __DIR__ . '/../vendor/autoload.php';

use InterviewCamp\Stack\Stack;

const OPERATORS = [
    '+' => 1,
    '-' => 1,
    '*' => 2,
    '/' => 2,
];

function process(Stack $operands, Stack $operators)
{
    $num_2 = $operands->pop();
    $num_1 = $operands->pop();
    $operator = $operators->pop();

    $operands->push(apply($num_1, $num_2, $operator));
}

function apply(int $num_1, int $num_2, string $operator)
{
    switch ($operator) {
        case '+':
            return $num_1 + $num_2;
        case '-':
            return $num_1 - $num_2;
        case '*':
            return $num_1 * $num_2;
        case '/':
            return $num_1 / $num_2;
        default:
            throw new \Exception("Invalid Operator");
    }
}

function precedence(string $operator)
{
    return OPERATORS[$operator];
}

function evaluate(string $expression): int
{
    $operators = new Stack();
    $operands = new Stack();

    foreach (str_split($expression, 1) as $ch) {
        if (!isset(OPERATORS[$ch])) {
            $operands->push((int)$ch);
        } else {
            // If previous operator is higher precedence than current, we can perform previous operation
            while (!$operators->empty() && precedence($operators->peek()) >= precedence($ch)) {
                process($operands, $operators);
            }

            $operators->push($ch);
        }
    }

    while (!$operators->empty()) {
        process($operands, $operators);
    }

    $result = $operands->pop();

    if (!$operands->empty() || is_null($result)) {
        throw new \Exception("Invalid expression");
    }

    return $result;
}


try {
    $input = "1+2/1+3*2";
    print "{$input} => " . evaluate($input) . PHP_EOL;
} catch (\Throwable $e) {
    print $e->getMessage() . PHP_EOL;
}
