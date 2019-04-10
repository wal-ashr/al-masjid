<?php
namespace App\Http\Controllers\Admin\System;

use Expresscode\Controllers\Core\Controller;
use Expresscode\Libraries\Search;

use Expresscode\Models\Admin\System\Modules;
use Expresscode\Models\Admin\System\Multiplatforms;
use Expresscode\Models\Admin\System\Log;

/**
 * Created on Jan 12, 2019
 * Time Created	: 11:12:53 PM
 * Filename		: SearchController.php
 *
 * @filesource	SearchController.php
 *
 * @author		wisnuwidi@gmail.com - 2019
 * @copyright	wisnuwidi
 * @email		wisnuwidi@gmail.com
 */
 
class SearchController extends Controller {
	public $data;
	
	private $route_group	= 'system.search';
	
	private $_set_tab		= [];
	private $_tab_config	= [];
	private $_getKey;
	
	public $searchModel;
	public function __construct() {
		parent::__construct();
		
		$this->searchModel					= new Search();
		if (!empty($_GET)) $this->_getKey	= strtolower(decrypt(array_keys($_GET)[0]));
		
		$this->base_route	= "{$this->route_group}.";
	}
	
	/**
	 * Search Index Page
	 * 
	 * created @Jan 13, 2019
	 * author: wisnuwidi
	 * 
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function index() {
		$this->hide_button_actions();
		$this->set_page('Search', 'Result');
		
		$this->get_data();
		$this->form->draw($this->searchModel->searchBox);
		
		return $this->render();
	}
	
	/**
	 * Set Search Data By Registring the Models
	 * 
	 * created @Jan 13, 2019
	 * author: wisnuwidi
	 * 
	 * @return \App\Http\Controllers\Admin\System\SearchController
	 */
	public function set_data() {
		if (!empty($_GET)) {
			if ('search' === $this->_getKey) {
				$this->_getKey = array_keys($_GET);
				$this->searchModel->set_search_query(($this->searchModel->searchable)
					->registerModel(Modules::class, 'module_name')
					->registerModel(Multiplatforms::class, 'name')
					->registerModel(Log::class, 'method')
					->perform($_GET[$this->_getKey[0]])
				);
				
				$this->searchModel->result();
			}
		}
		
		return $this;
	}
	
	/**
	 * Get Search Data By Registred the Models
	 * 
	 * created @Jan 13, 2019
	 * author: wisnuwidi
	 * 
	 * @return \App\Http\Controllers\Admin\System\SearchController
	 */
	private function get_data() {
		$this->set_data();
		
		return $this;
	}
}