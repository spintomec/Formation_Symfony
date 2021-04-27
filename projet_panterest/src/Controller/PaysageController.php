<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PaysagesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Paysages;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\PaysageType;


class PaysageController extends AbstractController
{
    /**
     * @Route("/", name="app_home", methods="GET")
     */
    public function index(PaysagesRepository $PaysagesRepository): Response
    {

        $paysage =  $PaysagesRepository->findby([],['createdAt' => 'DESC']);

        return $this->render('pins/index.html.twig', compact('paysage'));
    }
     /**
     * @Route("/paysage/{id<[0-9]+>}", name="paysages_app", methods="GET")
     */
    public function show(Paysages $paysage): Response{
       
       return $this->render('pins/show.html.twig', compact('paysage'));
    }
    /**
     * @Route("/paysages/create", name="create_app", methods={"GET","POST"})
     */
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $paysage = new Paysages;

        $form = $this->createForm(PaysageType::class, $paysage);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($paysage);
            $em->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('pins/create.html.twig', [
            'monFormulaire' => $form->CreateView()
        ]);
    }
    /**
     * @Route("/paysages/{id<[0-9]+>}/edit", name="edit_app", methods={"GET","PUT"})
     */
    public function edit(Paysages $paysage, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(PaysageType::class, $paysage, [
            'method' => 'PUT'
        ]); 
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

           return $this->redirectToRoute('app_home');
        }
        return $this->render('pins/edit.html.twig', [
            'paysage' => $paysage,
            'monFormulaire' => $form->createView()
        ]);
       
    }
    /**
     * @Route("/paysages/{id<[0-9]+>}/delete", name="delete_app", methods="DELETE")
     */
    public function delete(Paysages $paysage, Request $request, EntityManagerInterface $em): Response 
    {
        if ($this->isCsrfTokenValid('delete'.$paysage->getId(),$request->request->get('csrf_token'))) {
        $em->remove($paysage);
        $em->flush();
        }
        return $this->redirectToRoute('app_home');
    }
}