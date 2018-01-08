<?php

declare(strict_types=1);

namespace Application\Form;

use Zend\Filter\StringTrim;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator as Validator;

class ParticipantForm extends Form implements InputFilterProviderInterface
{
    /**
     * @var string $name
     */
    private $name = 'participant';

    /**
     * ParticipantForm constructor.
     * @param null $name
     * @param array $options
     */
    public function __construct($name = null, array $options = [])
    {
        if (is_null($name)) {
            $this->name = $name;
        }
        // create form from parent
        parent::__construct($this->name, $options);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'participant_firstname',
            'options' => [
                'label' => 'First Name',
            ],
        ]);
        $this->add([
            'type' => Element\Text::class,
            'name' => 'participant_lastname',
            'options' => [
                'label' => 'Last Name',
            ],
        ]);
        $this->add([
            'type' => Element\Email::class,
            'name' => 'participant_email',
            'options' => [
                'label' => 'Email Address',
            ],
        ]);

        $this->add([
            'type' => Element\Submit::class,
            'name' => 'submit',
            'attributes' => [
                'value' => 'Add Participant',
                'class' => 'btn btn-success'
            ],
        ]);
    }

    /**
     * Define validators configuration
     *
     * @return array
     */
    public function getInputFilterSpecification() : array
    {
        return [
            'participant_firstname' => [
                'filters'  => [
                    [
                        'name' => StringTrim::class,
                    ],
                ],
                'validators' => [
                    [
                        'name' => Validator\StringLength::class,
                        'options' => [
                            'min' => 2,
                            'max' => 50,
                        ],
                    ],
                ],
            ],
            'participant_lastname' => [
                'filters'  => [
                    [
                        'name' => StringTrim::class,
                    ],
                ],
                'validators' => [
                    [
                        'name' => Validator\StringLength::class,
                        'options' => [
                            'min' => 2,
                            'max' => 60,
                        ],
                    ],
                ],
            ],
            'participant_email' => [
                'filters'  => [
                    [
                        'name' => StringTrim::class,
                    ],
                ],
                'validators' => [
                    [
                        'name' => Validator\StringLength::class,
                        'options' => [
                            'min' => 2,
                            'max' => 60,
                        ],
                    ],
                ],
            ],
        ];
    }
}
