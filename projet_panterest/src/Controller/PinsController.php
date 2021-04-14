<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PaysagesRepository;
use Symfony\Component\HttpFoundation\Response;

class PinsController extends AbstractController
{
    /**
     * @Route("/", name="app_homme")
     */
    
    public function index(PaysagesRepository $PaysagesRepository): Response
    {

        $paysages =  $PaysagesRepository->findAll();

        return $this->render('pins/index.html.twig', compact('paysages'));
    }
     /**
     * @Route("/paysages/{id<[0-9]+>}", name="paysages_app")
     */

    public function show(Paysages $paysage): Response{
       
       dd($paysage);
    }
}
