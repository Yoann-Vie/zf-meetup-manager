<?php

declare(strict_types=1);

namespace Application\Form;

use Application\Entity\Owner;
use Application\Repository\OwnerRepository;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

/**
 * Class MeetupFormFactory
 * @package Application\Form
 */
class MeetupFormFactory
{

    /**
     * @param ContainerInterface $container
     *
     * @return MeetupForm
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container) : MeetupForm
    {
        /* @var $entityManager EntityManager */
        $entityManager = $container->get(EntityManager::class);
        /** @var OwnerRepository $ownerRepository */
        $ownerRepository = $entityManager->getRepository(Owner::class);

        return new MeetupForm(null, [], $ownerRepository);
    }
}
