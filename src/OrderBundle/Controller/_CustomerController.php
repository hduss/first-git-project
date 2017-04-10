<?php

namespace OrderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{
    public function customListAction()
    {



## on genere des urls que l'on stocke dans des variables / le name fou et bar vient de customer.yml {name}  ##   

        $customerUrl1 = $this->generateUrl('custom_detail', ['name'=>'foo',]);
        $customerUrl2 = $this->generateUrl('custom_detail', ['name'=>'bar',]);

        return new Response(

##  puis on les affiche dans du html  ##
            '<html>' .
            '<body>' .
                '<p>Liste des clients</p>' .
                '<ul>' .
                    '<li>' .
                        '<a href="' . $customerUrl1 . '">Client "Foo"</a>' .
                    '</li>' .
                    '<li>' .
                        '<a href="' . $customerUrl2 . '">Client "Bar"</a>' .
                    '</li>' .
                '</ul>' .
            '</body>' .
            '</html>'


        );
    }


## la variable name vient de customer.yml {name} --> c'est une url variable
    public function customDetailAction($name)
    {

    	if ($name == 'jod') {
    		
    		throw $this->createNotFoundException('client introuvable');
    		
    	}


##  la fonction generateUrl sur l'instance permet de generer une url --> on choisi ici de rediriger sur la custom_list de notre customer.yml, on rajoute un parametre GET ('page'=>12)  ##
        $urlRetour = $this->generateUrl('custom_list', ['page'=>12]);

        return new Response(
            '<html>' .
            '<body>' .
                '<p>Client "' . $name . '"</p>' .
                '<p>' .
                    '<a href="' . $urlRetour . '">Retour à la liste</a>' .
                '</p>' .
            '</body>' .
            '</html>'
        );
    }





    public function redirectAction()
    {
    	return $this->redirectToRoute('custom_list');
    }
}