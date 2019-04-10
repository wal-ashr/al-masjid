<?php
namespace App\Http\Controllers\Admin\System;

use Illuminate\Http\Request;

use Expresscode\Controllers\Core\Controller;
use App\Models\Admin\System\Teams;

/**
 * Created on Sep 15, 2018
 * Time Created	: 12:37:00 AM
 * Filename		: TeamsController.php
 *
 * @filesource	TeamsController.php
 *
 * @author		wisnuwidi@gmail.com - 2018
 * @copyright	wisnuwidi
 * @email		wisnuwidi@gmail.com
 */
 
class TeamsController extends Controller {
	
	private $model			= [];
	private $name			= 'teams';
	private $route_group	= 'system.internal.teams';
	private $model_table	= 'base_teams';
	
	private $_hide_fields	= ['id'];
	private $_set_tab		= [];
	private $_tab_config	= [];
	private $flag			= [];
	
	public function __construct() {
		parent::__construct();
		
		$this->model = Teams::withTrashed();
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
		$this->form->lists($this->model_table, ['name', 'photo', 'job_title', 'active'], $this->model_data, true, true);
		
		$this->searchInputElement('name', 'string');
		$this->searchInputElement('job_title', 'string');
		$this->searchInputElement('active', 'selectbox', active_box());
		$this->searchDraw($this->model_table, ['id', 'deleted_at'], false);
		
		return $this->render();
	}
	
	public function create() {
		$this->set_page('Add ' . camel_case($this->name), $this->name);
		
		$this->form->model($this->model, "{$this->route_group}.store", false, true);
		
		$this->form->text('name');
		$this->form->file('photo', ['required']);
		$this->form->text('job_title', null, []);
		$this->form->selectbox('gender', ['Perempuan', 'Laki-laki'], false, ['required']);
		$this->form->textarea('content', null, ['required', 'class' => 'form-control ckeditor']);
		$this->form->selectbox('active', active_box(), false, ['required']);
		$this->form->open_tab('Social Media');
		$this->form->text('facebook');
		$this->form->text('twitter');
		$this->form->text('website');
		$this->form->text('whatsapp');
		$this->form->open_tab('Contact');
		$this->form->text('phone');
		$this->form->textarea('address', null, ['class' => 'form-control ckeditor']);
		$this->form->close_tab();
		
		$this->form->close('Submit');
		
		return $this->render();
	}
	
	public function store(Request $request, Teams $model_object) {
		$data		= $this->data_file_processor($this->name, $request, 'photo', $this->set_image_validation(50));
		$model		= insert($model_object, $data, true);
		$route_back	= str_replace('.', '/', $this->route_group);
		
		return redirect("{$route_back}/{$model}/edit");
	}
	
	public function edit($id) {
		$this->set_page('Add ' . camel_case($this->name), $this->name);
		$model_data = Teams::find($id);
		
		$this->table_config();
		
		$this->form->model($model_data, "{$this->set_route('update')}", $model_data->id, true);
		
		$this->form->text('name', $model_data->name);
		$this->form->file('photo', ['imagepreview']);
		$this->render_input_js_imagepreview($model_data->photo);
		$this->form->text('job_title', null, [], 'Pekerjaan');
		$this->form->selectbox('gender', ['Perempuan', 'Laki-laki'], $model_data->gender, ['required']);
		$this->form->textarea('content', $model_data->content, ['required', 'class' => 'form-control ckeditor']);
		$this->form->selectbox('active', active_box(), $model_data->active, ['required']);
		$this->form->open_tab('Social Media');
		$this->form->text('facebook', $model_data->facebook);
		$this->form->text('twitter', $model_data->twitter);
		$this->form->text('website', $model_data->website);
		$this->form->text('whatsapp', $model_data->whatsapp);
		$this->form->open_tab('Contact');
		$this->form->text('phone', $model_data->phone);
		$this->form->textarea('address', $model_data->address, ['class' => 'form-control', 'id' => 'ckeditor']);
		$this->form->close_tab();
		
		$this->form->close('Submit');
		
		return $this->render();
	}
	
	public function update(Request $request, $id, Teams $model_object) {
		$filename	= 'photo';
		$req		= $request->all();
		
		if (isset($req[$filename])) {
			$data	= $this->data_file_processor($this->name, $request, $filename, $this->set_image_validation(50));
		} else {
			// throw file request
			$data	= array_merge_recursive ($request->except($filename));
		}
		
		return update($model_object::find($id), $data, true);
	}
	
	public function destroy(Request $request, $id, Teams $model) {
		return delete($request, $id, $model, $this->route_group);
	}
}