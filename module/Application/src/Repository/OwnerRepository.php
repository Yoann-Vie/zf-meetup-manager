<?php

declare(strict_types=1);

namespace Application\Repository;

use Application\Entity\Owner;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Class OwnerRepository
 */
class OwnerRepository extends EntityRepository
{

    /**
     * @return array
     */
    public function getOwners() : array
    {
        return $this->findAll();
    }

    /**
     * @param Owner $owner
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create(Owner $owner) : void
    {
        /** @var EntityManager $entityManager */
        $entityManager = $this->getEntityManager();
        $entityManager->persist($owner);
        $entityManager->flush();
    }

    /**
     * @param Owner $owner
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Owner $owner)
    {
        /** @var EntityManager $entityManager */
        $entityManager = $this->getEntityManager();
        $entityManager->remove($owner);
        $entityManager->flush();
    }

    /**
     * @param Owner $owner
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(Owner $owner)
    {
        /** @var EntityManager $entityManager */
        $entityManager = $this->getEntityManager();
        $entityManager->persist($owner);
        $entityManager->flush();
    }
}
