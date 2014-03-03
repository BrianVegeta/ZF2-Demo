<?php
return array(
    'controllers' => array(
		'invokables' => array(
			'Cli\Controller\Cli' => 'Cli\Controller\CliController',
		)
    ),
    'console' => array(
		'router' => array(
			'routes' => array(
				'user-reset-password' => array(
					'options' => array(
						'route'    => 'user resetpassword [--verbose|-v] <userEmail>',
						'defaults' => array(
							'controller' => 'Cli\Controller\Cli',
							'action'     => 'index'
						)
					)
				)
			)
		)
    ),
);