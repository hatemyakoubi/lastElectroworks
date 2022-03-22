<?php

namespace App\Controller;

use App\Entity\Paiement;
use Doctrine\ORM\Mapping\Id;
use App\Repository\CoursRepository;
use App\Repository\CandidatRepository;
use App\Repository\CertificatRepository;
use App\Repository\PaiementRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints\Length;

class StatistiqueController extends AbstractController
{
    
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/statistique", name="statistique")
     */
    public function statistique(CoursRepository $coursRepository, PaiementRepository $PaiementRepository,
    CertificatRepository $CertificatRepository): Response
    {
        //candidat par cours
        $cours = $coursRepository->findAll();
        
        $courNom = [];
        $CandidatParCours = [];
        $colorColor = [];
      
        foreach ($cours as $c) {
            $courNom[] = $c->getNom();
            $CandidatParCours[] = count($c->getCandidats());
            $colorColor[] = $c->getColor();
        }
       //candidats certifiés
        $certificats = $CertificatRepository->CandidatCertifie();
        //dd($certificats);
        $CertSpicialte = [];
        $CandidatParCertifict = [];

        foreach ($certificats as $c) {
            $CertSpicialte[] =  $c['specialite'];
            $CandidatParCertifict[] = $c['spec'];
        }
        //paiement par date
        $paiements = $PaiementRepository->sumByDate();

        $DatePaiment= [];
        $MontPaiment = [];

        foreach ($paiements as $paiment) {
            $DatePaiment[] = $paiment['datePaiement'];
            $MontPaiment[] = $paiment['montant'];
        }
        return $this->render('statistique/statistique.html.twig', [
            'controller_name' => 'Statistique',
            'coursNom'=>json_encode($courNom),
            'CandidatParCours'=>json_encode($CandidatParCours),
            'color'=>json_encode($colorColor),
            'couleur'=>json_encode($colorColor),
            'DatePaiment'=>json_encode($DatePaiment),
            'MontPaiement'=>json_encode($MontPaiment),
            'paiement'=>$paiements,
            'CertSpicialte'=>json_encode($CertSpicialte),
            'CandidatParCertificat'=>json_encode($CandidatParCertifict),

        ]);
    }
}
