<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\MvcEvent;

class DashboardController extends AbstractActionController {

    public function __construct() {

        
    }
    public function onDispatch(MvcEvent $e) {
        // Call the base class' onDispatch() first and grab the response
        $response = parent::onDispatch($e);
        $this->layout()->controllerName = 'dashboard';
        // Set alternative layout
        $this->layout()->setTemplate('layout/layout-admin');

        // Return the response
        return $response;
    }
    public function indexAction() {
        
        $this->layout()->setTemplate('layout/layout-admin');
        return new ViewModel();
    }

}
