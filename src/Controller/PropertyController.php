<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Property;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Doctrine\Common\Persistence\ManagerRegistry;

class PropertyController extends AbstractController
{   
    /**
     * @var PropertyRepository
     */
    private $repository;

    /**
     * @var PersistenceManagerRegistry
     */
    private $em;
    
    /**
     * __construct
     *
     * @param  mixed $repository
     * @param  mixed $em
     * @return void
     */
    public function __construct(PropertyRepository $repository, PersistenceManagerRegistry $em)
    {
        $this->repository = $repository;
        $this->em = $em->getManager();
    }

    #[Route('/property', name: 'app_property_index')]
    public function index(PersistenceManagerRegistry $doctrine): Response
    {
        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties',
        ]);
    }

    #[Route('/biens/{slug}-{id}', name: 'app_property_show', requirements:['slug'=>'[a-z0-9\-]*'])]
    public function show(Property $property, string $slug): Response
    {
        if($property->getSlug() !== $slug)
        {
            return $this->redirectToRoute('app_property_show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ], 301);
        }

        return $this->render('property/show.html.twig', [
            'property' => $property,
            'current_menu' => 'properties',
        ]);
    }
}
