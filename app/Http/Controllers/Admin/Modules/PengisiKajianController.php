<?php
namespace App\Http\Controllers\Admin\Modules;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Expresscode\Controllers\Core\Controller;

/**
 * Created on May 14, 2018
 * Time Created	: 10:54:50 AM
 * Filename		: PengisiKajianController.php
 *
 * @filesource	PengisiKajianController.php
 *
 * @author		wisnuwidi@gmail.com - 2018
 * @copyright	wisnuwidi
 * @email		wisnuwidi@gmail.com
 */
 
class PengisiKajianController extends Controller {
	
	private $model			= [];
	private $name			= 'pengisi_kajian';
	private $route_group	= 'modules.pengisi_kajian';
	private $table			= 'base_kajian_pengisi';
	
	private $_hide_fields	= ['id'];
	private $_set_tab		= [];
	private $_tab_config	= [];
	private $flag			= [];
	
	public function __construct() {
		parent::__construct();
	}
	
	private function set_route($path) {
		return "{$this->route_group}.{$path}";
	}
	
	private function table_config() {
		$this->form->table_hide_fields($this->table, $this->_hide_fields);
	}
	
	public function index() {
		$this->set_page(camel_case($this->name) . ' Lists', $this->name);
		$this->form->lists($this->table, [], $this->model);
		
		return $this->render();
	}
}