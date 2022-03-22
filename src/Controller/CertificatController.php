<?php

namespace App\Controller;

use App\Entity\Certificat;
use App\Form\CertificatType;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Query\Expr\GroupBy;
use App\Repository\CandidatRepository;
use App\Repository\CertificatRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 *@IsGranted("ROLE_USER")
 * @Route("/certificat")
 */
class CertificatController extends AbstractController
{
    /**
     * @Route("/", name="certificat_index", methods={"GET"})
     */
    public function index(CertificatRepository $certificatRepository, CandidatRepository $candidatRepository): Response
    {


        return $this->render('certificat/index.html.twig', [
            'candidats' => $candidatRepository->findAll(),
            'certificats' => $certificatRepository->findAll(),
            'controller_name'=>'Listes des certificats'
        ]);
    }
    /**
     * @Route("/NoCertificated", name="candidatNoCertificated")
     */
    public function indexNoCertifier(CertificatRepository $certificatRepository, CandidatRepository $candidatRepository): Response
    {

        return $this->render('candidat/candidatNoCertifie.html.twig', [
            'candidats' => $candidatRepository->findAll(),
            'certificats' => $certificatRepository->findAll(),
            'controller_name'=>'Listes des certificats'
        ]);
    }

    /**
     * @Route("/new", name="certificat_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $certificat = new Certificat();
        $form = $this->createForm(CertificatType::class, $certificat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($certificat);
            $entityManager->flush();

            return $this->redirectToRoute('certificat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('certificat/new.html.twig', [
            'certificat' => $certificat,
            'form' => $form,
            'controller_name' => 'Crée une certificat'
        ]);
    }

    /**
     * @Route("/{id}", name="certificat_show", methods={"GET"})
     */
    public function show(Certificat $certificat): Response
    {
        return $this->render('certificat/show.html.twig', [
            'certificat' => $certificat,
            'controller_name' => 'Détail du certificat'

        ]);
    }

    /**
     * @Route("/{id}/edit", name="certificat_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Certificat $certificat): Response
    {
        $form = $this->createForm(CertificatType::class, $certificat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('certificat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('certificat/edit.html.twig', [
            'certificat' => $certificat,
            'form' => $form,
            'controller_name' => 'Modifier une certificat'

        ]);
    }

    /**
     * @Route("/{id}", name="certificat_delete", methods={"POST"})
     */
    public function delete(Request $request, Certificat $certificat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$certificat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($certificat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('certificat_index', [], Response::HTTP_SEE_OTHER);
    }
}
