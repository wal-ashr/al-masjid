<?php
namespace App\Http\Controllers\Admin\System;

use Illuminate\Http\Request;

use Expresscode\Controllers\Core\Controller;
use App\Models\Admin\System\About;

/**
 * Created on Sep 15, 2018
 * Time Created	: 12:36:13 AM
 * Filename		: AboutController.php
 *
 * @filesource	AboutController.php
 *
 * @author		wisnuwidi@gmail.com - 2018
 * @copyright	wisnuwidi
 * @email		wisnuwidi@gmail.com
 */
 
class AboutController extends Controller {
	
	private $model			= [];
	private $name			= 'about';
	private $route_group	= 'system.internal.about';
	private $model_table	= 'base_about';
	
	private $_hide_fields	= ['id'];
	private $_set_tab		= [];
	private $_tab_config	= [];
	private $flag			= [];
	
	public function __construct() {
		parent::__construct();
		
		$this->model = About::withTrashed();
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
		$this->form->lists($this->model_table, ['title', 'content', 'active'], $this->model_data, true, true);
		
		$this->searchInputElement('title', 'string');
		$this->searchInputElement('active', 'selectbox', active_box());
		$this->searchDraw($this->model_table, ['id', 'deleted_at'], false);
		
		return $this->render();
	}
	
	public function create() {
		$this->set_page('Add ' . camel_case($this->name), $this->name);
		
		$this->form->model($this->model, "{$this->route_group}.store", false, true);
		
		$this->form->text('title');
		$this->form->textarea('content', null, ['required', 'class' => 'form-control ckeditor']);
		$this->form->selectbox('active', active_box(), false, ['required']);
		
		$this->form->close('Submit');
		
		return $this->render();
	}
	
	public function store(Request $request, About $model_object) {
		$model		= insert($model_object, $request, true);
		$route_back	= str_replace('.', '/', $this->route_group);
		
		return redirect("{$route_back}/{$model}/edit");
	}
	
	public function edit($id) {
		$this->set_page('Add ' . camel_case($this->name), $this->name);
		$model_data = About::find($id);
		
		$this->table_config();
		
		$this->form->model($model_data, "{$this->set_route('update')}", $model_data->id, true);
		
		$this->form->text('title', $model_data->title);
		$this->form->textarea('content', $model_data->content, ['required', 'class' => 'form-control ckeditor']);
		$this->form->selectbox('active', active_box(), $model_data->active, ['required']);
		
		$this->form->close('Submit');
		
		return $this->render();
	}
	
	public function update(Request $request, $id, About $model_object) {
		return update($model_object::find($id), $request, true);
	}
	
	public function destroy(Request $request, $id, About $model) {
		return delete($request, $id, $model, $this->route_group);
	}
}