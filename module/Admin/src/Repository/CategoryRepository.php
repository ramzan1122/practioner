<?php
namespace Admin\Repository;

use Doctrine\ORM\EntityRepository;
use Admin\Entity\Category;

/**
 * This is the custom repository class for Post entity.
 */
class CategoryRepository extends EntityRepository
{
    /**
     * Retrieves all published posts in descending date order.
     * @return Query
     */public function getAllCategories()
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('p')
            ->from(Category::class, 'p')
            ->where('p.status = ?1')
            ->orderBy('p.dateCreated', 'DESC')
            ->setParameter('1', Category::STATUS_ACTIVE);

            return $queryBuilder->getQuery();
    }
   
    public function getCategories($parent, $level, $sel,$html='') {
        
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        
        $queryBuilder->select('p')
            ->from(Category::class, 'p')
            ->where('p.status = 1')
            ->where('p.parentId ='.$parent);
        $query = $queryBuilder->getQuery();
      
        $result = $query->getArrayResult();    
        
        
         if (count($result) > 0) {
             
             
            foreach ($result as $row) {
                
                if ($row['id']== $sel) {
                    $seletd = 'selected="selected"';
                } else {
                    $seletd = '';
                }
                $html .= '<option data-attr="'.$row['parentId'].'" value="' . $row['id'] . '" ' . $seletd . '>' . str_repeat('-', $level) . ' ' . $row['title'] . '</option>';

                $html = $this->getCategories($row['id'], $level + 1, $sel,$html);
            }
        }
        
        return $html;
    }
   
          
}