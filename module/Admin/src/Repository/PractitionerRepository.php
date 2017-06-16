<?php
namespace Admin\Repository;

use Doctrine\ORM\EntityRepository;
use Admin\Entity\Practitioner;

/**
 * This is the custom repository class for Post entity.
 */
class PractitionerRepository extends EntityRepository
{
    public function getAllPractioners()
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('p')
            ->from(Practitioner::class, 'p')
            ->orderBy('p.dateCreated', 'DESC');
            return $queryBuilder->getQuery();
    }   
}