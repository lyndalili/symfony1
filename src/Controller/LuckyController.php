<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response; //defeinition de la class
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class LuckyController extends AbstractController  // creation class contoleur
{

    /**
     * @Route("/test/chance/nombre/{id}", name="lucky_number", methods={"GET"}, requirements={"page"="\d+"})
      */
       
    public function number(): Response //cree une fonction on determine le type de retour "reponse"
    {
        $number = random_int(0, 100); //ligne php avec nombre aleatoire 

       /* return new Response( //retourne nouvelle instanciantion de reponse 
            '<html><body>Lucky number: '.$number.'</body></html>' //container avec pour afficher la vue 
        );
*/
        return $this->render('lucky/number.html.twig', [
            'number' => $number,
        ]);
    }
}
