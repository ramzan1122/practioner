<?php
namespace Admin\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Entity\Qualification;
use Admin\Form\QualificationForm;
use Zend\Mvc\MvcEvent;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;
/**
 * This controller is responsible for user management (adding, editing, 
 * viewing users and changing user's password).
 */
class QualificationController extends AbstractActionController 
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
    private $qualificationManager;
    
    /**
     * Constructor. 
     */
    public function __construct($entityManager, $qualificationManager)
    {
        $this->entityManager = $entityManager;
        $this->qualificationManager = $qualificationManager;
    }
    public function onDispatch(MvcEvent $e) {
        // Call the base class' onDispatch() first and grab the response
        $response = parent::onDispatch($e);
        $this->layout()->controllerName = 'qualification';
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
        $qualifications_query = $this->entityManager->getRepository(Qualification::class)
                ->getAllQualifications();
        
        $adapter = new DoctrineAdapter(new ORMPaginator($qualifications_query, false));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(ADMIN_PER_PAGE);        
        $paginator->setCurrentPageNumber($page);
        
        return new ViewModel([
            'qualifications' => $paginator
        ]);
    } 
    
    /**
     * This action displays a page allowing to add a new user.
     */
    public function addAction()
    {
        // Create user form
        $form = new QualificationForm('create', $this->entityManager);
        
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
                $qualification = $this->qualificationManager->addQualification($data);
                
                // Redirect to "view" page
                return $this->redirect()->toRoute('qualification', 
                        ['action'=>'view', 'id'=>$qualification->getId()]);                
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
        $qualification = $this->entityManager->getRepository(Qualification::class)
                ->find($id);
        
        if ($qualification == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
                
        return new ViewModel([
            'qualification' => $qualification
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
        
        $qualification = $this->entityManager->getRepository(Qualification::class)
                ->find($id);
        
        if ($qualification == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        // Create user form
        $form = new QualificationForm('update', $this->entityManager, $qualification);
          
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
                $this->qualificationManager->updateQualification($qualification, $data);
                
                // Redirect to "view" page
                return $this->redirect()->toRoute('qualification', 
                        ['action'=>'view', 'id'=>$qualification->getId()]);                
            }               
        } else {
            $form->setData(array(
                    'qualification'=>$qualification->getQualification(),
                ));
        }
        
        return new ViewModel(array(
            'qualification' => $qualification,
            'form' => $form
        ));
    }
    
    
    
    
    /**
     * This action displays an informational message page. 
     * For example "Your password has been resetted" and so on.
     */
    public function messageAction() 
    {
        // Get message ID from route.
        $id = (string)$this->params()->fromRoute('id');
        
        // Validate input argument.
        if($id!='invalid-email' && $id!='sent' && $id!='set' && $id!='failed') {
            throw new \Exception('Invalid message ID specified');
        }
        
        return new ViewModel([
            'id' => $id
        ]);
    }
    
    
}
