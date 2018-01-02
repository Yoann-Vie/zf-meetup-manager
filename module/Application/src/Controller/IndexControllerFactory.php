<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Entity\Meetup;
use Application\Repository\MeetupRepository;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

/**
 * Class IndexControllerFactory
 * @package Application\Controller
 */
final class IndexControllerFactory
{

    /**
     * @param ContainerInterface $container
     *
     * @return IndexController
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container) : IndexController
    {
        /* @var $entityManager EntityManager */
        $entityManager = $container->get(EntityManager::class);
        /** @var MeetupRepository $meetupRepository */
        $meetupRepository = $entityManager->getRepository(Meetup::class);

        return new IndexController($meetupRepository);
    }
}
