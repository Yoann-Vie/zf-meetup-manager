<?php

declare(strict_types=1);

namespace Application\Validator;

use Zend\Validator\GreaterThan;

class GreaterThanDate extends GreaterThan
{

    /**
     * @param mixed $value
     * @param null $context
     *
     * @return bool
     */
    public function isValid($value, $context = null) : bool
    {
        // validate data from context
        if (isset($context[$this->getMin()])) {
            $this->setMin($context[$this->getMin()]);
        }

        return parent::isValid($value);
    }
}
