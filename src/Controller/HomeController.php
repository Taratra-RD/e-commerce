<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Property;
use App\Repository\PropertyRepository;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]    
    /**
     * index
     *
     * @param  mixed $repository
     * @return Response
     */
    public function index(PropertyRepository $repository): Response
    {
        $property = $repository->findLatest();
        return $this->render('home/index.html.twig', [
            'properties' => $property
        ]);
    }
}
