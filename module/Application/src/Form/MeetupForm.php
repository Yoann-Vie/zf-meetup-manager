<?php

declare(strict_types=1);

namespace Application\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator as Validator;

class MeetupForm extends Form implements InputFilterProviderInterface
{
    /**
     * @var string $name
     */
    private $name = 'meetup';

    /**
     * MeetupForm constructor.
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
            'name' => 'title',
            'options' => [
                'label' => 'Title',
            ],
        ]);
        $this->add([
            'type' => Element\Text::class,
            'name' => 'description',
            'options' => [
                'label' => 'Description',
            ],
        ]);
        $this->add([
            'type' => Element\DateTime::class,
            'name' => 'start_date',
            'options' => [
                'label' => 'Meetup starting date',
                'format' => 'Y-m-d H:i:s',
            ],
            'attributes' => [
                'step' => 'any',
            ],
        ]);
        $this->add([
            'type' => Element\DateTime::class,
            'name' => 'end_date',
            'options' => [
                'label' => 'Meetup end date',
                'format' => 'Y-m-d H:i:s',
            ],
            'attributes' => [
                'step' => 'any',
            ],
        ]);

        $this->add([
            'type' => Element\Submit::class,
            'name' => 'submit',
            'attributes' => [
                'value' => 'Submit',
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
            'title' => [
                'validators' => [
                    [
                        'name' => Validator\StringLength::class,
                        'options' => [
                            'min' => 2,
                            'max' => 50,
                        ],
                    ]
                ],
            ],
            'description' => [
                'validators' => [
                    [
                        'name' => Validator\StringLength::class,
                        'options' => [
                            'min' => 2,
                            'max' => 2000,
                        ],
                    ]
                ],
            ],
        ];
    }
}
