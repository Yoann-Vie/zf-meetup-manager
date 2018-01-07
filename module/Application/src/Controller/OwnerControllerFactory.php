<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Entity\Meetup;
use Application\Entity\Owner;
use Application\Repository\MeetupRepository;
use Application\Repository\OwnerRepository;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

/**
 * Class OwnerControllerFactory
 * @package Application\Controller
 */
final class OwnerControllerFactory
{

    /**
     * @param ContainerInterface $container
     *
     * @return OwnerController
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container) : OwnerController
    {
        /* @var $entityManager EntityManager */
        $entityManager = $container->get(EntityManager::class);
        /** @var OwnerRepository $ownerRepository */
        $ownerRepository = $entityManager->getRepository(Owner::class);
        /** @var MeetupRepository $meetupRepository */
        $meetupRepository = $entityManager->getRepository(Meetup::class);

        return new OwnerController($ownerRepository, $meetupRepository);
    }
}
