<?php

declare(strict_types=1);

namespace Application\Service;

use Application\Entity\Owner;
use Application\Repository\OwnerRepository;

/**
 * Class OwnerService
 * @package Application\Service
 */
class OwnerService
{

    /**
     * @var OwnerRepository $ownerRepository
     */
    private $ownerRepository;

    /**
     * OwnerService constructor.
     * @param OwnerRepository $ownerRepository
     */
    function __construct(OwnerRepository $ownerRepository)
    {
        $this->ownerRepository = $ownerRepository;
    }

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $biography
     *
     * @return Owner
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createOwner(string $firstName, string $lastName, string $biography) : Owner
    {
        /** @var Owner $owner */
        $owner = new Owner($firstName, $lastName, $biography);

        $this->ownerRepository->create($owner);

        return $owner;
    }
}
