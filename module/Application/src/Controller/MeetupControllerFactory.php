<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Entity\Meetup;
use Application\Form\MeetupForm;
use Application\Form\OwnerForm;
use Application\Repository\MeetupRepository;
use Application\Service\MeetupService;
use Application\Service\OwnerService;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

/**
 * Class MeetupControllerFactory
 * @package Application\Controller
 */
final class MeetupControllerFactory
{

    /**
     * @param ContainerInterface $container
     *
     * @return MeetupController
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container) : MeetupController
    {
        /* @var $entityManager EntityManager */
        $entityManager = $container->get(EntityManager::class);
        /** @var MeetupRepository $meetupRepository */
        $meetupRepository = $entityManager->getRepository(Meetup::class);
        /** @var MeetupForm $meetupForm */
        $meetupForm = $container->get(MeetupForm::class);
        /** @var OwnerForm $ownerForm */
        $ownerForm = $container->get(OwnerForm::class);
        /** @var MeetupService $meetupService */
        $meetupService = $container->get(MeetupService::class);
        /** @var OwnerService $ownerService */
        $ownerService = $container->get(OwnerService::class);

        return new MeetupController($meetupRepository, $meetupForm, $meetupService, $ownerForm, $ownerService);
    }
}
