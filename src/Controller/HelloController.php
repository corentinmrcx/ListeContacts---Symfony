<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    #[Route('/hello', name: 'app_hello')]
    public function index(): Response
    {
        return $this->render('hello/index.html.twig');
    }

    #[Route('/hello/{name}/{times}', name: 'app_hello_manytimes', requirements: ['times' => '\d+'], defaults: ['times' => 3])]
    public function manyTimes(string $name, int $times): Response
    {
        if (0 == $times || $times > 10) {
            return $this->redirectToRoute('app_hello_manytimes', ['name' => $name]);
        }

        return $this->render('hello/many_times.twig', ['name' => $name, 'times' => $times]);
    }

    #[Route('/hello/{name}')]
    public function world(string $name): Response
    {
        return $this->render('hello/world.html.twig', ['name' => $name]);
    }
}
