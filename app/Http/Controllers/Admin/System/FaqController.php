<?php
namespace App\Http\Controllers\Admin\System;

use Illuminate\Http\Request;

use Expresscode\Controllers\Core\Controller;
use App\Models\Admin\System\Faqs;

/**
 * Created on Sep 15, 2018
 * Time Created	: 12:38:27 AM
 * Filename		: FaqController.php
 *
 * @filesource	FaqController.php
 *
 * @author		wisnuwidi@gmail.com - 2018
 * @copyright	wisnuwidi
 * @email		wisnuwidi@gmail.com
 */
 
class FaqController extends Controller {
	
	private $model			= [];
	private $name			= 'faq';
	private $route_group	= 'system.internal.faq';
	private $model_table	= 'base_faq';
	
	private $_hide_fields	= ['id'];
	private $_set_tab		= [];
	private $_tab_config	= [];
	private $flag			= [];
	
	public function __construct() {
		parent::__construct();
		
		$this->model = Faqs::withTrashed();
		$this->model_query($this->model);
	}
	
	private function set_route($path) {
		return "{$this->route_group}.{$path}";
	}
	
	private function table_config() {
		$this->form->table_hide_fields($this->model_table, $this->_hide_fields);
	}
	
	public function index() {
		$this->set_page($this->name . ' Lists', $this->name);
		
		$this->table_config();
		$this->form->lists($this->model_table, ['question', 'answer', 'active'], $this->model_data, true, true);
		
		$this->searchInputElement('active', 'selectbox', active_box());
		$this->searchDraw($this->model_table, ['id', 'created_at', 'updated_at', 'deleted_at']);
		
		return $this->render();
	}
	
	public function create() {
		$this->set_page('Add ' . camel_case($this->name), $this->name);
		
		$this->form->model($this->model, "{$this->route_group}.store", false, true);
		
		$this->form->textarea('question', null, ['required', 'class' => 'form-control ckeditor']);
		$this->form->textarea('answer', null, ['required', 'class' => 'form-control ckeditor']);
		$this->form->selectbox('active', active_box(), false, ['required']);
		
		$this->form->close('Submit');
		
		return $this->render();
	}
	
	public function store(Request $request, Faqs $model_object) {
		$model		= insert($model_object, $request, true);
		$route_back	= str_replace('.', '/', $this->route_group);
		
		return redirect("{$route_back}/{$model}/edit");
	}
	
	public function edit($id) {
		$this->set_page('Add ' . camel_case($this->name), $this->name);
		$model_data = Faqs::find($id);
		
		$this->table_config();
		
		$this->form->model($model_data, "{$this->set_route('update')}", $model_data->id, true);
		
		$this->form->textarea('question', $model_data->question, ['required', 'class' => 'form-control ckeditor']);
		$this->form->textarea('answer', $model_data->answer, ['required', 'class' => 'form-control ckeditor']);
		$this->form->selectbox('active', active_box(), $model_data->active, ['required']);
		
		$this->form->close('Submit');
		
		return $this->render();
	}
	
	public function update(Request $request, $id, Faqs $model_object) {
		return update($model_object::find($id), $request, true);
	}
	
	public function destroy(Request $request, $id, Faqs $model) {
		return delete($request, $id, $model, $this->route_group);
	}
}