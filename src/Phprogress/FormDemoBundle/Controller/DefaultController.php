<?php

namespace Phprogress\FormDemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
}
