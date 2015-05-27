<?php

namespace FrontOfficeEmploiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeEmploiBundle\Entity\Cuvitae;
use FrontOfficeEmploiBundle\Entity\MotivationLetter;
use FrontOfficeEmploiBundle\Form\CuvitaeType;
use FrontOfficeEmploiBundle\Form\MotivationLetterType;
use Symfony\Component\HttpFoundation\Request;

class CandidatController extends Controller
{
	public function createCVAction(Request $request)
	{
		$em = $this -> getDoctrine()-> getManager();
		$cv = new Cuvitae();
		$formCv = $this -> createForm(new CuvitaeType(), $cv);

		$formCv -> handleRequest($request);

		if($formCv -> isValid())
		{
			$em -> persist($cv);
			$em -> flush();

			return $this -> redirect($this -> generateUrl('front_office_homepage_homepage'));
		}

		return $this -> render('FrontOfficeEmploiBundle:Candidat:createCV.html.twig', array('formCV' => $formCv -> createView()));
	}

	public function createLMAction(Request $request)
	{
		$em = $this -> getDoctrine()->getManager();
		$lm = new MotivationLetter();
		$formLm = $this -> createForm(new MotivationLetterType(), $lm);

		$formLm -> handleRequest($request);

		if($formLm -> isValid())
		 {
		 	$lm -> setDateCreated(new \DateTime('now'));
		 	$em -> persist($lm);
		 	$em -> flush();

		 	return $this -> redirect($this -> generateUrl('front_office_homepage_homepage'));
		 }

		return $this -> render('FrontOfficeEmploiBundle:Candidat:createLM.html.twig', array('formLm'=> $formLm -> createView())) ;
	}
}