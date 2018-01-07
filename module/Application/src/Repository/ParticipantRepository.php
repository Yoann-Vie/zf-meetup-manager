<?php

declare(strict_types=1);

namespace Application\Repository;

use Application\Entity\Participant;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Class ParticipantRepository
 */
class ParticipantRepository extends EntityRepository
{

    /**
     * @return array
     */
    public function getParticipants() : array
    {
        return $this->findAll();
    }

    /**
     * @param Participant $participant
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create(Participant $participant) : void
    {
        /** @var EntityManager $entityManager */
        $entityManager = $this->getEntityManager();
        $entityManager->persist($participant);
        $entityManager->flush();
    }

    /**
     * @param Participant $participant
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Participant $participant) : void
    {
        /** @var EntityManager $entityManager */
        $entityManager = $this->getEntityManager();
        $entityManager->remove($participant);
        $entityManager->flush();
    }

    /**
     * @param Participant $participant
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(Participant $participant) : void
    {
        /** @var EntityManager $entityManager */
        $entityManager = $this->getEntityManager();
        $entityManager->persist($participant);
        $entityManager->flush();
    }
}
