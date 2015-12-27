<?php

namespace Elpy\Bundle\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ElpyGeneralBundle:Default:index.html.twig', array('name' => $name));
    }
}
