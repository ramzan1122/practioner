<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Entity\Category;
use Zend\Mvc\MvcEvent;
use Admin\Form\CategoryForm;

/**
 * This controller is responsible for Category management (adding, editing, 
 * viewing Categorys and changing Category's password).
 */
class CategoryController extends AbstractActionController {

    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Category manager.
     * @var Admin\Service\CategoryManager 
     */
    private $categoryManager;

    /**
     * Constructor. 
     */
    public function __construct($entityManager, $categoryManager) {
        $this->entityManager = $entityManager;
        $this->CategoryManager = $categoryManager;
    }

    public function onDispatch(MvcEvent $e) {
        // Call the base class' onDispatch() first and grab the response
        $response = parent::onDispatch($e);
        $this->layout()->controllerName = 'category';
        // Set alternative layout
        $this->layout()->setTemplate('layout/layout-admin');

        // Return the response
        return $response;
    }

    /**
     * This is the default "index" action of the controller. It displays the 
     * list of Category.
     */
    public function indexAction() {
        $categories = $this->entityManager->getRepository(Category::class)
                ->findBy([], ['id' => 'ASC']);
        //print_r($categories);exit;
        return new ViewModel([
            'Category' => $categories
        ]);
    }

    /**
     * This action displays a page allowing to add a new Category.
     */
    public function addAction() {
        // Create Category form
        $form = new CategoryForm('create', $this->entityManager);

        // Check if Category has submitted the form
        if ($this->getRequest()->isPost()) {

            // Fill in the form with POST data
            $data = $this->params()->fromPost();

            $form->setData($data);

            // Validate form
            if ($form->isValid()) {

                // Get filtered and validated data
                $data = $form->getData();

                // Add Category.
                $category = $this->CategoryManager->addCategory($data);

                // Redirect to "view" page
                return $this->redirect()->toRoute('category', ['action' => 'index']);
            }
        }

        return new ViewModel([
            'form' => $form
        ]);
    }

    /**
     * The "view" action displays a page allowing to view Category's details.
     */
    public function viewAction() {
        $id = (int) $this->params()->fromRoute('id', -1);
        if ($id < 1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        // Find a Category with such ID.
        $category = $this->entityManager->getRepository(Category::class)
                ->find($id);

        if ($category == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        return new ViewModel([
            'Category' => $category
        ]);
    }

    /**
     * The "edit" action displays a page allowing to edit Category.
     */
    public function editAction() {
        $id = (int) $this->params()->fromRoute('id', -1);
        if ($id < 1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $category = $this->entityManager->getRepository(Category::class)
                ->find($id);

        if ($category == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        // Create Category form
        $form = new CategoryForm('update', $this->entityManager, $category);

        // Check if Category has submitted the form
        if ($this->getRequest()->isPost()) {

            // Fill in the form with POST data
            $data = $this->params()->fromPost();

            $form->setData($data);

            // Validate form
            if ($form->isValid()) {

                // Get filtered and validated data
                $data = $form->getData();

                // Update the Category.
                $this->CategoryManager->updateCategory($category, $data);

                // Redirect to "view" page
                return $this->redirect()->toRoute('category', ['action' => 'view', 'id' => $category->getId()]);
            }
        } else {
            $form->setData(array(
                'title' => $category->getTitle(),
                'date_created' => $category->getDateCreated(),
                'status' => $category->getStatus(),
            ));
        }

        return new ViewModel(array(
            'Category' => $category,
            'form' => $form
        ));
    }

    /**
     * This action delete a category.
     */
    public function deleteAction() {

        // Check if Category has submitted the form
        if ($this->getRequest()->isPost()) {
            $id = $_POST['id'];
            $category = $this->entityManager->getRepository(Category::class)->findOneById($id);
            $this->CategoryManager->deleteCategory($category);
        }
        return true;
    }

}
