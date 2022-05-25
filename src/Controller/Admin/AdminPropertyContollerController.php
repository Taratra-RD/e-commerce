<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PropertyRepository;
use App\Form\PropertyType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class AdminPropertyContollerController extends AbstractController
{        
    /**
     * @var mixed
     */
    private $repository;    
    /**
     * @var mixed
     */
    private $em;
    /**
     * @param  mixed $repository
     * @return void
     */
    public function __construct(PropertyRepository $repository, ManagerRegistry $em)
    {
        $this -> repository = $repository;
        $this->em = $em->getManager();
    }

    #[Route('/admin/admin/property', name: 'app_admin_property_index')]
    public function index(): Response
    {
        $properties = $this->repository->findAll();
        return $this->render('admin/admin_property_contoller/index.html.twig', [
            'properties' => $properties
        ]);
    }

    #[Route('/admin/admin/property/create', name: 'app_admin_property_create')]
    public function new(Request $request): Response
    {
        $property = new Property;
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($property);
            $this->em->flush();
            $this->addFlash('success', 'créer avec succée');
            return $this->redirectToRoute('app_admin_property_index');
        }
        return $this->render('admin/admin_property_contoller/new.html.twig', [
            'property' => $property,
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/admin/property/{id}', name: 'app_admin_property_edit')]
    public function edit(Property $property, Request $request): Response
    {
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->flush();
            $this->addFlash('success', 'modifié avec succée');
            return $this->redirectToRoute('app_admin_property_index');
        }
        return $this->render('admin/admin_property_contoller/edit.html.twig', [
            'property' => $property,
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/admin/property/{id}', name: 'app_admin_property_delete', methods:["POST"])]
    public function delete(Property $property, Request $request): Response
    { 
        if($this->isCsrfTokenValid('delete'.$property->getId(), $request->get('_token'))){
            $this->em->remove($property);
            $this->em->flush();
            $this->addFlash('success', 'supprimé avec succés');
        }
        return $this->redirectToRoute('app_admin_property_index');
    }
}
