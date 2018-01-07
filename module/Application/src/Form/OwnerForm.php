<?php

declare(strict_types=1);

namespace Application\Form;

use Zend\Filter\StringTrim;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator as Validator;

class OwnerForm extends Form implements InputFilterProviderInterface
{
    /**
     * @var string $name
     */
    private $name = 'owner';

    /**
     * OwnerForm constructor.
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
            'name' => 'firstname',
            'options' => [
                'label' => 'First Name',
            ],
        ]);
        $this->add([
            'type' => Element\Text::class,
            'name' => 'lastname',
            'options' => [
                'label' => 'Last Name',
            ],
        ]);
        $this->add([
            'type' => Element\Text::class,
            'name' => 'biography',
            'options' => [
                'label' => 'Biography',
            ],
        ]);

        $this->add([
            'type' => Element\Submit::class,
            'name' => 'submit',
            'attributes' => [
                'value' => 'Create Owner',
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
            'firstname' => [
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
            'lastname' => [
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
            'biography' => [
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
        ];
    }
}
