<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Entity\Meetup;
use Application\Entity\Participant;
use Application\Repository\MeetupRepository;
use Application\Repository\ParticipantRepository;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

/**
 * Class ParticipantControllerFactory
 * @package Application\Controller
 */
final class ParticipantControllerFactory
{

    /**
     * @param ContainerInterface $container
     *
     * @return ParticipantController
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container) : ParticipantController
    {
        /* @var $entityManager EntityManager */
        $entityManager = $container->get(EntityManager::class);
        /** @var ParticipantRepository $participantRepository */
        $participantRepository = $entityManager->getRepository(Participant::class);
        /** @var MeetupRepository $meetupRepository */
        $meetupRepository = $entityManager->getRepository(Meetup::class);

        return new ParticipantController($participantRepository, $meetupRepository);
    }
}
