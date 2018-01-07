<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Entity\Meetup;
use Application\Form\MeetupForm;
use Application\Form\OwnerForm;
use Application\Repository\MeetupRepository;
use Application\Service\MeetupService;
use Application\Service\OwnerService;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class MeetupController
 * @package Application\Controller
 */
class MeetupController extends AbstractActionController
{
    /** @var MeetupRepository $meetupRepository */
    private $meetupRepository;
    /** @var MeetupForm $meetupForm */
    private $meetupForm;
    /** @var OwnerForm $ownerForm */
    private $ownerForm;
    /** @var MeetupService $meetupService */
    private $meetupService;
    /** @var OwnerService $ownerService */
    private $ownerService;

    /**
     * MeetupController constructor.
     * @param MeetupRepository $meetupRepository
     * @param MeetupForm $meetupForm
     * @param MeetupService $meetupService
     * @param OwnerForm $ownerForm
     * @param OwnerService $ownerService
     */
    public function __construct(MeetupRepository $meetupRepository, MeetupForm $meetupForm, MeetupService $meetupService, OwnerForm $ownerForm, OwnerService $ownerService)
    {
        $this->meetupRepository = $meetupRepository;
        $this->meetupForm = $meetupForm;
        $this->ownerForm = $ownerForm;
        $this->meetupService = $meetupService;
        $this->ownerService = $ownerService;
    }

    /**
     * @return ViewModel
     */
    public function listAction() : ViewModel
    {
        /** @var Meetup[] $meetups */
        $meetups = $this->meetupRepository->findAll();

        return new ViewModel([
            'meetups' => $meetups,
        ]);
    }

    /**
     * @return Response|ViewModel
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addAction()
    {
        /** @var MeetupForm $meetupForm */
        $meetupForm = $this->meetupForm;
        /** @var OwnerForm $ownerForm */
        $ownerForm = $this->ownerForm;

        /** @var Request $request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $meetupForm->setData($request->getPost());
            $ownerForm->setData($request->getPost());

            // If owner form is submitted and valid
            if ($ownerForm->isValid()) {
                $this->ownerService->createOwner(
                    $ownerForm->getData()['firstname'],
                    $ownerForm->getData()['lastname'],
                    $ownerForm->getData()['biography']
                );

                return $this->redirect()->toRoute('meetups/add');
            }
            // If meetup form is submitted and valid
            if ($meetupForm->isValid()) {
                $this->meetupService->createMeetup(
                    $meetupForm->getData()['title'],
                    $meetupForm->getData()['description'],
                    $meetupForm->getData()['start_date'],
                    $meetupForm->getData()['end_date'],
                    $meetupForm->getData()['owner']
                );

                return $this->redirect()->toRoute('meetups/list');
            }
        }

        $meetupForm->prepare();

        return new ViewModel([
            'meetupForm' => $meetupForm,
            'ownerForm' => $ownerForm,
        ]);
    }

    /**
     * @return Response|ViewModel
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateAction()
    {
        /** @var string $meetupId */
        $meetupId = $this->params()->fromRoute('meetupId');
        /** @var Meetup $meetup */
        $meetup = $this->meetupRepository->find($meetupId);
        // if meetup Id is invalid
        if (!$meetup instanceof Meetup) {
            return $this->redirect()->toRoute('meetups/list');
        }

        /** @var MeetupForm $meetupForm */
        $meetupForm = $this->meetupForm;
        /** @var OwnerForm $ownerForm */
        $ownerForm = $this->ownerForm;
        $meetupForm->setData($this->meetupService->getMeetupDataAsArray($meetup));
        /** @var Request $request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $meetupForm->setData($request->getPost());
            $ownerForm->setData($request->getPost());

            // If owner form is submitted and valid
            if ($ownerForm->isValid()) {
                $this->ownerService->createOwner(
                    $ownerForm->getData()['firstname'],
                    $ownerForm->getData()['lastname'],
                    $ownerForm->getData()['biography']
                );

                return $this->redirect()->toRoute('meetups/update', ['meetupId' => $meetupId]);
            }
            // If meetup form is submitted and valid
            if ($meetupForm->isValid()) {
                $this->meetupService->updateMeetup($meetup, $meetupForm->getData());

                return $this->redirect()->toRoute('meetups/update', ['meetupId' => $meetupId]);
            }
        }

        $meetupForm->prepare();

        return new ViewModel([
            'meetupForm' => $meetupForm,
            'ownerForm' => $ownerForm,
            'meetup' => $meetup,
        ]);
    }

    /**
     * @return Response|ViewModel
     */
    public function detailsAction()
    {
        /** @var string $meetupId */
        $meetupId = $this->params()->fromRoute('meetupId');
        /** @var Meetup $meetup */
        $meetup = $this->meetupRepository->find($meetupId);
        // if meetup Id is invalid
        if (!$meetup instanceof Meetup) {
            return $this->redirect()->toRoute('meetups/list');
        }

        return new ViewModel([
            'meetup' => $meetup,
        ]);
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
        // if meetup Id is invalid
        if (!$meetup instanceof Meetup) {
            return $this->redirect()->toRoute('meetups/list');
        }
        // delete the meetup
        $this->meetupRepository->delete($meetup);

        return $this->redirect()->toRoute('meetups/list');
    }
}
