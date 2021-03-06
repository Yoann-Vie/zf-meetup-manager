<?php

declare(strict_types=1);

namespace Application\Service;

use Application\Entity\Meetup;
use Application\Entity\Owner;
use Application\Repository\MeetupRepository;
use Application\Repository\OwnerRepository;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

/**
 * Class MeetupServiceFactory
 * @package Application\Service
 */
class MeetupServiceFactory
{

    /**
     * @param ContainerInterface $container
     *
     * @return MeetupService
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container) : MeetupService
    {
        /* @var $entityManager EntityManager */
        $entityManager = $container->get(EntityManager::class);
        /** @var MeetupRepository $meetupRepository */
        $meetupRepository = $entityManager->getRepository(Meetup::class);
        /** @var OwnerRepository $ownerRepository */
        $ownerRepository = $entityManager->getRepository(Owner::class);

        return new MeetupService($meetupRepository, $ownerRepository);
    }
}
