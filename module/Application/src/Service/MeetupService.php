<?php

declare(strict_types=1);

namespace Application\Service;

use Application\Entity\Meetup;
use Application\Form\MeetupForm;
use Application\Repository\MeetupRepository;

class MeetupService
{

    /** @var string DISPLAY_DATE_FORMAT */
    const DISPLAY_DATE_FORMAT = 'l, d F Y, H:i';

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

    /**
     * @param Meetup $meetup
     * @param array $options
     *
     * @return Meetup
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateMeetup(Meetup $meetup, array $options = []) : Meetup
    {
        if (isset($options['title'])) {
            $meetup->setTitle($options['title']);
        }
        if (isset($options['description'])) {
            $meetup->setDescription($options['description']);
        }
        if (isset($options['start_date'])) {
            $meetup->setStartDate(new \DateTime($options['start_date']));
        }
        if (isset($options['end_date'])) {
            $meetup->setEndDate(new \DateTime($options['end_date']));
        }

        $this->meetupRepository->update($meetup);

        return $meetup;
    }

    /**
     * @param Meetup $meetup
     *
     * @return array
     */
    public function getMeetupDataAsArray(Meetup $meetup) : array
    {
        /** @var string $startDate */
        $startDate = $meetup->getStartDate()->format(MeetupForm::FORM_DATE_FORMAT);
        /** @var string $endDate */
        $endDate = $meetup->getEndDate()->format(MeetupForm::FORM_DATE_FORMAT);

        return [
            'title' => $meetup->getTitle(),
            'description' => $meetup->getDescription(),
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];
    }
}
