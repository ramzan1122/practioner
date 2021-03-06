<?php
namespace Admin\Controller\Factory;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Admin\Controller\CategoryController;
use Admin\Service\CategoryManager;
/**
 * This is the factory for CategoryController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class CategoryControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $categoryManager = $container->get(CategoryManager::class);
        
        // Instantiate the controller and inject dependencies
        return new CategoryController($entityManager, $categoryManager);
    }
}