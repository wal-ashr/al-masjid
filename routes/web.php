<?php
/**
 * Created on Mar 6, 2017
 * Time Created	: 1:11:12 PM
 * Filename		: web.php
 *
 * @filesource	web.php
 *
 * @author		wisnuwidi @Expresscode - 2017
 * @copyright	wisnuwidi
 * @email		wisnuwidi@gmail.com
 */
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return view('welcome');
});

Route::group(['middleware' => ['web']], function () {
	Route::get	('/login',				['as' => 'login',					'uses' => 'Admin\System\AuthController@login']);
	Route::post	('/login_processor',	['as' => 'login_processor',	'uses' => 'Admin\System\AuthController@login_processor']);
	Route::get	('/logout',				['as' => 'logout',				'uses' => 'Admin\System\AuthController@logout']);
	
	// Set 'middleware' => 'auth' for return back to the login page when user data login is false
	Route::group(['middleware' => 'auth'], function() {
		
		Route::resource('dashboard',	'Admin\System\DashboardController');
		// SYSTEM
		Route::group(['prefix' => 'system'], function() {
			Route::resource('search',				'Admin\System\SearchController',			['as' => 'system']);
			// CONFIGURATION
			Route::group(['prefix' => 'config'], function() {
				Route::resource('module',			'Admin\System\ModulesController',		['as' => 'system.config']);
				Route::resource('preference',		'Admin\System\PreferenceController',	['as' => 'system.config']);
				Route::resource('maintenance',	'Admin\System\MaintenanceController',	['as' => 'system.config']);
				Route::resource('group',			'Admin\System\GroupController', 			['as' => 'system.config']);
				Route::resource('icon',				'Admin\System\IconController', 			['as' => 'system.config']);
				Route::resource('log',				'Admin\System\LogController',				['as' => 'system.config']);
				
				if ('multiple' === get_config('settings.platform_type')) {
					$platform_name	= get_config('settings.platform_name');
					Route::group(['prefix' => $platform_name], function() {
						$platform_name	= get_config('settings.platform_name');
						Route::resource('type',				'Admin\Modules\\' . get_config('settings.platform_label') . 'TypeController',			['as' => "system.config.{$platform_name}"]);
						Route::resource('land_status',	'Admin\Modules\\' . get_config('settings.platform_label') . 'LandStatusController',	['as' => "system.config.{$platform_name}"]);
					});
				}
			});
				
			// INTERNAL
			Route::group(['prefix' => 'internal'], function() {
				Route::resource('about',			'Admin\System\AboutController',		['as' => 'system.internal']);
				Route::resource('teams',			'Admin\System\TeamsController',		['as' => 'system.internal']);
				Route::resource('contact',			'Admin\System\ContactController',	['as' => 'system.internal']);
				Route::resource('faq',				'Admin\System\FaqController',			['as' => 'system.internal']);
			});
			
			// ACCOUNTS
			Route::group(['prefix' => 'accounts'], function() {
				Route::resource('user', 'Admin\System\UserController', ['as' => 'system.accounts']);
				if ('multiple' === get_config('settings.platform_type')) {
					Route::get('user/get_group_by_platforms/{' . get_config('settings.platform_key') . '?}',	['uses' => 'Admin\System\UserController@get_group_by_platforms', 'as' => 'system.accounts.user.get_group_by_platforms']);
				}
			});
			
			// MESSAGES
			Route::resource('messages', 'Admin\System\MessagesController', ['as' => 'system']);
			
			// BANNERS
			Route::group(['prefix' => 'banners'], function() {
				Route::resource('type',				'Admin\System\BannersTypeController', 		['as' => 'system.banners']);
				Route::resource('contents',		'Admin\System\BannersController', 			['as' => 'system.banners']);
				Route::resource('approvals',		'Admin\System\BannersApprovalController',	['as' => 'system.banners']);
			});
				
			// ARTICLES
			Route::group(['prefix' => 'articles'], function() {
				Route::resource('type',				'Admin\System\ArticlesTypeController', 		['as' => 'system.articles']);
				Route::resource('contents',		'Admin\System\ArticlesController', 				['as' => 'system.articles']);
				Route::resource('approvals',		'Admin\System\ArticlesApprovalController',	['as' => 'system.articles']);
			});
		});
		
		// MODULES
		Route::group(['prefix' => 'modules'], function() {
			if ('multiple' === get_config('settings.platform_type')) {
				$platform_name	= get_config('settings.platform_name');
				Route::resource($platform_name, 'Admin\System\MultiplatformsController', ['as' => 'modules']);
				Route::get(get_config('settings.platform_name') . '/{' . get_config('settings.platform_name') . '}/manage',	['uses' => 'Admin\System\MultiplatformsController@manage',	'as' => 'modules.' . get_config('settings.platform_name') . '.manage']);
			}
			
			// APPROVALS
			Route::resource('banner',					'Admin\Modules\BannerController',			['as' => 'modules']);
			Route::resource('article',					'Admin\Modules\ArticleController',			['as' => 'modules']);
			
			Route::group(['prefix' => 'kajian'], function() {
				Route::resource('pengisi_kajian',	'Admin\Modules\PengisiKajianController',	['as' => 'modules.kajian']);
				Route::resource('jadwal_kajian',		'Admin\Modules\JadwalKajianController',	['as' => 'modules.kajian']);
			});
			
			Route::group(['prefix' => 'sholat'], function() {
				Route::resource('imam_sholat',		'Admin\Modules\ImamSholatController',		['as' => 'modules.sholat']);
				Route::resource('jadwal_sholat',		'Admin\Modules\PrayTimesController',		['as' => 'modules.sholat']);
			});
			
			Route::group(['prefix' => 'events'], function() {
				Route::resource('national_events',	'Admin\Modules\NationalEventsController',	['as' => 'modules.events']);
				Route::resource('popup_events',		'Admin\Modules\PopupEventsController',		['as' => 'modules.events']);
			});
			
			Route::resource('financial',				'Admin\Modules\FinanceController',			['as' => 'modules']);
		});
		
		// TESTING
		Route::group(['prefix' => 'developments'], function() {
			Route::resource('testing', 'Admin\Modules\TestingController', ['as' => 'developments']);
			Route::get('generate_excel', ['uses' => 'Admin\Modules\TestingController@generate_excel', 'as' => 'developments.generate_excel']);
		});
		
		// PRIVATE FRONTEND
		Route::resource('article', 'Frontend\Modules\ArticleController');
	});
	/* 
	// PUBLIC FRONTEND
	Route::group(['prefix' => 'frontend.modules'], function() {
		Route::group(['prefix' => 'modules'], function() {
			Route::resource('article', 'Frontend\Modules\ArticleController');
		});
	});
	 */
});