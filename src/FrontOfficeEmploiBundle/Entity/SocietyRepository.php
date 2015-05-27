<?php

namespace FrontOfficeEmploiBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * SocietyRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SocietyRepository extends EntityRepository
{
	public function getSociety()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT s 
			FROM FrontOfficeEmploiBundle:Society s 
			WHERE s.hiringState = true 
			ORDER BY s.dateCreated DESC')
		->setMaxResults(1);

		return $query -> getSingleResult();
	}
}
