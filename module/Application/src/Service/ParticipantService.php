<?php

declare(strict_types=1);

namespace Application\Service;

use Application\Entity\Participant;
use Application\Repository\ParticipantRepository;

/**
 * Class ParticipantService
 * @package Application\Service
 */
class ParticipantService
{

    /**
     * @var ParticipantRepository $participantRepository
     */
    private $participantRepository;

    /**
     * ParticipantService constructor.
     * @param ParticipantRepository $participantRepository
     */
    function __construct(ParticipantRepository $participantRepository)
    {
        $this->participantRepository = $participantRepository;
    }

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     *
     * @return Participant
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createParticipant(string $firstName, string $lastName, string $email) : Participant
    {
        /** @var Participant $participant */
        $participant = new Participant($firstName, $lastName, $email);

        $this->participantRepository->create($participant);

        return $participant;
    }
}
