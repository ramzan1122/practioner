<?php
namespace Admin\Repository;

use Doctrine\ORM\EntityRepository;
use Admin\Entity\User;

/**
 * This is the custom repository class for Post entity.
 */
class UserRepository extends EntityRepository
{
    public function getAllUsers()
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('p')
            ->from(User::class, 'p')
            ->where('p.status = ?1')
            ->orderBy('p.dateCreated', 'DESC')
            ->setParameter('1', User::STATUS_ACTIVE);

            return $queryBuilder->getQuery();
    }   
}