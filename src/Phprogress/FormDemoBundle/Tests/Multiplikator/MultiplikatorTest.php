<?php

use Phprogress\FormDemoBundle\Multiplikator\Multiplikator;

class MultiplikatorTest extends PHPUnit_Framework_TestCase
{
    public function testMathCorrect ()
    {
        $muliplikator = new Multiplikator();
        $this->assertEquals(6, $muliplikator->multiply(1,2,3));
        $this->assertEquals(1610, $muliplikator->multiply(10,23,7));
    }
}
 