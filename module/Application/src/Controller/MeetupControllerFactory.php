<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Entity\Meetup;
use Application\Form\MeetupForm;
use Application\Repository\MeetupRepository;
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

        return new MeetupController($meetupRepository, $meetupForm);
    }
}
