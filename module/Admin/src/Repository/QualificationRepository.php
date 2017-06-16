<?php
namespace Admin\Repository;

use Doctrine\ORM\EntityRepository;
use Admin\Entity\Qualification;

/**
 * This is the custom repository class for Post entity.
 */
class QualificationRepository extends EntityRepository
{
    public function getAllQualifications()
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('p')
            ->from(Qualification::class, 'p')
            ->orderBy('p.dateCreated', 'DESC');

            return $queryBuilder->getQuery();
    }   
}