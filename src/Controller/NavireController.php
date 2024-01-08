<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use \App\Repository\NavireRepository;
use Doctrine\ORM\EntityManagerInterface;
use \App\Form\NavireType;

#[Route('/navire', name: 'navire_')]
class NavireController extends AbstractController
{
    #[Route('/voirtous', name: 'voirtous')]
    public function voirTous(NavireRepository $repoNavire): Response {
        $Navire=$repoNavire->findAll();
        return $this->render('navire/voirtous.html.twig', [
            'navire' => $Navire,
        ]);
        
    }
    #[Route('/editer/{id}', name: 'editer')]
    public function editer(int $id, Request $request, NavireRepository $repoNavire, EntityManagerInterface $em ) {
        $navire = $repoNavire->find($id);
        $form = $this->createForm(NavireType::class,$navire);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $navire = $form->getData();
            $em->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('navire/edit.html.twig', ['form' => $form->createView(),]);
    }
}
