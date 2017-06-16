<?php
namespace Admin\Repository;

use Doctrine\ORM\EntityRepository;
use Admin\Entity\Practice;

/**
 * This is the custom repository class for Post entity.
 */
class PracticeRepository extends EntityRepository
{
    public function getAllPractices()
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('p')
            ->from(Practice::class, 'p')
            ->orderBy('p.dateCreated', 'DESC');
            return $queryBuilder->getQuery();
    }   
}