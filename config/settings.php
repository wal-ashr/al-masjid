<?php
/**
 * Created on Mar 30, 2017
 * Time Created	: 11:31:38 AM
 * Filename			: settings.php
 *
 * @filesource	settings.php
 *
 * @author		wisnuwidi @Expresscode - 2017
 * @copyright	wisnuwidi
 * @email		wisnuwidi@gmail.com
 */

return [
	'baseURL'				=> 'http://localhost/al-masjid/page',
	'index_folder'			=> 'page',
	'baseFileUpload'		=> 'assets/resources',
	'app_name'				=> 'Expresscode',
	'app_desc'				=> 'Expresscode Application Website',
	'version'				=> 'cbxpsscdeis-v3.0.0',
	'lang'					=> 'en',
	'charset'				=> 'UTF-8',
	'maintenance'			=> false, 
	// maintenance: if true, we can bypass with this code[login?as=username|email]
	// this set config file used to make sure if set database maintenance status changed by others or hacked or crashed database
	// so, the application will be read based on this file set.
	
	// PLATFORM
	'platform_type'		=> 'multiple',			// ['single', 'multiple']
	'platform_table'		=> 'base_masjid',		// if single = false
	'platform_key'			=> 'masjid_id',		// if single = false
	'platform_name'		=> 'masjid',			// if single = false
	'platform_label'		=> 'Masjid',			// if single = false
	'platform_route'		=> 'modules.masjid',	// if single = false
	
	// COPYRIGHT INFO
	'copyrights'			=> 'Expresscode',
	'location'				=> 'Jakarta',
	'location_abbr'		=> 'ID',
	'created_at'			=> '2017',
	'email'					=> 'wisnuwidi@gmail.com',
	'website'				=> 'https://expresscode.com',
	
	// Meta Tags
	'meta_author'			=> 'Wisnu Widiantoko',
	'meta_title'			=> 'Expresscode',
	'meta_keywords'		=> 'Expresscode',
	'meta_description'	=> 'Expresscode Application Website',
	'meta_viewport'		=> 'width=device-width, initial-scale=1.0, maximum-scale=1.0',
	'meta_http_equiv'		=> [
		'type'		=> 'X-UA-Compatible',
		'content'	=> 'IE=edge,chrome=1'
	]
];