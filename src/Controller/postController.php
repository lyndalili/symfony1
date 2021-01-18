<?php
// src/Controller/postController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response; //defeinition de la class
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class postController extends AbstractController  // creation class contoleur

{

    /**
     * @Route("/", name="post_index", methods={"GET"})
      */

       
    public function index(): Response //cree une fonction on determine le type de retour "reponse"
    {
         //ligne php avec nombre aleatoire 

  
        return $this->render('post/index.html.twig');
    }
    /**
     * @Route("/view/{id}", name="post_view", methods={"GET"}, requirements={"page"="id\d+"})
      */
    public function view($id): Response {
        return $this->render('post/view.html.twig',[ 
      
            'id' => $id,
        ]);

        
    }
    /**
     * @Route("/about/", name="post_about", methods={"GET"}, requirements={"page"="id\d+"})
      */
    public function about(): Response {
        return $this->render('post/about.html.twig');
    

}
}