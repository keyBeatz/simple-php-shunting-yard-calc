<?php

namespace Test;

use App\Model\Math\Calc;
use Tester;
use Tester\Assert;


require __DIR__ . '/bootstrap.php';


class CalcTest extends Tester\TestCase
{
    public function testCalculate()
    {
        $input    = '20+10*(50-100*(20-54*4/(1+2)))+(20+10)';
        $expected = eval("return $input;");
        Assert::equal((int)$expected, (int)Calc::calc($input));

        $input    = '1+1';
        $expected = eval("return $input;");
        Assert::equal((int)$expected, (int)Calc::calc($input));

        $input    = '1-1';
        $expected = eval("return $input;");
        Assert::equal((int)$expected, (int)Calc::calc($input));

        $input    = '2*2';
        $expected = eval("return $input;");
        Assert::equal((int)$expected, (int)Calc::calc($input));

        $input    = '2/2';
        $expected = eval("return $input;");
        Assert::equal((int)$expected, (int)Calc::calc($input));

        $input    = '5+-5';
        $expected = eval("return $input;");
        Assert::equal((int)$expected, (int)Calc::calc($input));
    }
}

($test = new CalcTest())->run();
