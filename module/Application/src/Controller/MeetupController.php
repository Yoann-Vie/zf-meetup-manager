<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Form\MeetupForm;
use Application\Repository\MeetupRepository;
use Application\Service\MeetupService;
use Zend\Http\Request;
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
        return new ViewModel();
    }

    /**
     * @return \Zend\Http\Response|ViewModel
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
                    $form->getData()['end_date']
                );

                return $this->redirect()->toRoute('meetups/list');
            }
        }

        $form->prepare();

        return new ViewModel([
            'form' => $form,
        ]);
    }
}
