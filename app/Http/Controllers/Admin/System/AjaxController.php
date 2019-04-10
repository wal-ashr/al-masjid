<?php
namespace App\Http\Controllers\Admin\System;

use Expresscode\Controllers\Core\Controller;
use App\Models\Admin\System\Ajax;
use Illuminate\Http\Request;

/**
 * Created on Jan 23, 2018
 * Time Created	: 11:04:10 AM
 * Filename		: AjaxController.php
 *
 * @filesource	AjaxController.php
 *
 * @author		wisnuwidi@Expresscode - 2018
 * @copyright	wisnuwidi
 * @email		wisnuwidi@gmail.com
 */
class AjaxController extends Controller {
	private $route_group	= 'system.config';
	private $model_table	= 'base_group';
	
	private $_hide_fields	= ['id'];
	private $_set_tab		= [];
	private $_tab_config	= [];
	
	public $data;
	public $model;
	
	public function __construct() {
		parent::__construct();
		
		$this->data = new Ajax();
	}
	
	public function get_sub_region($param_id) {
		$data = $this->data->get_sub_region($param_id);
		
		return $this->returnJSON(['rowData' => $data]);
	}
	
	public function get_activation_year() {
		$data = $this->data->get_activation_year();
		
		return $this->returnJSON(['rowData' => $data]);
	}
	
	public function get_activation_months($year) {
		$data = $this->data->get_activation_months($year);
		
		return $this->returnJSON(['rowData' => $data]);
	}
	
	public function get_activation_regions($year) {
		$data = $this->data->get_activation_regions($year);
		
		return $this->returnJSON(['rowData' => $data]);
	}
	
	public function get_activation_cluster($region) {
		$data = $this->data->get_activation_cluster($region);
		
		return $this->returnJSON(['rowData' => $data]);
	}
	
	public function get_activation_segment($year) {
		$data = $this->data->get_activation_segment($year);
		
		return $this->returnJSON(['rowData' => $data]);
	}
	
	public function get_activation_market_name($segment) {
		$data = $this->data->get_activation_market_name($segment);
		
		return $this->returnJSON(['rowData' => $data]);
	}
	
	public function get_activation_result(Request $request) {
		$data = $this->data->get_activation_result($request);
		
		return $this->returnJSON($data);
	}
	
	public function get_bts_period() {
		$data = $this->data->get_bts_period();
		
		return $this->returnJSON(['rowData' => $data]);
	}
	
	public function get_bts_type($param_id) {
		$data = $this->data->get_bts_type($param_id);
		
		return $this->returnJSON(['rowData' => $data]);
	}
	
	public function get_bts_region_by_period($period) {
		$data = $this->data->get_bts_region_by_period($period);
		
		return $this->returnJSON(['rowData' => $data]);
	}
	
	public function get_bts_region_by_type($bts_type) {
		$data = $this->data->get_bts_region_by_type($bts_type);
		
		return $this->returnJSON(['rowData' => $data]);
	}
	
	public function get_bts_cluster($region) {
		$data = $this->data->get_bts_cluster($region);
		
		return $this->returnJSON(['rowData' => $data]);
	}
	
	public function get_bts_kecamatan($region, $cluster = false) {
		$data = $this->data->get_bts_kecamatan($region, $cluster);
		
		return $this->returnJSON(['rowData' => $data]);
	}
	
	public function get_bts_revenue_result(Request $request) {
		$data = $this->data->get_bts_revenue_result($request);
		
		return $this->returnJSON($data);
	}
}