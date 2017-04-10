<?php

namespace helloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{




    public function indexAction()
    {
        return $this->render('helloBundle:Default:index.html.twig');
    }




    public function listAction()
    {
        return new Response('List action');
    }




    public function detailAction($slug, $_format)
    {
        return new Response('Detail action : ' . $slug . ' - ' . $_format);
    }
}