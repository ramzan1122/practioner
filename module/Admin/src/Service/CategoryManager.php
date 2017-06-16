<?php

namespace Admin\Service;

use Admin\Entity\Category;
use Zend\Math\Rand;

/**
 * This service is responsible for adding/editing categorys
 * and changing category password.
 */
class CategoryManager {

    /**
     * Doctrine entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Constructs the service.
     */
    public function __construct($entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * This method adds a new category.
     */
    public function addCategory($data) {
        // Do not allow several categorys with the same title address.
        if ($this->checkCategoryExists($data['title'])) {
            throw new \Exception("Category with title address " . $data['$title'] . " already exists");
        }
        
        // Create new Category entity.
        $category = new Category();
        $category->setTitle($data['title']);
        $category->setParentId($data['parent_id']);
        $category->setStatus($data['status']);

        $currentDate = date('Y-m-d H:i:s');
        $category->setDateCreated($currentDate);

        // Add the entity to the entity manager.
        $this->entityManager->persist($category);

        // Apply changes to database.
        $this->entityManager->flush();

        return $category;
    }

    /**
     * This method updates data of an existing category.
     */
    public function updateCategory($category, $data) {
        // Do not allow to change category title if another category with such title already exits.
        if ($category->getTitle() != $data['title'] && $this->checkCategoryExists($data['title'])) {
            throw new \Exception("Another category with title address " . $data['title'] . " already exists");
        }

        $category->setTitle($data['title']);
        $category->setStatus($data['status']);

        // Apply changes to database.
        $this->entityManager->flush();
        return true;
    }

    /**
     * Checks whether an active category with given title address already exists in the database.     
     */
    public function checkCategoryExists($title) {

        $category = $this->entityManager->getRepository(Category::class)
                ->findOneByTitle($title);

        return $category !== null;
    }

    public function deleteCategory($category) {        
        $this->entityManager->remove($category);
        $this->entityManager->flush();
    }

    
     
    
}
