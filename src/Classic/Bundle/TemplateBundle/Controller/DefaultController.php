<?php

namespace Classic\Bundle\TemplateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ClassicTemplateBundle:Default:index.html.twig', array('name' => $name));
    }
}
