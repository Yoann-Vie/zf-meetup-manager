<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Form\MeetupForm;
use Application\Repository\MeetupRepository;
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

    /**
     * MeetupController constructor.
     * @param MeetupRepository $meetupRepository
     * @param MeetupForm $meetupForm
     */
    public function __construct(MeetupRepository $meetupRepository, MeetupForm $meetupForm)
    {
        $this->meetupRepository = $meetupRepository;
        $this->meetupForm = $meetupForm;
    }

    /**
     * @return ViewModel
     */
    public function listAction()
    {
        return new ViewModel();
    }

    /**
     *
     */
    public function addAction()
    {
        $form = $this->meetupForm;

        /** @var Request $request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                // TODO : create meetup

                return $this->redirect()->toRoute('meetups/list');
            }
        }

        $form->prepare();

        return new ViewModel([
            'form' => $form,
        ]);
    }
}
