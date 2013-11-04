<?php

namespace Phprogress\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        /** @var EntityManager $em */
        $em = $this->get('doctrine.orm.entity_manager');



        return $this->render('PhprogressUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
