<?php
// src/Controller/postController.php
namespace App\Controller;

use App\Entity\News;
use App\Repository\NewsRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response; //defeinition de la class

class postController extends AbstractController  // creation class contoleur

{

    /**
     * @Route("/", name="post_index", methods={"GET"})
      */

       
    public function index(NewsRepository $newsRepository): Response //cree une fonction on determine le type de retour "reponse"
    {
         //ligne php avec nombre aleatoire 

  //$news = $newsRepository->findAll();
  $lastNews = $newsRepository->findLastNews(10);
  $oldNews = $newsRepository->findOldNews();
  //dd($oldNews);
        return $this->render('post/index.html.twig', [
            "lastNews" => $lastNews,
            "oldNews" => $oldNews,
        ]);
    }
    /**
     * @Route("/view/{id}", name="post_view", methods={"GET"}, requirements={"page"="id\d+"})
      */
    public function view(NewsRepository $newsRepository, News $news) {
        
        $oldNews = $newsRepository->findOldNews();
        return $this->render('post/view.html.twig',[ 
      
            'news' => $news,
            "oldNews" => $oldNews,
        ]);

        
    }
    /**
     * @Route("/about/", name="post_about", methods={"GET"}, requirements={"page"="id\d+"})
      */
    public function about(): Response {
        return $this->render('post/about.html.twig');
    

}
}