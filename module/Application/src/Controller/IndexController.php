<?php

declare(strict_types=1);

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class IndexController
 * @package Application\Controller
 */
class IndexController extends AbstractActionController
{

    /**
     * @return ViewModel
     */
    public function homeAction() : ViewModel
    {
        return new ViewModel();
    }
}
