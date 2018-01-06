<?php

declare(strict_types=1);

namespace Application\Validator;

use Application\Form\MeetupForm;
use Zend\Validator\GreaterThan;

class GreaterThanDate extends GreaterThan
{

    /** @var string NOW_OPTION_CODE */
    const NOW_OPTION_CODE = 'now';

    /**
     * @param mixed $value
     * @param null $context
     *
     * @return bool
     */
    public function isValid($value, $context = null) : bool
    {
        // manage check with current time
        if ($this->getMin() === self::NOW_OPTION_CODE) {
            /** @var \DateTime $now */
            $now = new \DateTime();
            $this->setMin($now->format(MeetupForm::FORM_DATE_FORMAT));
        }
        // validate data from context
        if (isset($context[$this->getMin()])) {
            $this->setMin($context[$this->getMin()]);
        }

        return parent::isValid($value);
    }
}
