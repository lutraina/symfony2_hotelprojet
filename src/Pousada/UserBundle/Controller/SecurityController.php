<?php
// src/Pousada/UserBundle/Controller/SecurityController.php;

namespace Pousada\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class SecurityController extends Controller
{
  public function loginAction(Request $request)
  {
    // Si le visiteur est déjà identifié, on le redirige vers l'accueil
    if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
      //return $this->redirect($this->generateUrl('/accueil'));
      echo 'you are already connected';
    }

    $session = $request->getSession();

    // On vérifie s'il y a des erreurs d'une précédente soumission du formulaire
    if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
      $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
    } else {
      $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
      $session->remove(SecurityContext::AUTHENTICATION_ERROR);
    }


/*	//get user name

	// On récupère le service
	$security = $container->get('security.context');
	
	// On récupère le token
	$token = $security->getToken();
	
	// Si la requête courante n'est pas derrière un pare-feu, $token est null
	
	// Sinon, on récupère l'utilisateur
	$user = $token->getUser();
	
	// Si l'utilisateur courant est anonyme, $user vaut « anon. »
	
	// Sinon, c'est une instance de notre entité User, on peut l'utiliser normalement
	$user->getUsername();
	*/
	
	$user = $this->getUser();
	if (null === $user) {
	  // Ici, l'utilisateur est anonyme ou l'URL n'est pas derrière un pare-feu
	} else {
	  // Ici, $user est une instance de notre classe User
	}

    return $this->render('PousadaUserBundle:Security:login.html.twig', array(
      // Valeur du précédent nom d'utilisateur entré par l'internaute
      'last_username' => $session->get(SecurityContext::LAST_USERNAME),
      'username' => $user,
      'error'         => $error,
    ));
  }
}