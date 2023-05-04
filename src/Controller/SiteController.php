<?php
namespace App\Controller;

use App\Model\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends AbstractController
{
    use ResponseTrait;

    #[Route('/home')]
    public function home(): Response
    {
        $menus = ['Mehsul','Market','Elaqe', 'Haqqimizda'];
        return $this->render('site/home.html.twig', [
            'data'=> 'Menim yeni Frameworkum', //env('APP_NAME'),
            'menu'=> $menus
        ]);
    }

    #[Route('/posts')]
    public function posts(): Response
    {
        $posts = Post::get();
        return $this->response($posts);
    }
}