<?php

namespace FrontOfficeEmploiBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CandidatRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CandidatRepository extends EntityRepository
{
	public function nbCandidats()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT COUNT(c.id)
			FROM FrontOfficeEmploiBundle:Candidat c
			');

		return $query -> getSingleScalarResult();
	}

	public function getCandidatByUser($user = null)
	{
		$query = $this -> getEntityManager()-> createQuery('
			SELECT c 
			FROM FrontOfficeEmploiBundle:Candidat c 
			JOIN c.user u 
			WHERE u.id LIKE :id
			AND u.personnalSpaceActive = true')
		->setParameter('id', $user);

		return $query -> getSingleResult();
	}
}
