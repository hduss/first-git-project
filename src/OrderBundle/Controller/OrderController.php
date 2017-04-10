<?php

namespace OrderBundle\Controller;

## on doit importer les Response et Request pour pouvoir les utiliser dans nos functions ## 

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

##  on importe l'entitée cart qu'on a creé avec doctrine pour l'utiliser  ##  
use OrderBundle\Entity\Cart;
use OrderBundle\Entity\Line;


class OrderController extends Controller
{






/*-------------------------LIST------------------------*/


##  $request est une instance de l'objet Request donc on doit le specifier  ##
	public function orderListAction(Request $request)
	{

##  on chaine les methodes getDoctrine() et getRepositorty() sur l'instance de l'objet cat les setters renvoient un objet alors que les getters renvoient une string ##
		$repository = $this
		->getDoctrine()
		->getRepository('OrderBundle:Cart');


		$carts = $repository->findAll();

		if (null == $carts) {
			
			throw $this->createNotFoundException('cart not Found');
		}

## $this->render renvoi le rendu d'un template --> on lui met en parametre le template a utiliser puis le tableau a afficher --> ici c'est la variable $carts / voir le list.html.twig ##
		return $this->render('OrderBundle:Order:list.html.twig', ['cart_list'=>$carts]);


	}



/*-------------------------DETAILS------------------------*/



	public function orderDetailAction(Request $request)
	{

## ici on recupere dans des variables, grace aux method de l'objet request la page qui est dans le order.yml  ##
		$number = $request->attributes->get('id');
		$controller = $request->attributes->get('_controller');
		$route = $request->attributes->get('_route');

		$repository = $this
		->getDoctrine()
		->getRepository('OrderBundle:Cart');


		$cart = $repository->find($request->attributes->get('id'));

		if (null == $cart) {
			
			throw $this->createNotFoundException('cart not Found');
		}

/*
		return new Response(

			'number : ' . $cart->getNumber() . "<br/>" .
			'date : ' . $cart->getDate()->format('d/m/Y') . "<br/>" . ## getDate() renvoi une instance de l'objet Date--> donc il faut utiliser une autre method pour la faire ressortir en string -->format('d/m'Y)  ##
			'statut : ' . $cart->getStatus() . "<br/>" 

			);
*/

## en utilisant un template  --> ##

		return $this->render('OrderBundle:Order:detail.html.twig', ['cart'=>$cart]);

	}





/*-------------------------CREATE------------------------*/




	public function orderCreateAction()
	{

##  pour creer une instance et l'envoyer en base on utilise DOCTRINE  ##
		$cart = new Cart();
		$cart->setNumber('10001');

##  dans le setDate on cree une nouvelle date avec l'objet Datetime  ##
		$cart->setDate(new \DateTime('-2 days'));
		$cart->setStatus('pending');


		$em = $this->getDoctrine()->getManager();
		$em->persist($cart);
		$em->flush();

		return new Response("Created !!! ");

	}





/*-------------------------UPDATE------------------------*/




public function orderUpdateAction($id)
    {
        $repository = $this
            ->getDoctrine()
            ->getRepository('OrderBundle:Cart');

        $cart = $repository->find($id);

        if (null == $cart) {

            throw $this->createNotFoundException(
                'Command not found'

            );
        }

        $cart->setNumber('123456');

        $em = $this->getDoctrine()->getManager();
        $em->persist($cart);
        $em->flush();

        return new Response('Updated !');
    }







/*-------------------------REMOVE------------------------*/




    public function orderRemoveAction($id)
    {
        $repository = $this
            ->getDoctrine()
            ->getRepository('OrderBundle:Cart');

        $cart = $repository->find($id);

        if (null == $cart) {

            throw $this->createNotFoundException(
                'Command not found'
                
            );
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($cart);
        $em->flush();

        return new Response('Remove cart !');
    }



/*-------------------------ADD-LINE------------------------*/

	public function orderAddLineAction(Request $request)
   {

       $repository = $this->getDoctrine()->getRepository("OrderBundle:Cart");       
       $cart = $repository->findOneBy(["id" => $request->attributes->get("id")]); 

       if($cart == null)
       {
           throw $this->createNotFoundException("La page que vous rechercher n'existe pas");
       }        


       $line = new Line();
       $line->setDesignation("Super produit")
           ->setPrice(144.2)
           ->setQuantity(15);


        
        $cart->addLine($line); 




       $em = $this->getDoctrine()->getManager();        
       $em->persist($cart);
       $em->flush();   

       $this->addFlash('notice', 'La notice a été créee');  

       $url = $this->generateUrl('order_detail', ['id'=>$cart->getId()]);

       return $this->redirect($url);
   }



   public function orderSideBarAction($max = 3)
   {
   	$carts = $this
   	->getDoctrine()
	->getRepository('OrderBundle:Cart')
	->findBy([], [], $max);

	return $this->render('OrderBundle:Fragment:sidebar.html.twig', ['carts'=>$carts]);
   }


}