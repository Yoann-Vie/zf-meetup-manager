<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Entity\Meetup;
use Application\Form\MeetupForm;
use Application\Repository\MeetupRepository;
use Application\Service\MeetupService;
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
    /** @var MeetupService $meetupService */
    private $meetupService;

    /**
     * MeetupController constructor.
     * @param MeetupRepository $meetupRepository
     * @param MeetupForm $meetupForm
     * @param MeetupService $meetupService
     */
    public function __construct(MeetupRepository $meetupRepository, MeetupForm $meetupForm, MeetupService $meetupService)
    {
        $this->meetupRepository = $meetupRepository;
        $this->meetupForm = $meetupForm;
        $this->meetupService = $meetupService;
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
        /** @var MeetupForm $form */
        $form = $this->meetupForm;

        /** @var Request $request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->meetupService->createMeetup(
                    $form->getData()['title'],
                    $form->getData()['description'],
                    $form->getData()['start_date'],
                    $form->getData()['end_date'],
                    $form->getData()['owner']
                );

                return $this->redirect()->toRoute('meetups/list');
            }
        }

        $form->prepare();

        return new ViewModel([
            'form' => $form,
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

        /** @var MeetupForm $form */
        $form = $this->meetupForm;
        $form->setData($this->meetupService->getMeetupDataAsArray($meetup));
        /** @var Request $request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->meetupService->updateMeetup($meetup, $form->getData());

                return $this->redirect()->toRoute('meetups/list');
            }
        }

        $form->prepare();

        return new ViewModel([
            'form' => $form,
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
