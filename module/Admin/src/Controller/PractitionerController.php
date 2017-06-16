<?php
namespace Admin\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Entity\Practitioner;
use Admin\Form\PractitionerForm;
use Zend\Mvc\MvcEvent;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;
/**
 * This controller is responsible for Practitioner management (adding, editing,
 * viewing Practitioner).
 */
class PractitionerController extends AbstractActionController
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Practitioner manager.
     * @var Admin\Service\PractitionerManager
     */
    private $practitionerManager;

    /**
     * Constructor.
     */
    public function __construct($entityManager, $practitionerManager)
    {
        $this->entityManager = $entityManager;
        $this->practitionerManager = $practitionerManager;
    }
    public function onDispatch(MvcEvent $e) {
        // Call the base class' onDispatch() first and grab the response
        $response = parent::onDispatch($e);
        $this->layout()->controllerName = 'practitioner';
        // Set alternative layout
        $this->layout()->setTemplate('layout/layout-admin');

        // Return the response
        return $response;
    }

    /**
     * This is the default "index" action of the controller. It displays the
     * list of practitioners.
     */
    public function indexAction()
    {
         $page = $this->params()->fromQuery('page', 1);
        $practitioners_query = $this->entityManager->getRepository(Practitioner::class)
                ->getAllPractioners();
         $adapter = new DoctrineAdapter(new ORMPaginator($practitioners_query, false));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(ADMIN_PER_PAGE);        
        $paginator->setCurrentPageNumber($page);
        
        return new ViewModel([
            'practitioners' => $paginator
        ]);
    }

    /**
     * This action displays a page allowing to add a new practitioners.
     */
    public function addAction()
    {
        // Create practitioners form
        $form = new PractitionerForm('create', $this->entityManager);

        // Check if practitioners has submitted the form
        if ($this->getRequest()->isPost()) {

            // Fill in the form with POST data
            $data = $this->params()->fromPost();

            $form->setData($data);

            // Validate form
            if($form->isValid()) {

                // Get filtered and validated data
                $data = $form->getData();

                // Add user.
                $user = $this->practitionerManager->addPractitioner($data);

                // Redirect to "view" page
                return $this->redirect()->toRoute('practitioner',
                        ['action'=>'view', 'id'=>$user->getId()]);
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

        // Find a practitioner with such ID.
        $practitioner = $this->entityManager->getRepository(Practitioner::class)
                ->find($id);

        if ($practitioner == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        return new ViewModel([
            'practitioner' => $practitioner
        ]);
    }

    /**
     * The "edit" action displays a page allowing to edit practitioner.
     */
    public function editAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $practitioner = $this->entityManager->getRepository(Practitioner::class)
                ->find($id);

        if ($practitioner == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        // Create practitioner form
        $form = new PractitionerForm('update', $this->entityManager, $practitioner);

        // Check if practitioner has submitted the form
        if ($this->getRequest()->isPost()) {

            // Fill in the form with POST data
            $data = $this->params()->fromPost();

            $form->setData($data);

            // Validate form
            if($form->isValid()) {

                // Get filtered and validated data
                $data = $form->getData();

                // Update the practitioner.
                $this->practitionerManager->updatePractitioner($practitioner, $data);

                // Redirect to "view" page
                return $this->redirect()->toRoute('practitioner',
                        ['action'=>'view', 'id'=>$practitioner->getId()]);
            }
        } else {
            $form->setData(array(
                    'first_name'=>$practitioner->getFirstName(),
                    'last_name'=>$practitioner->getLastName(),
                    'language'=>$practitioner->getLanguage(),
                    'phone_number'=>$practitioner->getPhoneNumber(),
                    'gender'=>$practitioner->getGender(),
                    'address'=>$practitioner->getAddress(),
                    'email'=>$practitioner->getEmail(),
                    'overview'=>$practitioner->getOverview(),
                    'qualification'=>$practitioner->getQualification(),
                ));
        }

        return new ViewModel(array(
            'practitioner' => $practitioner,
            'form' => $form
        ));
    }


    /**
     * This action delete a Practitioner.
     */
    public function deleteAction() {

        // Check if Practitioner has submitted the form
        if ($this->getRequest()->isPost()) {
            $id = $_POST['id'];

            $practitioner = $this->entityManager->getRepository(Practitioner::class)->findOneById($id);

            $this->PractitionerManager->deletePractitioner($practitioner);
        }
        return true;
    }

}
