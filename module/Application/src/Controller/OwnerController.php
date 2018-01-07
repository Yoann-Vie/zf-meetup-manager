<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Entity\Meetup;
use Application\Entity\Owner;
use Application\Repository\MeetupRepository;
use Application\Repository\OwnerRepository;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Class OwnerController
 * @package Application\Controller
 */
class OwnerController extends AbstractActionController
{

    /** @var MeetupRepository $meetupRepository */
    private $meetupRepository;
    /** @var OwnerRepository $ownerRepository */
    private $ownerRepository;

    /**
     * OwnerController constructor.
     * @param OwnerRepository $ownerRepository
     * @param MeetupRepository $meetupRepository
     */
    public function __construct(OwnerRepository $ownerRepository, MeetupRepository $meetupRepository)
    {
        $this->ownerRepository = $ownerRepository;
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
        /** @var string $ownerId */
        $ownerId = $this->params()->fromRoute('ownerId');
        /** @var Owner $owner */
        $owner = $this->ownerRepository->find($ownerId);
        // if owner Id is invalid
        if (!$owner instanceof Owner || !$meetup instanceof Meetup) {
            return $this->redirect()->toRoute('meetups/update', ['meetupId' => $meetupId]);
        }

        // delete the owner from the meetup
        $meetup->removeOwner($owner);
        $this->meetupRepository->update($meetup);

        return $this->redirect()->toRoute('meetups/update', ['meetupId' => $meetupId]);
    }
}
