<?php

namespace App\Controller;

use App\Entity\CrewMember;
use App\Form\CrewMemberType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArgonautesController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="argonautes")
     */
    public function index(HttpFoundationRequest $request): Response
    {

        $crewMember = new CrewMember();
        $form = $this->createForm(CrewMemberType::class, $crewMember);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $crewMember = $form->getData();
            $this->entityManager->persist($crewMember);
            $this->entityManager->flush();
        }

        $crewMembers = $this->entityManager->getRepository(CrewMember::class)->findAll();
        


        return $this->render(
            'argonautes/index.html.twig',[
                'form' => $form->createView(),
                'crewMembers' => $crewMembers
                ]);
    }
}
