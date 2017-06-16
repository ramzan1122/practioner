<?php
namespace Admin\Controller\Factory;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Admin\Controller\QualificationController;
use Admin\Service\QualificationManager;
/**
 * This is the factory for UserController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class QualificationControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $quaManager = $container->get(QualificationManager::class);
        
        // Instantiate the controller and inject dependencies
        return new QualificationController($entityManager, $quaManager);
    }
}