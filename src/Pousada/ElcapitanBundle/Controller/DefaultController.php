<?php

namespace Pousada\ElcapitanBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Pousada\ElcapitanBundle\Entity\Issue;
use Pousada\ElcapitanBundle\Form\IssueType;
use Pousada\ElcapitanBundle\Form\ContactType;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class DefaultController extends Controller
{
    /**
     * @Route("/accueil")
     * @Template()
	 * @#Security("has_role('ROLE_AUTEUR')")
	 * 
     */
    public function indexAction()
    {
    	
		// On vérifie que l'utilisateur dispose bien du rôle ROLE_AUTEUR
		/*if (!$this->get('security.context')->isGranted('ROLE_AUTEUR')) {
		  // Sinon on déclenche une exception « Accès interdit »
		  throw new AccessDeniedException('Accès limité aux auteurs.');
		}*/
		/*if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
	      //return $this->redirect($this->generateUrl('/accueil'));
	      echo 'you are already connected';
	    }*/
		

		$em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PousadaElcapitanBundle:Issue')->findAll();

        return array(
            'entities' => $entities,
        );
    }
	
	/**
     * @Route("/contact")
     * @Template()
     */
    public function contactAction()
    {
    	$form = $this->get('form.factory')->create(new ContactType());
		
    	$request = $this->get('request');
		
		// Check the method
        if ($request->getMethod() == 'POST')
        {
            // Bind value with form
            $form->bindRequest($request);
            $data = $form->getData();
            $message = \Swift_Message::newInstance()
                ->setContentType('text/html')
                ->setSubject($data['subject'])
                ->setFrom($data['email'])
                ->setTo('lucianahembert@gmail.com')
                ->setBody($data['content']);
            $this->get('mailer')->send($message);
            // Launch the message flash
            $this->get('session')->setFlash('notice', 'Merci de nous avoir contacté, nous répondrons à vos questions dans les plus brefs délais.');
        }
		
		 

		
		
    	/*$form = $this->createFormBuilder()
            ->add('titre', 'text')
            ->getForm();
    	return $this->render('PousadaElcapitanBundle:Default:contact.html.twig', array(
            'form' => $form->createView(),
        ));*/
        
        return $this->render('PousadaElcapitanBundle:Default:contact.html.twig', array(
            'form' => $form->createView(),
        ));
		

        return array();
    }
	
	/**
     * @Route("/photos")
     * @Template()
     */
    public function photosAction()
    {
    	$em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PousadaElcapitanBundle:Issue')->findAll();

        return array(
            'entities' => $entities,
        );
        
    }
	
	/**
     * @Route("/presentation")
     * @Template()
     */
    public function presentationAction()
    {
    	$em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PousadaElcapitanBundle:Issue')->findAll();

        return array(
            'entities' => $entities,
        );
        
    }
}
