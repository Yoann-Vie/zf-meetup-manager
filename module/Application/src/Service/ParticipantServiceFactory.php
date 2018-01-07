<?php

declare(strict_types=1);

namespace Application\Service;

use Application\Entity\Participant;
use Application\Repository\ParticipantRepository;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

/**
 * Class ParticipantServiceFactory
 * @package Application\Service
 */
class ParticipantServiceFactory
{

    /**
     * @param ContainerInterface $container
     *
     * @return ParticipantService
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container) : ParticipantService
    {
        /* @var $entityManager EntityManager */
        $entityManager = $container->get(EntityManager::class);
        /** @var ParticipantRepository $participantRepository */
        $participantRepository = $entityManager->getRepository(Participant::class);

        return new ParticipantService($participantRepository);
    }
}
