<?php
namespace Admin\Controller\Factory;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Admin\Controller\SpecialitiesController;
use Admin\Service\SpecialitiesManager;
/**
 * This is the factory for UserController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class SpecialitiesControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $specManager = $container->get(SpecialitiesManager::class);
        
        // Instantiate the controller and inject dependencies
        return new SpecialitiesController($entityManager, $specManager);
    }
}