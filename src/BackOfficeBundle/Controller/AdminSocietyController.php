<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeEmploiBundle\Entity\Society;
use FrontOfficeEmploiBundle\Form\SocietyType;
use Symfony\Component\HttpFoundation\Request;

class AdminSocietyController extends Controller
{
	public function triSocietyAction()
	{
		$em = $this -> getDoctrine()->getmanager();
		$triSociety = $em -> getRepository('FrontOfficeEmploiBundle:Society') -> triSociety();

		return $this -> render('BackOfficeBundle:AdminSociety:triSociety.html.twig', 
			array('triSociety' => $triSociety));
	}

	public function editAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getmanager();
		$society = $em -> getRepository('FrontOfficeEmploiBundle:Society') -> find($id);
		$formSociety = $this -> createForm(new SocietyType(), $society);

		$formSociety -> handleRequest($request);
		if($formSociety -> isValid())
		{
			$society -> setdateUpdated(new \datetime('now'));
			$em -> persist($society);
			$em -> flush();

			return $this -> redirect($this->generateUrl('back_office_adminSociety_list'));
		}

		return $this -> render('BackOfficeBundle:AdminSociety:edit.html.twig', 
			array('formSociety' => $formSociety ->createView()));
	}


}