<?php
namespace App\Http\Controllers\Admin\Modules;

use Expresscode\Controllers\Core\Controller;

class HomeController extends Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Show the application dashboard.
	 * 
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return $this->render();
	}
}
