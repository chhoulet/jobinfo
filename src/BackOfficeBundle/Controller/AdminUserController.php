<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeUserBundle\Entity\User;

class AdminUserController extends Controller
{
	public function statsUsersAction()
	{
		$em = $this -> getDoctrine()->getManager();	
		$nbCommentsByUser = $em -> getRepository('FrontOfficeUserBundle:User')->getNbCommentsByUser();
		$usersByNbResponses = $em -> getRepository('FrontOfficeUserBundle:User')->getUsersByNbResponses();

		return $this -> render('BackOfficeBundle:AdminUser:statsUsers.html.twig', 
			array('nbCommentsByUser'  => $nbCommentsByUser,
				  'usersByNbResponses'=> $usersByNbResponses));
	}
}