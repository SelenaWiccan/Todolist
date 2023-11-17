<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NiceStuffController extends AbstractController
{
    /**
     * @Route("/nice/stuff", name="app_nice_stuff")
     */
    public function index(): Response
    {
        return $this->render('nice_stuff/index.html.twig', [
            'controller_name' => 'NiceStuffController',
        ]);
    }
}
