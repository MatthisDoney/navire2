<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \App\Repository\AisShipTypeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[Route('/aisshiptype', name: 'aisshiptype')]
class AisShipTypeController extends AbstractController {

    #[Route('/voirtous', name: 'voirtous')]
    public function voirTous(AisShipTypeRepository $repoAisShipType): Response {
        $aisSipTypes=$repoAisShipType->findAll();
        return $this->render('aisshiptype/voirtous.html.twig', [
            'aisShipTypes' => $aisSipTypes,
        ]);
        
    }
    
    #[Route('/portscompatibles', name: 'portscompatibles')]
    public function portsCompatibles(Request $request, AisShipTypeRepository $repo) : Response  {
        $aisShipType = $repo->find($request->get('id'));
        return $this->render('aisshiptype/portscompatibles.html.twig'), [
            'aisShipType' => $aisShipType,
            ]);
        
    }
}
