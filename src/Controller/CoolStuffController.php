<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CoolStuffController extends AbstractController
{
    /**
     * @Route("/cool/stuff", name="app_cool_stuff")
     */
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CoolStuffController.php',
        ]);
    }

    /**
     * @Route("/blog/{page}", name="app_page", requirements={"page"="\d+"})
     */
    public function blog($page): JsonResponse
    {
        return $this->json("Page Numéros" . $page);
    }
    /**
     * @Route("/blog/{slug}", name="app_slug", requirements={"slug"="\d+"})
     */
    public function post($slug): JsonResponse
    {
        return $this->json("Page slug " . $slug);
    }
//    /**
//     * @Route("/blog", name="app_slug", requirements={"slug"=>"\s+"})
//     */
//    public function blog( $page): JsonResponse
//    {
//        return $this->json("blog " . $page);
//    }
}


