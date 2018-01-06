<?php

declare(strict_types=1);

namespace Application\Service;

use Application\Entity\Meetup;
use Application\Repository\MeetupRepository;

class MeetupService
{
    /**
     * @var MeetupRepository $meetupRepository
     */
    private $meetupRepository;

    /**
     * MeetupService constructor.
     * @param MeetupRepository $meetupRepository
     */
    function __construct(MeetupRepository $meetupRepository)
    {
        $this->meetupRepository = $meetupRepository;
    }

    /**
     * @param string $title
     * @param string $description
     * @param $startDate
     * @param $endDate
     *
     * @return Meetup
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createMeetup(string $title, string $description, string $startDate, string $endDate) : Meetup
    {
        /** @var \DateTime $startDate */
        $startDate = new \DateTime($startDate);
        /** @var \DateTime $endDate */
        $endDate = new \DateTime($endDate);

        /** @var Meetup $meetup */
        $meetup = new Meetup($title, $description, $startDate, $endDate);
        $this->meetupRepository->create($meetup);

        return $meetup;
    }
}
