<?php

namespace App\Model\Math;

use App\Model\Math\Service\Expression\ExpressionFactory;
use App\Model\Math\Service\Expression\Number;


/**
 * Class Calculator is simple implementation of Shunting-yard algorithm
 * @package App\Model\Math\Service
 */
class Calc
{
    const SUPPORTED_OPERATORS = ['+', '-', '*', '/'];

    /**
     * @param string $input
     *
     * @return int|float
     */
    public static function calc(string $input): float
    {
        // strip all whitespaces
        $input = preg_replace('/\s+/', '', $input);
        // split string into an array containing single-character per value
        $tokens = preg_split('(([0-9]*\.?[0-9]+|\+|-|\(|\)|\*|\/)|\s+)', $input, null,
            PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

        // prepare our stack collections
        $outputStack   = new Stack;
        $operatorStack = new Stack;

        // prepare stacks
        foreach ($tokens as $key => $token) {
            // convert each token to an Expression object
            $expression = ExpressionFactory::create($token);

            if ($expression instanceof Number) {
                // check for negative unary operator
                if ($key > 1 && $tokens[$key - 1] === '-' && in_array($tokens[$key - 2], self::SUPPORTED_OPERATORS)) {
                    $expression->setValue(floatval($expression->getValue()) * -1);
                }
                $outputStack->push($expression);
            } elseif ($expression->isOperator()) {
                // if current token is negative unary operator then don't process it
                if ($key > 1 && $tokens[$key] === '-' && in_array($tokens[$key - 1], self::SUPPORTED_OPERATORS)) {
                    continue;
                }
                $last = $operatorStack->getLast();

                if ($last && $last->isOperator()) {
                    // check all operators from the end of the $operatorStack and move them to the $outputStack until
                    // they have greater or equal precedence (maintain correct order) and there is no left parenthesis
                    // this is simplified version of Shunting-yard algorithm without functions and Power Expression
                    // It also looks ahead to check negative unary operator presence.
                    while (($end = $operatorStack->getLast()) && $end->isOperator()) {
                        if (
                            ($expression->getPrecedence() <= $end->getPrecedence() || $end->isLeftParenthesis()) &&
                            (count($tokens) - 2 > $key && $tokens[$key + 1] !== '-')
                        ) {
                            $outputStack->push($operatorStack->pop());
                        } else {
                            break;
                        }
                    }
                    $operatorStack->push($expression);

                } else {
                    $operatorStack->push($expression);
                }
            } elseif ($expression->isParenthesis() && $expression->isLeftParenthesis()) {
                // push opening parenthesis to the operatorStack
                $operatorStack->push($expression);
            } elseif ($expression->isParenthesis()) {
                // move all expressions to the $outputStack (if they are not parenthesis)
                while ($end = $operatorStack->pop()) {
                    // break if there is another opening parenthesis
                    if ($end->isParenthesis()) {
                        break;
                    } else {
                        $outputStack->push($end);
                    }
                }
            }
        }

        // move remaining operators from $operatorStack to the top of $outputStack
        while ($operator = $operatorStack->pop()) {
            // if aby parenthesis left, there is an mismatch error
            if ($operator->isParenthesis()) {
                throw new \RuntimeException('Parenthesis missing');
            }
            $outputStack->push($operator);
        }

        // finally, compute $outputStack Expressions
        while (($operator = $outputStack->pop()) && $operator->isOperator()) {
            $value = $operator->compute($outputStack);
            if ($value !== null) {
                $outputStack->push(ExpressionFactory::create($value));
            }
        }

        // since we've implemented only +|-|/|* we expect int|float return only
        return floatval($operator->getValue());
    }
}