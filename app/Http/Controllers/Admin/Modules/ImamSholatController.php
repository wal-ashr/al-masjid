<?php
namespace App\Http\Controllers\Admin\Modules;

use Illuminate\Http\Request;

use Expresscode\Controllers\Core\Controller;
use App\Models\Admin\Modules\ImamSholat;

/**
 * Created on May 14, 2018
 * Time Created	: 10:55:35 AM
 * Filename		: ImamSholatController.php
 *
 * @filesource	ImamSholatController.php
 *
 * @author		wisnuwidi@gmail.com - 2018
 * @copyright	wisnuwidi
 * @email		wisnuwidi@gmail.com
 */
 
class ImamSholatController extends Controller {
	
	private $model			= [];
	private $name			= 'imam_sholat';
	private $route_group	= 'modules.sholat.imam_sholat';
	private $table			= 'mod_sholat_imam';
	
	private $_hide_fields	= ['id'];
	private $_set_tab		= [];
	private $_tab_config	= [];
	private $flag			= [];
	
	public function __construct() {
		parent::__construct();
		
		$this->model = ImamSholat::withTrashed()->get();
	}
	
	private function set_route($path) {
		return "{$this->route_group}.{$path}";
	}
	
	private function table_config() {
		$this->form->table_hide_fields($this->table, $this->_hide_fields);
	}
	
	public function index() {
		$this->set_page(camel_case($this->name) . ' Lists', $this->name);
		$this->isFlag();
		
		$this->table_config();
		if (true === is_multiplatform()) {
			$this->form->set_relational_list_value($this->platform_key, 'name', $this->platform_table, 'id', 'Masjid');
		}
		$this->form->set_image_list_tag(['photo' => [30, 50]]);
		$this->form->lists($this->table, ['fullname', 'nickname', 'photo', 'active'], $this->model, true);
		
		return $this->render();
	}
	
	private function check_count_imam($masjid_id) {
		return count(ImamSholat::where($this->platform_key, $masjid_id)->get());
	}
	
	public function show($id) {
		$this->set_page('User Detail ' . camel_case($this->name), $this->name);
		$this->isFlag();
		$this->platforms_collections();
		$model_data = ImamSholat::withTrashed()->find($id);
		
		$this->table_config();
		
		$this->form->model($model_data, false, $model_data->id, true);
		
		if (true === is_multiplatform()) {
			$this->form->setHiddenFields([$this->platform_key]);
			$this->form->selectbox($this->platform_key, $this->platforms_collections, $this->platforms_flag_id, ['required', 'class' => 'read-only'], 'Masjid Name');
		}
		$this->form->open_tab('Informasi Umum');
		$this->form->text('fullname', null, ['required'], 'Nama Lengkap');
		$this->form->text('nickname', null, [], 'Nama Panggilan');
		
		$this->form->file('photo', ['imagepreview'], 'Foto');
		$this->render_input_js_imagepreview($model_data->photo);
		
		$this->form->selectbox('active', active_box(false), $model_data->active, ['required'], 'Aktif Status');
		
		$this->form->open_tab('Informasi Lain');
		$this->form->text('email', null, [], 'Alamat Email');
		$this->form->text('phone', null, [], 'Nomor Telepon');
		$this->form->date('birth_date', null, [], 'Tanggal Kelahiran');
		$this->form->text('birth_place', null, [], 'Tempat Kelahiran');
		$this->form->close_tab();
		
		$this->form->close();
		
		return $this->render();
	}
	
