<?php
namespace Admin\Controller\Factory;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Admin\Controller\PracticeController;
use Admin\Service\PracticeManager;
/**
 * This is the factory for UserController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class PracticeControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $practiceManager = $container->get(PracticeManager::class);
        
        // Instantiate the controller and inject dependencies
        return new PracticeController($entityManager,$practiceManager);
    }
}