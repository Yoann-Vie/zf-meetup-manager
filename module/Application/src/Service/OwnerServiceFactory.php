<?php

declare(strict_types=1);

namespace Application\Service;

use Application\Entity\Owner;
use Application\Repository\OwnerRepository;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

/**
 * Class OwnerServiceFactory
 * @package Application\Service
 */
class OwnerServiceFactory
{

    /**
     * @param ContainerInterface $container
     *
     * @return OwnerService
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container) : OwnerService
    {
        /* @var $entityManager EntityManager */
        $entityManager = $container->get(EntityManager::class);
        /** @var OwnerRepository $ownerRepository */
        $ownerRepository = $entityManager->getRepository(Owner::class);

        return new OwnerService($ownerRepository);
    }
}
