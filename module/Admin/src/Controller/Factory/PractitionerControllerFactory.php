<?php
namespace Admin\Controller\Factory;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Admin\Controller\PractitionerController;
use Admin\Service\PractitionerManager;
/**
 * This is the factory for PractitionerController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class PractitionerControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $PractitionerManager = $container->get(PractitionerManager::class);

        // Instantiate the controller and inject dependencies
    return new PractitionerController($entityManager, $PractitionerManager);
    }
}