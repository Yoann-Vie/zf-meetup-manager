<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Repository\MeetupRepository;
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

    /**
     * MeetupController constructor.
     * @param MeetupRepository $meetupRepository
     */
    public function __construct(MeetupRepository $meetupRepository)
    {
        $this->meetupRepository = $meetupRepository;
    }

    /**
     * @return ViewModel
     */
    public function indexAction() : ViewModel
    {
        return new ViewModel();
    }

    /**
     * @return ViewModel
     */
    public function listAction()
    {
        return new ViewModel();
    }

    /**
     * @return ViewModel
     */
    public function addAction()
    {
        return new ViewModel();
    }
}
