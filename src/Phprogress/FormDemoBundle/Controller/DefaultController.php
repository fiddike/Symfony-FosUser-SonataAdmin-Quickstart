<?php

namespace Phprogress\FormDemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Phprogress\FormDemoBundle\Multiplikator\Multiplikator;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }

    /**
     * @Route("/exception")
     */
    public function exceptionAction()
    {
        throw new NotFoundHttpException ('This Exception is thrown to simulate that some content has not been found.');
    }

    /**
     * @Route("/debug-me")
     */
    public function debugMeAction()
    {
        $i = 1;
        $k = 2;
        $i = 10;
        $k = 20;
        $p = 100;
        $p = 200;

        throw new NotFoundHttpException ('This Exception is thrown to simulate that some content has not been found.');
    }

    /**
     * @Route("/uebung1/{demoString}")
     * @Template()
     */
    public function uebung1Action($demoString)
    {
        return array('demoString' => $demoString);
    }


    /**
     * @Route("/uebung5/{number1}/{number2}/{number3}")
     * @Template()
     */
    public function uebung5Action($number1, $number2, $number3)
    {
        /** @var Multiplikator $multiplikator */
        $multiplikator = $this->get('level9.uebung3');
        $product = $multiplikator->multiply($number1, $number2, $number3);
        return array ('product' => $product);
    }
}
