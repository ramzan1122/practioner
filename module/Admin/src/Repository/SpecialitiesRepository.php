<?php
namespace Admin\Repository;

use Doctrine\ORM\EntityRepository;
use Admin\Entity\Specialities;

/**
 * This is the custom repository class for Post entity.
 */
class SpecialitiesRepository extends EntityRepository
{
    public function getAllSpecialities()
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('p')
            ->from(Specialities::class, 'p')
            ->orderBy('p.dateCreated', 'DESC');

            return $queryBuilder->getQuery();
    }   
}