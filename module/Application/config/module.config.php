<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
		'modules'=>array(
			'Application',
		),

		'router' => array(
            'routes' => array(
                'home' => array(
                    'type' => 'Zend\Mvc\Router\Http\Literal',
                    'options' => array(
                        'route'    => '/',
                         'defaults' => array(
                            '__NAMESPACE__' => 'Application\Controller',
                            'controller'    => 'Index',
                            'action'        => 'index',
                        ),
                    ),
                    'may_terminate' => true,
                    'child_routes' => array(
                        'default' => array(
                            'type'    => 'Segment',
                            'options' => array(
                                'route'    => '/home-page',
                                'defaults' => array(
                                    '__NAMESPACE__' => 'Application\Controller',
                                    'controller'    => 'Index',
                                    'action'        => 'index',
                                ),
                            ),
                        ),
                    ),
                ),
                'homepage' => array(
                    'type' => 'Zend\Mvc\Router\Http\Literal',
                    'options' => array(
                        'route'    => '/homepage',
                         'defaults' => array(
                            '__NAMESPACE__' => 'Application\Controller',
                            'controller'    => 'Index',
                            'action'        => 'index',
                        ),
                    ),
                ),
                'backend' => array(
                    'type'    => 'Literal',
                    'options' => array(
                        'route'    => '/backend',
                        'defaults' => array(
                            '__NAMESPACE__' => 'Application\Controller',
                            'controller'    => 'Admin',
                            'action'        => 'index',
                        ),
                    ),
                    'may_terminate' => true,
                    'child_routes' => array(
                        'default' => array(
                            'type'    => 'Segment',
                            'options' => array(
                                'route'    => '/[:controller[/:action]]',
                                'constraints' => array(
                                    'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                    'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                ),
                                'defaults' => array(
                                    '__NAMESPACE__' => 'Application\Controller',
                                    'controller'    => 'Admin',
                                    'action'        => 'index',
                                ),
                            ),
                        ),
                    ),
                ),
                'front-end' => array(
                    'type'    => 'Literal',
                    'options' => array(
                        'route'    => '/front-end',
                        'defaults' => array(
                            '__NAMESPACE__' => 'Application\Controller',
                            'controller'    => 'Index',
                            'action'        => 'index',
                        ),
                    ),
                    'may_terminate' => true,
                    'child_routes' => array(
                        'default' => array(
                            'type'    => 'Segment',
                            'options' => array(
                                'route'    => '/[:controller[/:action]]',
                                'constraints' => array(
                                    'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                    'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                ),
                                'defaults' => array(
                                    '__NAMESPACE__' => 'Application\Controller',
                                    'controller'    => 'Index',
                                    'action'        => 'index',
                                ),
                            ),
                        ),
                    ),
                ),
                'buy' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route'    => '/buy',
                        'defaults' => array(
                            'controller' => 'Application\Controller\Index',
                            'action'     => 'buy',
                        ),
                    ),
                ),
                'projects' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route'    => '/projects',
                        'defaults' => array(
                            'controller' => 'Application\Controller\Index',
                            'action'     => 'project-list',
                        ),
                    ),
                    'may_terminate' => true,
                    'child_routes'  => array(
                        'detail' => array(
                            'type' => 'segment',
                            'options' => array(
                                'route'    => '/:slug',
                                'defaults' => array(
                                    'action' => 'project-detail'
                                ),
                                'constraints' => array(
                                    'slug' => '[a-zA-Z0-9_-][a-zA-Z0-9_-]*'
                                )
                            )
                        )
                    )
                ),
                'projects-in-noida' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route'    => '/projects-in-noida',
                        'defaults' => array(
                            'controller' => 'Application\Controller\Index',
                            'action'     => 'project-list',
                        ),
                    ),
                    'may_terminate' => true,
                    'child_routes'  => array(
                        'detail' => array(
                            'type' => 'segment',
                            'options' => array(
                                'route'    => '/:slug',
                                'defaults' => array(
                                    'action' => 'project-detail'
                                ),
                                'constraints' => array(
                                    'slug' => '[a-zA-Z][a-zA-Z0-9_-]*'
                                )
                            )
                        )
                    )
                ),
                'builders' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route'    => '/builders',
                        'defaults' => array(
                            'controller' => 'Application\Controller\Index',
                            'action'     => 'builders',
                        ),
                    ),
                    'may_terminate' => true,
                    'child_routes'  => array(
                        'detail' => array(
                            'type' => 'segment',
                            'options' => array(
                                'route'    => '/:slug',
                                'defaults' => array(
                                    'action' => 'builder-detail'
                                ),
                                'constraints' => array(
                                    'slug' => '[a-zA-Z][a-zA-Z0-9_-]*'
                                )
                            )
                        )
                    )
                ),
                
                
                'user' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route'    => '/user',
                        'defaults' => array(
                            'controller' => 'Application\Controller\User',
                            'action'     => 'portfolio',
                        ),
                    ),
                    'may_terminate' => true,
                    'child_routes'  => array(
                        'recently-viewed' => array(
                            'type' => 'literal',
                            'options' => array(
                                'route' => '/recently-viewed',
                                'defaults' => array(
                                    'action' => 'recently-viewed',
                                ),
                            ),
                            'may_terminate' => true,
                        ),
                        'account-settings' => array(
                            'type' => 'literal',
                            'options' => array(
                                'route' => '/account-settings',
                                'defaults' => array(
                                    'action' => 'account-settings',
                                ),
                            ),
                            'may_terminate' => true,
                        ),
                        'portfolio' => array(
                            'type' => 'literal',
                            'options' => array(
                                'route' => '/portfolio',
                                'defaults' => array(
                                    'action' => 'portfolio',
                                ),
                            ),
                            'may_terminate' => true,
                        ),
                        'enquired-properties' => array(
                            'type' => 'literal',
                            'options' => array(
                                'route' => '/enquired-properties',
                                'defaults' => array(
                                    'action' => 'enquired-properties',
                                ),
                            ),
                            'may_terminate' => true,
                        ),
                    )
                ),
                
                'maps' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route'    => '/maps/projects',
                        'defaults' => array(
                            'controller' => 'Application\Controller\Index',
                            'action'     => 'mapsearch',
                        ),
                    ),
                ),
                'compare-projects' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route'    => '/compare-projects',
                        'defaults' => array(
                            'controller' => 'Application\Controller\Index',
                            'action'     => 'compare-project',
                        ),
                    ),
                ),
                'vaastu-tips' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route'    => '/vaastu-tips',
                        'defaults' => array(
                            'controller' => 'Application\Controller\Index',
                            'action'     => 'vaastu-tips',
                        ),
                    ),
                ),
                'emi' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route'    => '/emi-calculator',
                        'defaults' => array(
                            'controller' => 'Application\Controller\Index',
                            'action'     => 'emi',
                        ),
                    ),
                ),
                'faq' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route'    => '/faq',
                        'defaults' => array(
                            'controller' => 'Application\Controller\Index',
                            'action'     => 'faq',
                        ),
                    ),
                ),
                'home-loan' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route'    => '/home-loan',
                        'defaults' => array(
                            'controller' => 'Application\Controller\Index',
                            'action'     => 'home-loan',
                        ),
                    ),
                ),
                'nri' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route'    => '/nri-services',
                        'defaults' => array(
                            'controller' => 'Application\Controller\Index',
                            'action'     => 'nri',
                        ),
                    ),
                ),
                'about-us' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route'    => '/about-us',
                        'defaults' => array(
                            'controller' => 'Application\Controller\Index',
                            'action'     => 'about-us',
                        ),
                    ),
                ),
                'careers' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route'    => '/careers',
                        'defaults' => array(
                            'controller' => 'Application\Controller\Index',
                            'action'     => 'careers',
                        ),
                    ),
                ),
                'contact-us' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route'    => '/contact-us',
                        'defaults' => array(
                            'controller' => 'Application\Controller\Index',
                            'action'     => 'contact-us',
                        ),
                    ),
                ),
            ),
		),
		'service_manager' => array(
				'abstract_factories' => array(
						'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
						'Zend\Log\LoggerAbstractServiceFactory',
				),
				'aliases' => array(
						'translator' => 'MvcTranslator',
				),
		),
		'translator' => array(
				'locale' => 'en_US',
				'translation_file_patterns' => array(
						array(
								'type'     => 'gettext',
								'base_dir' => __DIR__ . '/../language',
								'pattern'  => '%s.mo',
						),
				),
		),
		'controllers' => array(
				'invokables' => array(
					'Application\Controller\Index' 			=> 'Application\Controller\IndexController',
					'Application\Controller\Admin' 			=> 'Application\Controller\AdminController',
					'Application\Controller\User' 			=> 'Application\Controller\UserController',
				),
		),

		'controller_plugins' => array(
            'invokables' => array(
                    /* 'HelperAuth' 				=> 'Application\Controller\Plugin\HelperAuth',
                    'CommonFunctions' 				=> 'Application\Controller\Plugin\CommonFunctions',
                    'Acl2' 							=> 'Application\Controller\Plugin\Acl2',
                    'csvUserExport' 				=> 'Application\Controller\Plugin\csvUserExport',
                    'Trainingcatelogallplace'		=> 'Application\Controller\Plugin\Trainingcatelogallplace',
                    'ElearningMedia'				=> 'Application\Controller\Plugin\ElearningMedia',
                    'Enrolleduserfromallplace' 		=> 'Application\Controller\Plugin\Enrolleduserfromallplace',
                    'Mailnotification'				=> 'Application\Controller\Plugin\Mailnotification',
                    'Mylearningfunctions'			=> 'Application\Controller\Plugin\Mylearningfunctions',
                    'Coursecreditfunctions'			=> 'Application\Controller\Plugin\Coursecreditfunctions',
                    'TrainingItemsFunctions'		=> 'Application\Controller\Plugin\TrainingItemsFunctions',
                    'Assignmentfunctions'			=> 'Application\Controller\Plugin\Assignmentfunctions', */
            )
		),

		'view_manager' => array(
            'display_not_found_reason' => true,
            'display_exceptions'       => true,
            'doctype'                  => 'HTML5',
            'not_found_template'       => 'error/404',
            'exception_template'       => 'error/index',
            'template_map' => array(
                'layout/layout'            	=> __DIR__ . '/../view/layout/layout.phtml',
                /* 'adminheader'              	=> __DIR__ . '/../view/layout/scripts/adminheader.phtml',
                'standard/adminheader'     	=> __DIR__ . '/../view/layout/scripts/standard/adminheader.phtml',
                'header'           			=> __DIR__ . '/../view/layout/scripts/header.phtml',
                'leftnav'           		=> __DIR__ . '/../view/layout/scripts/leftnav.phtml',
                'footer'           			=> __DIR__ . '/../view/layout/scripts/footer.phtml',
                'application/index/index'  	=> __DIR__ . '/../view/application/index/index.phtml', */
                'error/404'                	=> __DIR__ . '/../view/error/404.phtml',
                'error/index'              	=> __DIR__ . '/../view/error/index.phtml',
            ),
            'template_path_stack' => array(
                    'application'=> __DIR__ . '/../view',
            ),
		),

		'service_manager'=>array(
            'initializers' => array(
                function ($instance, $sm) {
                    if ($instance instanceof \Zend\Db\Adapter\AdapterAwareInterface) {
                        $instance->setDbAdapter($sm->get('Zend\Db\Adapter\Adapter'));
                    }
                }
            ),
            // 'invokables' => array(
            // 'Application\Model\UserTable' => 'Application\Model\UserTable'
            // )
		),

);
