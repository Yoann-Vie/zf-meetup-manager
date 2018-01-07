<?php

declare(strict_types=1);

namespace Application\Form;

use Application\Entity\Owner;
use Application\Repository\OwnerRepository;
use Application\Validator\GreaterThanDate;
use Zend\Filter\StringTrim;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator as Validator;

class MeetupForm extends Form implements InputFilterProviderInterface
{

    /** @var string FORM_DATE_FORMAT */
    const FORM_DATE_FORMAT = 'Y-m-d H:i:s';

    /**
     * @var string $name
     */
    private $name = 'meetup';
    /**
     * @var OwnerRepository $ownerRepository
     */
    private $ownerRepository;

    /**
     * MeetupForm constructor.
     * @param null $name
     * @param array $options
     * @param OwnerRepository $ownerRepository
     */
    public function __construct($name = null, array $options = [], OwnerRepository $ownerRepository)
    {
        $this->ownerRepository = $ownerRepository;

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
                'format' => self::FORM_DATE_FORMAT,
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
                'format' => self::FORM_DATE_FORMAT,
            ],
            'attributes' => [
                'step' => 'any',
            ],
        ]);
        $this->add([
            'type' => Element\Select::class,
            'name' => 'owner',
            'options' => [
                'label' => 'Meetup owner',
                'empty_option' => 'Select an existing owner ...',
                'value_options' => $this->getOwnersForSelect(),
            ]
        ]);

        $this->add([
            'type' => Element\Submit::class,
            'name' => 'submit',
            'attributes' => [
                'value' => 'Schedule this Meetup',
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
            'description' => [
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
                            'max' => 2000,
                        ],
                    ],
                ],
            ],
            'start_date' => [
                'filters'  => [
                    [
                        'name' => StringTrim::class,
                    ],
                ],
                'validators' => [
                    [
                        'name' => GreaterThanDate::class,
                        'options' => [
                            'min' => 'now',
                        ],
                    ],
                ],
            ],
            'end_date' => [
                'filters'  => [
                    [
                        'name' => StringTrim::class,
                    ],
                ],
                'validators' => [
                    [
                        'name' => GreaterThanDate::class,
                        'options' => [
                            'min' => 'start_date',
                        ],
                    ],
                ],
            ],
            'owner' => [
                'required' => false,
            ],
        ];
    }

    /**
     * Get values for owner select
     * @return array
     */
    public function getOwnersForSelect() : array
    {
        /** @var array $owners */
        $owners = $this->ownerRepository->getOwners();
        /** @var array $values */
        $values = [];
        /** @var Owner $owner */
        foreach ($owners as $owner) {
            $values[$owner->getId()] = $owner->getFullName();
        }

        return $values;
    }
}
