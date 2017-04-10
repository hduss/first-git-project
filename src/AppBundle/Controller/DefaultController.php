<?php

namespace AppBundle\Controller;


## on importe les classes dont on se sert dans les functions (dans ce cas --> Response) ##
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }


    /** 
    * @Route("/blog", name="blog_list") 
    */
    public function listAction() 
    {
        return new Response('Test');
    }


    /** 
    * @Route("/blog/42", name="test42") 
    */
    public function testAction()
    {
        return new Response('Test42');
    }





/*------------l'ordre des url statique et variable a une importance sinon il y a conflit------------*/




## slug defini une partie variable de l'url ##

## puis on lui concatene un format puis dans les requirements on lui specifie les formats
## souhaité ##

## on oblige notre slug a etre un nombre et/ou une string grace a une expression reguliere ##

## 

    /** 
    * @Route("/blog/{slug}.{_format}",
    *   name="blog_detail",
    *   requirements={
    *       "slug":"[a-z0-9-]+",
    *       "_format": "html|json"
    *   }
    *  ) 
    */
    public function detailAction($slug, $_format = 'json')

// on recupere grace a la variable $slug la partie de l'url variable {slug} dans le navigateur
    {
        return new Response('Detail action : ' . $slug);
    }








}
