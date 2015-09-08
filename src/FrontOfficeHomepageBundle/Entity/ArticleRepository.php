<?php

namespace FrontOfficeHomepageBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends EntityRepository
{
	public function getArticles()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT a 
			FROM FrontOfficeHomepageBundle:Article a
			ORDER BY a.dateCreated DESC ')
		->setMaxResults(4);

		return $query -> getResult();
	}

	public function triArticlesByCategory($category)
	{
		$query = $this -> getEntityManager()-> createQuery('
			SELECT a 
			FROM FrontOfficeHomepageBundle:Article a 
			JOIN a.category c 
			WHERE c.name LIKE :category')
		->setParameter('category', $category);

		return $query -> getResult();
	}
}
