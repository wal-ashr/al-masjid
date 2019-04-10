<?php
/**
 * Created on Nov 2, 2018
 * Time Created	: 11:51:34 PM
 * Filename			: templates.php
 *
 * @filesource	templates.php
 *
 * @author		wisnuwidi@gmail.com - 2018
 * @copyright	wisnuwidi
 * @email		wisnuwidi@gmail.com
 */
 
return [
	'admin' => [
		'default' => [
			'position' => [
				'top' => [
					'js'	=> [
						'vendor/node_modules/jquery/dist/jquery.min.js',
						'vendor/node_modules/popper.js/dist/umd/popper.min.js',
						'vendor/node_modules/bootstrap/dist/js/bootstrap.min.js',
						'vendor/node_modules/ion-sound/js/ion.sound.min.js'
					],
					'css'	=> ['']
				],
				'bottom' => [
					'first'	=> [
						'js'	=> [
							'vendor/plugins/jquery-ui/jquery-ui.min.js',
							'vendor/plugins/jquery-cookie/jquery.cookie.js',
							'js/metisMenu.min.js',
							'vendor/node_modules/owl.carousel/dist/owl.carousel.min.js',
							'vendor/node_modules/jquery-slimscroll/jquery.slimscroll.min.js',
							'vendor/node_modules/slicknav/dist/jquery.slicknav.min.js',
							'vendor/plugins/jquery-nicescroll/jquery.nicescroll.min.js'
						],
						'css'	=> ['vendor/node_modules/bootstrap/dist/css/bootstrap.css']
					],
					'last'	=> [
						'js'	=> [
							'js/plugins.js',
							'js/scripts.js'
						],
						'css'	=> ['css/config.css']
					]
				]
			],
			'table' => [
				'js'	=> [
					'vendor/node_modules/datatables/js/responsive/jquery.dataTables.10.01.19.min.js',// 'https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
					'vendor/node_modules/datatables/js/responsive/dataTables.responsive.2.2.3.min.js',// 'https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js',
					/* OLD
					'vendor/node_modules/datatables/js/jquery.dataTables.min.js',
					'vendor/node_modules/datatables/js/datatables.responsive.js',
					 */
					'vendor/node_modules/datatables/js/dataTables.bootstrap.js',
					'vendor/node_modules/datatables/extentions/dataTables.buttons.min.js',
					'vendor/node_modules/datatables/extentions/buttons.html5.min.js',
					'vendor/node_modules/datatables/extentions/buttons.colVis.min.js',
					'vendor/node_modules/datatables/extentions/buttons.print.min.js',
					'vendor/node_modules/datatables/extentions/jszip.min.js',
					'vendor/node_modules/datatables/extentions/pdfmake.min.js',
					'vendor/node_modules/datatables/extentions/vfs_fonts.js',
					'vendor/node_modules/datatables/extentions/buttons.flash.min.js'
				],
				'css'	=> [
				//	'vendor/node_modules/datatables/css/responsive/jquery.dataTables.min.css', //'https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css',
				//	'vendor/node_modules/datatables/css/responsive/responsive.dataTables.min.css', //'https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css',
					
					'vendor/node_modules/datatables/css/dataTables.bootstrap.css',
					'vendor/node_modules/datatables/css/buttons.dataTables.min.css',
					'vendor/node_modules/datatables/css/dataTables.responsive.css',
				]
			],
			'textarea'	=> [
				'js'		=> ['vendor/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js'],
				'css'		=> ['']
			],
			'tagsinput' => [
				'js'	=> ['vendor/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js'],
				'css'	=> ['vendor/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css']
			],
			'time' => [
				'js'	=> [
					'vendor/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js',
					'vendor/plugins/prettify/prettify.js'
				],
				'css'	=> ['vendor/plugins/bootstrap-timepicker/css/timepicker.css']
			],
			'daterange' => [
				'js'	=> [
					'vendor/plugins/moment/min/moment.min.js',
					'vendor/plugins/bootstrap-daterangepicker/daterangepicker.js'
				],
				'css'	=> ['vendor/plugins/bootstrap-daterangepicker/daterangepicker.css']
			],
			'date' => [
				'js'	=> ['vendor/plugins/bootstrap-datepicker-vitalets/js/bootstrap-datepicker.js'],
				'css'	=> ['vendor/plugins/bootstrap-datepicker-vitalets/css/datepicker.css']
			],
			'file' => [
				'js'	=> ['vendor/node_modules/jasny-bootstrap/dist/js/jasny-bootstrap.min.js'],
				'css'	=> ['vendor/node_modules/jasny-bootstrap/dist/css/jasny-bootstrap.min.css']
			],
			'select' => [
				'js'	=> ['vendor/node_modules/chosen-js/chosen.jquery.min.js'],
				'css'	=> ['vendor/node_modules/chosen-js/chosen.min.css']
			],
			'timepickers' => [
				'js'	=> ['js/form.picker.js'],
				'css'	=> ['']
			]
		]
	],
	
	'frontend' => [
		'default' => [
			'position'	=> [
				'top'		=> [
					'js'	=> [
						'vendor/node_modules/jquery/dist/jquery.min.js',
						'vendor/node_modules/bootstrap/dist/js/bootstrap.min.js'
					],
					'css'	=> ['']
				],
				'bottom' => [
					'first'	=> [
						'js'	=> [
							'vendor/plugins/jquery-ui/jquery-ui.min.js',
							'vendor/plugins/jquery-cookie/jquery.cookie.js'
						],
						'css'	=> [
							'vendor/node_modules/bootstrap/dist/css/bootstrap.css',
							'frontend/css/open-iconic-bootstrap.min.css',
							'frontend/css/animate.css',
							'frontend/css/owl.carousel.min.css',
							'frontend/css/owl.theme.default.min.css',
							'frontend/css/magnific-popup.css',
							'frontend/css/aos.css',
							'frontend/css/ionicons.min.css',
							'frontend/css/bootstrap-datepicker.css',
							'frontend/css/jquery.timepicker.css',
							'frontend/css/flaticon.css',
							'frontend/css/icomoon.css',
							'frontend/css/style.css'
						]
					],
					'last'	=> [
						'js'	=> [
						//	'frontend/js/jquery.min.js',
							'frontend/js/jquery-migrate-3.0.1.min.js',
							'frontend/js/popper.min.js',
						//	'frontend/js/bootstrap.min.js',
							'frontend/js/jquery.easing.1.3.js',
							'frontend/js/jquery.waypoints.min.js',
							'frontend/js/jquery.stellar.min.js',
							'frontend/js/owl.carousel.min.js',
							'frontend/js/jquery.magnific-popup.min.js',
							'frontend/js/aos.js',
							'frontend/js/jquery.animateNumber.min.js',
							'frontend/js/bootstrap-datepicker.js',
							'frontend/js/jquery.timepicker.min.js',
							'frontend/js/scrollax.min.js',
						//	'https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false',
							'frontend/js/google-map.js',
							'frontend/js/main.js'
						],
						'css'	=> ['frontend/css/style.css']
					]
				]
			],
			'table' => [
				'js'	=> [
					'vendor/node_modules/datatables/js/jquery.dataTables.min.js',
					'vendor/node_modules/datatables/js/dataTables.bootstrap.js',
					'vendor/node_modules/datatables/js/datatables.responsive.js',
					'vendor/node_modules/datatables/extentions/dataTables.buttons.min.js',
					'vendor/node_modules/datatables/extentions/buttons.html5.min.js',
					'vendor/node_modules/datatables/extentions/buttons.colVis.min.js',
					'vendor/node_modules/datatables/extentions/buttons.print.min.js',
					'vendor/node_modules/datatables/extentions/jszip.min.js',
					'vendor/node_modules/datatables/extentions/pdfmake.min.js',
					'vendor/node_modules/datatables/extentions/vfs_fonts.js',
					'vendor/node_modules/datatables/extentions/buttons.flash.min.js'
				],
				'css'	=> [
					'vendor/node_modules/datatables/css/dataTables.bootstrap.css',
					'vendor/node_modules/datatables/css/dataTables.responsive.css',
					'vendor/node_modules/datatables/css/buttons.dataTables.min.css'
				]
			]/* ,
			'textarea' => [
				'js'	=> [''],
				'css'	=> ['']
			],
			'tagsinput' => [
				'js'	=> [''],
				'css'	=> ['']
			],
			'time' => [
				'js'	=> [''],
				'css'	=> ['']
			],
			'daterange' => [
				'js'	=> [''],
				'css'	=> ['']
			],
			'date' => [
				'js'	=> [''],
				'css'	=> ['']
			],
			'file' => [
				'js'	=> [''],
				'css'	=> ['']
			],
			'select' => [
				'js'	=> [''],
				'css'	=> ['']
			],
			'timepickers' => [
				'js'	=> [''],
				'css'	=> ['']
			] */
		]
	]
];