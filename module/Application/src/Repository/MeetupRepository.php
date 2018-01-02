<?php

declare(strict_types=1);

namespace Application\Repository;

use Application\Entity\Meetup;
use Doctrine\ORM\EntityRepository;

/**
 * Class MeetupRepository
 */
class MeetupRepository extends EntityRepository
{

    /**
     * @return array
     */
    public function getMeetups() : array
    {
        return $this->findAll();
    }

    /**
     * @param Meetup $meetup
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create(Meetup $meetup) : void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($meetup);
        $entityManager->flush();
    }
}
