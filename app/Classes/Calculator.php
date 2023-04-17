<?php

namespace App\Classes;

class Calculator {

    /**
     * @param $expression
     * @return array|mixed|string|string[]|null
     * This function was generated using ChatGPT
     */
    static function calculate($expression) {
        // Remove all whitespace characters from the expression
        $expression = preg_replace('/\s+/', '', $expression);

        // Use regular expressions to match brackets and perform calculations
        while (preg_match('/\(([^\(\)]+)\)/', $expression, $matches)) {
            // Calculate the value of the expression within the matched brackets
            $value = self::calculate($matches[1]);
            // Replace the matched expression with its calculated value
            $expression = str_replace($matches[0], $value, $expression);
        }

        // Perform the remaining arithmetic operations (in order of precedence)
        while (preg_match('/(\d+)([\/*%])(\d+)/', $expression, $matches)) {
            // Perform the calculation based on the operator
            switch ($matches[2]) {
                case '*':
                    $result = $matches[1] * $matches[3];
                    break;
                case '/':
                    $result = $matches[1] / $matches[3];
                    break;
                case '%':
                    $result = $matches[1] % $matches[3];
                    break;
            }
            // Replace the matched expression with its calculated value
            $expression = str_replace($matches[0], $result, $expression);
        }
        while (preg_match('/(\d+)([\+\-])(\d+)/', $expression, $matches)) {
            // Perform the calculation based on the operator
            switch ($matches[2]) {
                case '+':
                    $result = $matches[1] + $matches[3];
                    break;
                case '-':
                    $result = $matches[1] - $matches[3];
                    break;
            }
            // Replace the matched expression with its calculated value
            $expression = str_replace($matches[0], $result, $expression);
        }

        // Return the final result
        return $expression;
    }
}
