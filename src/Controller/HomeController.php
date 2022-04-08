<?php

namespace App\Controller;

use App\Repository\CandidatRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'Acceuil',
        ]);
    }
    /**
     * @Route("/archive", name="archive_index")
     */
    public function archive(CandidatRepository $candidatRepository): Response
    {
        $candidats = $candidatRepository->findBy(
            [],
            ['id' => 'DESC'],
        );
        return $this->render('candidat/archive.html.twig', [
            'candidats'=>$candidats,
            'controller_name'=>'Listes des candidats archivés'
        ]);
    }


    /**
     * @Route("/", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
         if ($this->getUser()) {
             return $this->redirectToRoute('home');
         }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername, 
            'error' => $error,
            'controller_name'=>'Login'
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
