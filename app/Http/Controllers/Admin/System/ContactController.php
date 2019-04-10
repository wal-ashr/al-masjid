<?php
namespace App\Http\Controllers\Admin\System;

use Illuminate\Http\Request;

use Expresscode\Controllers\Core\Controller;
use App\Models\Admin\System\Contact;

/**
 * Created on Sep 15, 2018
 * Time Created	: 12:37:38 AM
 * Filename		: ContactController.php
 *
 * @filesource	ContactController.php
 *
 * @author		wisnuwidi@gmail.com - 2018
 * @copyright	wisnuwidi
 * @email		wisnuwidi@gmail.com
 */
 
class ContactController extends Controller {
	
	private $model			= [];
	private $name			= 'contact';
	private $route_group	= 'system.internal.contact';
	private $model_table	= 'base_contact';
	
	private $_hide_fields	= ['id'];
	private $_set_tab		= [];
	private $_tab_config	= [];
	private $flag			= [];
	
	public function __construct() {
		parent::__construct();
		
		$this->model = Contact::withTrashed();
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
		$this->form->lists($this->model_table, ['title', 'name', 'email', 'message', 'active'], $this->model_data, true, true);
		
		$this->searchInputElement('title', 'string');
		$this->searchInputElement('name', 'string');
		$this->searchInputElement('email', 'string');
		$this->searchInputElement('active', 'selectbox', active_box());
		$this->searchDraw($this->model_table, ['id', 'deleted_at'], false);
		
		return $this->render();
	}
	
	public function create() {
		$this->set_page('Add ' . camel_case($this->name), $this->name);
		
		$this->form->model($this->model, "{$this->route_group}.store", false);
		
		$this->form->text('title');
		$this->form->text('name');
		$this->form->text('email');
		$this->form->text('phone');
		$this->form->textarea('message', null, ['required', 'class' => 'form-control ckeditor']);
		$this->form->selectbox('active', active_box(), false, ['required']);
		
		$this->form->close('Submit');
		
		return $this->render();
	}
	
	public function store(Request $request, Contact $model_object) {
		$model		= insert($model_object, $request, true);
		$route_back	= str_replace('.', '/', $this->route_group);
		
		return redirect("{$route_back}/{$model}/edit");
	}
	
	public function edit($id) {
		$this->set_page('Add ' . camel_case($this->name), $this->name);
		$model_data = Contact::find($id);
		
		$this->table_config();
		
		$this->form->model($model_data, "{$this->set_route('update')}", $model_data->id, true);
		
		$this->form->text('title', $model_data->title);
		$this->form->text('name', $model_data->name);
		$this->form->text('email', $model_data->email);
		$this->form->text('phone', $model_data->phone);
		$this->form->textarea('message', $model_data->message, ['required', 'class' => 'form-control ckeditor']);
		$this->form->selectbox('active', active_box(), $model_data->active, ['required']);
		
		$this->form->close('Submit');
		
		return $this->render();
	}
	
	public function update(Request $request, $id, Contact $model_object) {
		return update($model_object::find($id), $request, true);
	}
	
	public function destroy(Request $request, $id, Contact $model) {
		return delete($request, $id, $model, $this->route_group);
	}
}