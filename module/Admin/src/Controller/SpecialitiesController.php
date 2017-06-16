<?php
namespace Admin\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Entity\Specialities;
use Admin\Form\SpecialitiesForm;
use Zend\Mvc\MvcEvent;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;
/**
 * This controller is responsible for user management (adding, editing, 
 * viewing users and changing user's password).
 */
class SpecialitiesController extends AbstractActionController 
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;
    
    /**
     * User manager.
     * @var Admin\Service\UserManager 
     */
    private $specialitiesManager;
    
    /**
     * Constructor. 
     */
    public function __construct($entityManager, $specialitiesManager)
    {
        $this->entityManager = $entityManager;
        $this->specialitiesManager = $specialitiesManager;
    }
    public function onDispatch(MvcEvent $e) {
       
        // Call the base class' onDispatch() first and grab the response
        $response = parent::onDispatch($e);
        $this->layout()->controllerName = 'specialities';
        // Set alternative layout
        $this->layout()->setTemplate('layout/layout-admin');

        // Return the response
        return $response;
    }
    
    /**
     * This is the default "index" action of the controller. It displays the 
     * list of users.
     */
    public function indexAction() 
    {
       $page = $this->params()->fromQuery('page', 1);
        $specialities_query = $this->entityManager->getRepository(Specialities::class)
                ->getAllSpecialities();
        
        $adapter = new DoctrineAdapter(new ORMPaginator($specialities_query, false));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(ADMIN_PER_PAGE);        
        $paginator->setCurrentPageNumber($page);
        
        return new ViewModel([
            'specialities' => $paginator
        ]);
    } 
    
    /**
     * This action displays a page allowing to add a new user.
     */
    public function addAction()
    {
        // Create user form
        $form = new SpecialitiesForm('create', $this->entityManager);
        
        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {
            
            // Fill in the form with POST data
            $data = $this->params()->fromPost();            
            
            $form->setData($data);
            
            // Validate form
            if($form->isValid()) {
                
                // Get filtered and validated data
                $data = $form->getData();
                
//                echo '<pre>';
//                var_dump($data);
//                die();
                
                // Add user.
                $speciality = $this->specialitiesManager->addSpeciality($data);
                
                // Redirect to "view" page
                return $this->redirect()->toRoute('specialities', 
                        ['action'=>'view', 'id'=>$speciality->getId()]);                
            }               
        } 
        
        return new ViewModel([
                'form' => $form
            ]);
    }
    
    /**
     * The "view" action displays a page allowing to view user's details.
     */
    public function viewAction() 
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        // Find a user with such ID.
        $speciality = $this->entityManager->getRepository(Specialities::class)
                ->find($id);
        
        if ($speciality == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
                
        return new ViewModel([
            'speciality' => $speciality
        ]);
    }
    
    /**
     * The "edit" action displays a page allowing to edit user.
     */
    public function editAction() 
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        $speciality = $this->entityManager->getRepository(Specialities::class)
                ->find($id);
        

        
        if ($speciality == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        // Create user form
        $form = new SpecialitiesForm('update', $this->entityManager, $speciality);
        
               
        
        
        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {
            
            // Fill in the form with POST data
            $data = $this->params()->fromPost();            
            
            $form->setData($data);
            
            // Validate form
            if($form->isValid()) {
                
                // Get filtered and validated data
                $data = $form->getData();
                
                // Update the user.
                $this->specialitiesManager->updateSpeciality($speciality, $data);
                
                // Redirect to "view" page
                return $this->redirect()->toRoute('specialities', 
                        ['action'=>'view', 'id'=>$speciality->getId()]);                
            }               
        } else {
            $form->setData(array(
                    'speciality'=>$speciality->getSpeciality(),
                ));
        }
        
        return new ViewModel(array(
            'speciality' => $speciality,
            'form' => $form
        ));
    }
    
    
}
