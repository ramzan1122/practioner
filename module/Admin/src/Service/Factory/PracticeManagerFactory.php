<?php
namespace Admin\Service\Factory;
use Interop\Container\ContainerInterface;
use Admin\Service\PracticeManager;

/**
 * This is the factory class for PractitionerManager service. The purpose of the factory
 * is to instantiate the service and pass it dependencies (inject dependencies).
 */
class PracticeManagerFactory
{
    /**
     * This method creates the PractitionerManager service and returns its instance.
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        return new PracticeManager($entityManager);
    }
}