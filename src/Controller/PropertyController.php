<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Form\ContactType;
use App\Form\PropertySearchType;
use App\Notification\ContactNotification;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Knp\Component\Pager\PaginatorInterface as Paginator;
use Symfony\Component\HttpFoundation\Request;

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
    public function index(Paginator $paginator, Request $request): Response
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);

        $properties = $paginator->paginate(
            $this->repository->findAllVisibleQuery($search),
            $request->query->getInt('page', 1), 
            12
        );
        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties',
            'properties' => $properties,
            'form' => $form->createView()
        ]);
    }

    #[Route('/biens/{slug}-{id}', name: 'app_property_show', requirements:['slug'=>'[a-z0-9\-]*'])]
    public function show(Property $property, string $slug, Request $request, ContactNotification $notification): Response
    {
        
        if($property->getSlug() !== $slug)
        {
            return $this->redirectToRoute('app_property_show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ], 301);
        }
        
        $contact = new Contact();
        $contact->setProperty($property);
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $notification->notify($contact);
            $this->addFlash('success', 'Votre email a bien ??t?? envoy??');
            return $this->redirectToRoute('app_property_show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ]);
        }

        return $this->render('property/show.html.twig', [
            'property' => $property,
            'current_menu' => 'properties',
            'form' => $form->createView()
        ]);
    }
}
