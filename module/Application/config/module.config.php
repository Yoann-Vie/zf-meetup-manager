<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Form as Form;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'home',
                    ],
                ],
            ],
            'meetups' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/meetups',
                    'defaults' => [
                        'controller' => Controller\MeetupController::class,
                    ],
                ],
                'child_routes' => [
                    'add' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/new',
                            'defaults' => [
                                'action' => 'add',
                            ],
                        ]
                    ],
                    'update' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/edit/[:meetupId]',
                            'constraints' => [
                                'meetupId' => '[a-zA-Z0-9_-]+',
                            ],
                            'defaults' => [
                                'action' => 'update',
                            ],
                        ],
                    ],
                    'list' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/list',
                            'defaults' => [
                                'action' => 'list',
                            ],
                        ]
                    ],
                    'details' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/details/[:meetupId]',
                            'constraints' => [
                                'meetupId' => '[a-zA-Z0-9_-]+',
                            ],
                            'defaults' => [
                                'action' => 'details',
                            ],
                        ],
                    ],
                    'delete' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/delete/[:meetupId]',
                            'constraints' => [
                                'meetupId' => '[a-zA-Z0-9_-]+',
                            ],
                            'defaults' => [
                                'action' => 'delete',
                            ],
                        ],
                    ],
                ],
            ],
            'owners' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/owners',
                    'defaults' => [
                        'controller' => Controller\OwnerController::class,
                    ],
                ],
                'child_routes' => [
                    'delete' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/delete/[:meetupId]/[:ownerId]',
                            'constraints' => [
                                'meetupId' => '[a-zA-Z0-9_-]+',
                                'ownerId' => '[a-zA-Z0-9_-]+',
                            ],
                            'defaults' => [
                                'action' => 'delete',
                            ],
                        ],
                    ],
                ],
            ],
            'participants' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/participants',
                    'defaults' => [
                        'controller' => Controller\ParticipantController::class,
                    ],
                ],
                'child_routes' => [
                    'delete' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/delete/[:meetupId]/[:participantId]',
                            'constraints' => [
                                'meetupId' => '[a-zA-Z0-9_-]+',
                                'participantId' => '[a-zA-Z0-9_-]+',
                            ],
                            'defaults' => [
                                'action' => 'delete',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            Controller\MeetupController::class => Controller\MeetupControllerFactory::class,
            Controller\OwnerController::class => Controller\OwnerControllerFactory::class,
            Controller\ParticipantController::class => Controller\ParticipantControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            Form\MeetupForm::class => Form\MeetupFormFactory::class,
            Form\OwnerForm::class => InvokableFactory::class,
            Form\ParticipantForm::class => InvokableFactory::class,
            Service\MeetupService::class => Service\MeetupServiceFactory::class,
            Service\OwnerService::class => Service\OwnerServiceFactory::class,
            Service\ParticipantService::class => Service\ParticipantServiceFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'              => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/home'     => __DIR__ . '/../view/application/index/home.phtml',
            'application/meetup/add'     => __DIR__ . '/../view/application/meetup/add.phtml',
            'application/meetup/update'  => __DIR__ . '/../view/application/meetup/update.phtml',
            'application/meetup/list'    => __DIR__ . '/../view/application/meetup/list.phtml',
            'application/meetup/details' => __DIR__ . '/../view/application/meetup/details.phtml',
            'error/404'                  => __DIR__ . '/../view/error/404.phtml',
            'error/index'                => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'doctrine' => [
        'driver' => [
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'application_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../src/Entity/',
                ],
            ],

            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => [
                'drivers' => [
                    // register `my_annotation_driver` for any entity under namespace `My\Namespace`
                    'Application\Entity' => 'application_driver',
                ],
            ],
        ],
    ],
];