	/**
	 * Insert Data
	 * 
	 * created @Jun 22, 2018
	 * author: wisnuwidi
	 * 
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function create() {
		$this->set_page('Add ' . camel_case($this->name), $this->name);
		$this->isFlag();
		
		if (!empty($this->session['related_module'])) {
			$related = $this->session['related_module'];
			
			if (!empty($_GET['redirect'])) {
				$redirect_point	= explode('&', decrypt($_GET['redirect']));
				$platform_key = intval($this->session[$this->platform_key]);
				if (!empty($this->session['flag']['info']['id'])) {
					$platform_key = intval($this->session['flag']['info']['id']);
				}
				if (true === in_array('back', $redirect_point)) {
					$get_data = [];
					foreach ($redirect_point as $points) {
						if ('back' !== $points) {
							if (str_contains($points, 'url=')) {
								$get_data['url'] = str_replace('url=', '', $points);
							}
							if (str_contains($points, 't=')) {
								$get_data['t'] = str_replace('t=', '', $points);
							}
						}
					}
					
					if (
						$related['token']				=== $this->session['_token']	&&
						$related['token']				=== $get_data['t']				&&
						$related['url_back']			=== $get_data['url']			&&
						$related['user_id']				=== $this->session['id']		&&
						$related['user_group_id']		=== $this->session['group_id']	&&
						$related[$this->platform_key]	=== $platform_key
					) {
						$_sessions['related_module'] = $related;
						if ($this->check_count_imam(intval($_sessions['related_module']['masjid_id'])) < 1) {
							
						} else {
							$_sessions['related_module']['next_url'] = false;
							foreach ($_sessions as $key => $prepare) {
								_request()->session()->put($key, $prepare);
							};
						}
					} else {
						$this->form->addTag (
							'div', ['class' => 'callout callout-info callout-alt'],
							"<p>Terdapat kesalahan.</p><i><b>Note:</b> Klik [ <a href=\"{$url}\">link</a> ] ini untuk kembali.</i>"
						);
						
						return $this->render();
					}
				}
			}
		}
		
		$this->platforms_collections();
		
		$this->table_config();
		if (true === is_multiplatform()) {
			$this->form->setHiddenFields([$this->platform_key]);
		}
		$this->form->model($this->model, "{$this->route_group}.store", false, true);
		
		if (true === is_multiplatform()) {
			$this->form->selectbox($this->platform_key, $this->platforms_collections, $this->platforms_flag_id, ['required', 'class' => 'read-only'], 'Masjid Name');
		}
		
		$this->form->open_tab('Informasi Umum');
		$this->form->text('fullname', null, ['required'], 'Nama Lengkap');
		$this->form->text('nickname', null, [], 'Nama Panggilan');
		$this->form->file('photo', [], 'Foto');
		$this->form->selectbox('active', active_box(false), false, ['required'], 'Aktif Status');
		
		$this->form->open_tab('Informasi Lain');
		$this->form->text('email', null, [], 'Alamat Email');
		$this->form->text('phone', null, [], 'Nomor Telepon');
		$this->form->date('birth_date', null, [], 'Tanggal Kelahiran');
		$this->form->text('birth_place', null, [], 'Tempat Kelahiran');
		$this->form->close_tab();
		
		$this->form->close('Submit', ['class' => 'btn btn-primary btn-slideright pull-right']);
		
		return $this->render();
	}
	
	/**
	 * Store Function
	 * 
	 * @param Request $request
	 * 
	 * created @Jul 11, 2018
	 * author: wisnuwidi
	 */
	public function store(Request $request) {
		$data		= $this->data_file_processor($this->name, $request, 'photo', 'image|mimes:jpeg,png,jpg,gif,svg|max:2048');
		$model		= insert(new ImamSholat, $data, true);
		
		$this->get_session();
		if (!empty($this->session['related_module'])) {
			if (!empty($this->session['related_module']['next_url'])) {
				return redirect($this->session['related_module']['next_url']);
			} else {
				return redirect($this->session['related_module']['url_back']);
			}
		} else {
			$route_back	= str_replace('.', '/', $this->route_group);
			
			return redirect("{$route_back}/{$model}/edit");
		}
	}
	
	/**
	 * Edit / Update Data
	 * 
	 * @param integer $id
	 * 
	 * created @Jul 16, 2018
	 * author: wisnuwidi
	 */
	public function edit($id) {
		$this->set_page('Edit ' . camel_case($this->name), $this->name);
		$this->isFlag();
		$this->platforms_collections();
		$model_data = ImamSholat::find($id);
		
		$this->table_config();
		
		$this->form->model($model_data, "{$this->set_route('update')}", $model_data->id, true);
		
		if (true === is_multiplatform()) {
			$this->form->setHiddenFields([$this->platform_key]);
			$this->form->selectbox($this->platform_key, $this->platforms_collections, $this->platforms_flag_id, ['required', 'class' => 'read-only'], 'Masjid Name');
		}
		
		$this->form->open_tab('Informasi Umum');
		$this->form->text('fullname', null, ['required'], 'Nama Lengkap');
		$this->form->text('nickname', null, [], 'Nama Panggilan');
		
		$this->form->file('photo', ['imagepreview'], 'Foto');
		$this->render_input_js_imagepreview($model_data->photo);
		
		$this->form->selectbox('active', active_box(false), $model_data->active, ['required'], 'Aktif Status');
		
		$this->form->open_tab('Informasi Lain');
		$this->form->text('email', null, [], 'Alamat Email');
		$this->form->text('phone', null, [], 'Nomor Telepon');
		$this->form->date('birth_date', null, [], 'Tanggal Kelahiran');
		$this->form->text('birth_place', null, [], 'Tempat Kelahiran');
		$this->form->close_tab();
		
		$this->form->close('Submit', ['class' => 'btn btn-primary btn-slideright pull-right']);
		
		return $this->render();
	}
	
	public function update(Request $request, $id) {
		$filename	= 'photo';
		$req		= $request->all();
		
		if (isset($req[$filename])) {
			$data	= $this->data_file_processor($this->name, $request, $filename, 'image|mimes:jpeg,png,jpg,gif,svg|max:2048');
		} else {
			// throw file request
			$data	= array_merge_recursive ($request->except($filename));
		}
		
		return update(ImamSholat::find($id), $data, true);
	}
	
	public function destroy(Request $request, $id, ImamSholat $model) {
		return delete($request, $id, $model, $this->route_group);
	}
}