<?php
//gerer les erreur d'accees non autoriser
namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;

class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
    public function handle(Request $request, AccessDeniedException $accessDeniedException)
    {
        // ...
        return new Response(
            '<p> Vous n\'avez pas l\'endroit d\'acceder à cette page !!!<a href="/">clicker ici pour retouner au Acceuil</a>'
        );
    }
}
