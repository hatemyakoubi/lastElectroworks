<?php

namespace App\Controller;

use DateTime;
use App\Entity\Candidat;
use App\Entity\Paiement;
use App\Entity\Certificat;
use App\Form\CandidatType;
use App\Form\PaiementType;
use App\Form\CertificatType;
use App\Form\CandidatEditType;
use Doctrine\ORM\Mapping\OrderBy;
use App\Form\CandidatPaiementType;
use App\Repository\CandidatRepository;
use App\Repository\PaiementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @IsGranted("ROLE_USER")
 * @Route("/candidat")
 */
class CandidatController extends AbstractController
{
    /**
     * @Route("/", name="candidat_index", methods={"GET"})
     */
    public function index(CandidatRepository $candidatRepository): Response
    {
        $candidats = $candidatRepository->findBy([],['id' => 'DESC']);
        return $this->render('candidat/index.html.twig', [
            'candidats'=>$candidats,
            'controller_name'=>'Listes des candidats'
        ]);
    }

    /**
     * @Route("/new", name="candidat_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $candidat = new Candidat();
        $form = $this->createForm(CandidatType::class, $candidat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($candidat);
            $entityManager->flush();
            $this->addFlash('success', 'Un nouveau candidat à été ajouter avec succès');


            return $this->redirectToRoute('candidat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('candidat/new.html.twig', [
            'candidat' => $candidat,
            'form' => $form,
            'controller_name'=>'Nouveau candidat',
            
        ]);
    }

    /**
     * @Route("/{id}", name="candidat_show", methods={"GET"})
     */
    public function show(Candidat $candidat): Response
    {
        return $this->render('candidat/imprimeCandidat.html.twig', [
            'candidat' => $candidat,
            'controller_name'=>'Détail d\'un candidat'
        ]);
    }
    /**
     * @Route("/{id}/detail", name="candidat_detail", methods={"GET"})
     */
    public function Detail(Candidat $candidat): Response
    {
        return $this->render('candidat/show.html.twig', [
            'candidat' => $candidat,
            'controller_name'=>'Détail d\'un candidat'
        ]);
    }

    /**
     * @Route("/{id}/edit", name="candidat_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Candidat $candidat): Response
    {
        $form = $this->createForm(CandidatType::class, $candidat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Un candidat à été modifier avec succès');


            return $this->redirectToRoute('candidat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('candidat/edit.html.twig', [
            'candidat' => $candidat,
            'form' => $form,
            'controller_name'=>'Modifier un candidat'
        ]);
    }

    /**
     * @Route("/{id}", name="candidat_delete", methods={"POST"})
     */
    public function delete(Request $request, Candidat $candidat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$candidat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($candidat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('candidat_index', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route("/{id}/add-Paiement", name="candidat_paiement")
     */
    public function addPaiement(Request $request,CandidatRepository $CandidatRepository,PaiementRepository $PaiementRepository,$id)
    {
        $candidat = $CandidatRepository->find($id);
        $paiementID = $PaiementRepository->findBy([],['id'=>'DESC'],1);
        $pay = new Paiement();
        $form = $this->createForm(PaiementType::class,$pay);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pay ->setCandidat($candidat);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pay);
            $entityManager->flush();

            $this->addFlash('success', 'Un paiement à été ajouté avec succès');

            return $this->redirectToRoute('candidat_detail',['id'=>$candidat->getId()]);

        }
    
        return $this->render('candidat/affect.html.twig',[
            'candidat'=> $candidat,
            'paiementID'=>$paiementID,
            'date'=>new DateTime(),
            'form'=>$form->createView(),
            'controller_name'=>'Paiement',
        ]);
    }


    /**
     * @Route("/add_certificate/{id}", name="add_certificate", methods={"GET","POST"})
     */
    public function CandidatCertificate(Request $request, CandidatRepository $CandidatRepository,$id)
    {
        $certificat = new Certificat;

        $candidat = $CandidatRepository->find($id);

        $form = $this->createForm(CertificatType::class,$certificat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            //$candidat ->addCertificat($form->get('specialite')->getData());
            $certificat ->addCandidat($candidat);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($certificat);
            $entityManager->flush();

            $this->addFlash('success', 'Une certificat à été ajouté avec succès');

            return $this->redirectToRoute('candidatNoCertificated');

        }

        return $this->render('candidat/certificat.html.twig',[
            'candidat'=> $candidat,
            'form'=>$form->createView(),
            'controller_name'=>'Ajouter une certificat'
            
        ]);

    }
    
}
