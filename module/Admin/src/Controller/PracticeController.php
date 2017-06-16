<?php
namespace Admin\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Entity\Practice;
use Admin\Form\PracticeForm;
use Zend\Mvc\MvcEvent;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;
/**
 * This controller is responsible for user management (adding, editing, 
 * viewing users and changing user's password).
 */
class PracticeController extends AbstractActionController 
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;
    
    /**
     * User manager.
     * @var Admin\Service\PracticeManager 
     */
    private $practiceManager;
    
    /**
     * Constructor. 
     */
    public function __construct($entityManager, $practiceManager)
    {
        $this->entityManager = $entityManager;
        $this->practiceManager = $practiceManager;
    }
    public function onDispatch(MvcEvent $e) {
        // Call the base class' onDispatch() first and grab the response
        $response = parent::onDispatch($e);
        $this->layout()->controllerName = 'practice';
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
        $all_practice_query = $this->entityManager->getRepository(Practice::class)
                ->getAllPractices();
        
         $adapter = new DoctrineAdapter(new ORMPaginator($all_practice_query, false));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(ADMIN_PER_PAGE);        
        $paginator->setCurrentPageNumber($page);
        
        return new ViewModel([
            'practices' => $paginator
        ]);
    } 
    
    /**
     * This action displays a page allowing to add a new user.
     */
    public function addAction()
    {
        // Create user form
        $form = new PracticeForm('create', $this->entityManager);
        
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
                $practice = $this->practiceManager->addPractice($data);
                
                // Redirect to "view" page
                return $this->redirect()->toRoute('practice', 
                        ['action'=>'view', 'id'=>$practice->getId()]);                
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
        $qualification = $this->entityManager->getRepository(Practice::class)
                ->find($id);
        
        if ($qualification == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
                
        return new ViewModel([
            'practice' => $qualification
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
        
        $practice = $this->entityManager->getRepository(Practice::class)
                ->find($id);
        
        if ($practice == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        // Create user form
        $form = new PracticeForm('update', $this->entityManager, $practice);
          
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
                $this->practiceManager->updatePractice($practice, $data);
                
                // Redirect to "view" page
                return $this->redirect()->toRoute('practice', 
                        ['action'=>'view', 'id'=>$practice->getId()]);                
            }               
        } else {
            $form->setData(array(
                    'practice_name'=>$practice->getPracticeName(),
                    'description'=>$practice->getDescription(),
                    'address'=>$practice->getAddress(),
                    'state'=>$practice->getState(),
                    'suburb'=>$practice->getSuburb(),
                    'postal_code'=>$practice->getPostalCode(),
                    'languages'=>$practice->getPhoneNumber(),
                    'phone_number'=>$practice->getLanguages(),
                    'latitude'=>$practice->getLatitude(),
                    'longitude'=>$practice->getLongitude()
               ));
        }
        
        return new ViewModel(array(
            'practice' => $practice,
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
