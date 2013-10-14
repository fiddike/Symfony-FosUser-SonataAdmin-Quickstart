<?php

namespace Phprogress\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PhprogressUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
