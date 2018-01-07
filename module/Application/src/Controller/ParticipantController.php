<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Entity\Meetup;
use Application\Entity\Participant;
use Application\Repository\MeetupRepository;
use Application\Repository\ParticipantRepository;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Class ParticipantController
 * @package Application\Controller
 */
class ParticipantController extends AbstractActionController
{

    /** @var MeetupRepository $meetupRepository */
    private $meetupRepository;
    /** @var ParticipantRepository $participantRepository */
    private $participantRepository;

    /**
     * ParticipantController constructor.
     * @param ParticipantRepository $participantRepository
     * @param MeetupRepository $meetupRepository
     */
    public function __construct(ParticipantRepository $participantRepository, MeetupRepository $meetupRepository)
    {
        $this->participantRepository = $participantRepository;
        $this->meetupRepository = $meetupRepository;
    }

    /**
     * @return Response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteAction() : Response
    {
        /** @var string $meetupId */
        $meetupId = $this->params()->fromRoute('meetupId');
        /** @var Meetup $meetup */
        $meetup = $this->meetupRepository->find($meetupId);
        /** @var string $participantId */
        $participantId = $this->params()->fromRoute('participantId');
        /** @var Participant $participant */
        $participant = $this->participantRepository->find($participantId);
        // if participant Id is invalid
        if (!$participant instanceof Participant || !$meetup instanceof Meetup) {
            return $this->redirect()->toRoute('meetups/update', ['meetupId' => $meetupId]);
        }

        // delete the participant from the meetup
        $meetup->removeParticipant($participant);
        $this->meetupRepository->update($meetup);

        return $this->redirect()->toRoute('meetups/update', ['meetupId' => $meetupId]);
    }
}
