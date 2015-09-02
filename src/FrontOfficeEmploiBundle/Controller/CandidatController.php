<?php

namespace FrontOfficeEmploiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeEmploiBundle\Entity\Cuvitae;
use FrontOfficeEmploiBundle\Entity\Candidat;
use FrontOfficeEmploiBundle\Entity\ResponseJobOffer;
use FrontOfficeEmploiBundle\Entity\MotivationLetter;
use FrontOfficeEmploiBundle\Form\CuvitaeType;
use FrontOfficeEmploiBundle\Form\CandidatType;
use FrontOfficeEmploiBundle\Form\MotivationLetterType;
use FrontOfficeEmploiBundle\Form\ResponseJobOfferType;
use Symfony\Component\HttpFoundation\Request;

class CandidatController extends Controller
{	
	#Creation de l'objet CV, function accessible aux personnes loguées + message flash: 
	public function createCVAction(Request $request)
	{
		$em = $this -> getDoctrine()-> getManager();
		$session = $request -> getSession();
		$cv = new Cuvitae();
		$formCv = $this -> createForm(new CuvitaeType(), $cv);

		$formCv -> handleRequest($request);

		if($formCv -> isValid())
		{
			$cv -> setUser($this->getUser());
			$em -> persist($cv);
			$em -> flush();

			$session -> getFlashbag()-> add('notice','Votre CV est bien ajouté dans la base !');
			return $this -> redirect($this -> generateUrl('front_office_homepage_homepage'));
		}

		return $this -> render('FrontOfficeEmploiBundle:Candidat:createCV.html.twig', array('formCV' => $formCv -> createView()));
	}

	#Creation de l'objet LM, function accessible aux personnes loguées + message flash: 
	public function createLMAction(Request $request)
	{
		$em = $this -> getDoctrine()->getManager();
		$session = $request ->getSession();
		$lm = new MotivationLetter();
		$formLm = $this -> createForm(new MotivationLetterType(), $lm);

		$formLm -> handleRequest($request);

		if($formLm -> isValid())
		 {		 	
		 	$lm -> setDateCreated(new \DateTime('now'));	
		 	$lm -> setUser($this -> getUser());
		 	$em -> persist($lm);
		 	$em -> flush();

		 	$session -> getFlashbag()-> add('succes','Votre lettre de motivation est bien enregistrée !');
		 	return $this -> redirect($this -> generateUrl('front_office_homepage_homepage'));
		 }

		return $this -> render('FrontOfficeEmploiBundle:Candidat:createLM.html.twig', array('formLm'=> $formLm -> createView())) ;
	}

	# Suppression d'un CV + message flash + redirection sur la meme page
	public function deleteCvAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$session = $request -> getSession();
		$deletedCv = $em -> getRepository('FrontOfficeEmploiBundle:Cuvitae') -> find($id);
		$em -> remove($deletedCv);
		$em -> flush();

		$session -> getFlashbag()->add('succes','Ce cv est supprimé de votre espace personnel !');
		return $this -> redirect($request -> headers -> get('referer'));
	}

	# Suppression d'une LM + message flash + redirection sur la meme page
	public function deleteLmAction(Request $request, $id)
	{
		$em = $this ->getDoctrine()->getManager();
		$deletedLm = $em -> getRepository('FrontOfficeEmploiBundle:MotivationLetter')->find($id);
		$session = $request -> getSession();
		$em -> remove($deletedLm);
		$em -> flush();

		$session ->getFlashbag()-> add('suppLm', 'Cette lettre de motivation est bien supprimée');
		return $this ->redirect($request -> headers -> get('referer'));
	}

	# Mise à jour d'un CV + message flash 
	public function updateCvAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$session = $request -> getSession();
		$updatedCv = $em -> getRepository('FrontOfficeEmploiBundle:Cuvitae') -> find($id);
		$form = $this -> createForm(new CuvitaeType(), $updatedCv);

		$form -> handleRequest($request);

		if ($form -> isValid()){
			$updatedCv -> setDateUpdated(new \DateTime('now'));
			$em -> flush();

			$session -> getFlashbag()-> add('notice','Votre CV est bien mis à jour !');
			return $this -> redirect($this -> generateUrl('front_office_emploi_candidat_showMyCv'));
		}

		return $this -> render('FrontOfficeEmploiBundle:Candidat:createCV.html.twig', array('formCV' => $form -> createView()));
	}

	#Creation de l'objet Candidat, function accessible aux personnes loguées + message flash: 
	public function newAction(Request $request)
	{
		$em = $this -> getDoctrine()-> getManager();
		$candidat = new Candidat();
		$session = $request -> getSession();
		$form = $this -> createForm(new CandidatType(), $candidat);
		$form -> handleRequest($request);

		if($form -> isValid())
		{
			$candidat -> setSavedAt(new \DateTime('now'));
			$candidat -> setUser($this -> getUser());
			$em -> persist($candidat);
			$em -> flush();

			$session -> getFlashbag()->add('notice','Votre profil est bien enregistré dans notre site !');
			return $this -> redirect($this -> generateUrl('front_office_emploi_mon_profil'));
		}

		return $this -> render('FrontOfficeEmploiBundle:Candidat:new.html.twig', array('form'=>$form->createView()));
	}

	# Acces via son espace personnel a ses CV:
	public function showMyCvAction()
	{
		return $this ->render('FrontOfficeEmploiBundle:Candidat:showMyCv.html.twig');
	}

	# Acces via son espace personnel a ses LM:
	public function showMyLmAction()
	{		
		return $this -> render('FrontOfficeEmploiBundle:Candidat:showMyLm.html.twig');
	}	

	# Acces via son espace personnel uax events selectionnes:
	public function showMyInscriptionsAction()
	{
		return $this -> render('FrontOfficeEmploiBundle:Candidat:showMyInscriptions.html.twig');
	}
}