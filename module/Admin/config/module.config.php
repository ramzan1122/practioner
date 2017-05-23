<?php
namespace Admin;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Zend\ServiceManager\Factory\InvokableFactory;
return [
    'router' => [
        'routes' => [
            'login' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/admin/login',
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'action'     => 'login',
                    ],
                ],
            ],
            'login' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/admin',
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'action'     => 'login',
                    ],
                ],
            ],            
            'logout' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/admin/logout',
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'action'     => 'logout',
                    ],
                ],
            ],
            'reset-password' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/admin/reset-password',
                    'defaults' => [
                        'controller' => Controller\UserController::class,
                        'action'     => 'resetPassword',
                    ],
                ],
            ],
            'set-password' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/admin/set-password',
                    'defaults' => [
                        'controller' => Controller\UserController::class,
                        'action'     => 'setPassword',
                    ],
                ],
            ],
            'users' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/admin/users[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller'    => Controller\UserController::class,
                        'action'        => 'index',
                    ],
                ],
            ],
            'category' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/admin/category[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller'    => Controller\CategoryController::class,
                        'action'        => 'index',
                    ],
                ],
            ],            
            
            'dashboard' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/admin/dashboard',
                    'defaults' => [
                        'controller' => Controller\DashboardController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\AuthController::class => Controller\Factory\AuthControllerFactory::class,
            Controller\UserController::class => Controller\Factory\UserControllerFactory::class, 
            Controller\CategoryController::class => Controller\Factory\CategoryControllerFactory::class,
            Controller\DashboardController::class => InvokableFactory::class,
        ],
    ],
    // The 'access_filter' key is used by the User module to restrict or permit
    // access to certain controller actions for unauthorized visitors.
    'access_filter' => [
        'controllers' => [
            Controller\UserController::class => [
                // Give access to "resetPassword", "message" and "setPassword" actions
                // to anyone.
                ['actions' => ['resetPassword', 'message', 'setPassword'], 'allow' => '*'],
                // Give access to "index", "add", "edit", "view", "changePassword" actions to authorized users only.
                ['actions' => ['index', 'add', 'edit', 'view', 'changePassword'], 'allow' => '@']
            ],
            Controller\CategoryController::class => [
                // Give access to "resetPassword", "message" and "setPassword" actions
                // to anyone.
                ['actions' => ['resetPassword', 'message', 'setPassword'], 'allow' => '*'],
                // Give access to "index", "add", "edit", "view", "changePassword" actions to authorized users only.
                ['actions' => ['index', 'add', 'edit', 'view', 'changePassword'], 'allow' => '@']
            ],
        ]
    ],
    'service_manager' => [
        'factories' => [
            \Zend\Authentication\AuthenticationService::class => Service\Factory\AuthenticationServiceFactory::class,
            Service\AuthAdapter::class => Service\Factory\AuthAdapterFactory::class,
            Service\AuthManager::class => Service\Factory\AuthManagerFactory::class,
            Service\UserManager::class => Service\Factory\UserManagerFactory::class,
            Service\CategoryManager::class => Service\Factory\CategoryManagerFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ],
    

    
];