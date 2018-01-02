<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Entity\Meetup;
use Application\Repository\MeetupRepository;
use Zend\Form\Element\DateTime;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class IndexController
 * @package Application\Controller
 */
class IndexController extends AbstractActionController
{
    /** @var MeetupRepository $meetupRepository */
    private $meetupRepository;

    /**
     * IndexController constructor.
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
}
