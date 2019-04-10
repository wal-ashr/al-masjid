<?php
namespace App\Http\Controllers\Admin\Modules;

use Illuminate\Http\Request;

use Expresscode\Controllers\Core\Controller;
use App\Models\Admin\Modules\PrayTimes;
use App\Models\Admin\Modules\ImamSholat;

use Illuminate\Support\Facades\Session;
/**
 * Created on May 14, 2018
 * Time Created	: 10:55:52 AM
 * Filename		: PrayTimesController.php
 *
 * @filesource	PrayTimesController.php
 *
 * @author		wisnuwidi@gmail.com - 2018
 * @copyright	wisnuwidi
 * @email		wisnuwidi@gmail.com
 */
 
class PrayTimesController extends Controller {
	
	private $model			= [];
	private $name			= 'jadwal_sholat';
	private $route_group	= 'modules.sholat.jadwal_sholat';
	private $table			= 'mod_sholat_jadwal';
	
	private $_hide_fields	= ['id'];
	private $_set_tab		= [];
	private $_tab_config	= [];
	private $flag			= [];
	
	public function __construct() {
		parent::__construct();
		
		$this->model = PrayTimes::all();
	}
	
	private function set_route($path) {
		return "{$this->route_group}.{$path}";
	}
	
	private function table_config() {
		$this->form->table_hide_fields($this->table, $this->_hide_fields);
	}
	
	/**
	 * Show Un-Registered Imam
	 * 
	 * @param int $id
	 * @return array
	 * 
	 * created @Aug 20, 2018
	 * author: wisnuwidi
	 */
	private function unRegisteredImam($id = false) {
		$imamIds = [];
		foreach ($this->model as $models) {
			$model = $models->getAttributes();
			if (false !== $id) {
				if (intval($id) !== intval($model['imam_id'])) {
					$imamIds[] = intval($model['imam_id']);
				}
			} else {
				$imamIds[] = intval($model['imam_id']);
			}
		}
		
		return ImamSholat::select()->whereNotIn('id', $imamIds)->get();
	}
	
	private function input_default_imam($id = false) {
		return set_combobox_data($this->unRegisteredImam($id), 'id', 'fullname');
	}
	
	private function input_imam() {
		return set_combobox_data(ImamSholat::all(), 'id', 'fullname');
	}
	
	private function masjid_tag_info($en = false) {
		if (true === $en) {
			$message = "<p>You can add another imam masjid below after select default imam sholat above.</p><i><b>Note:</b> Remember, that you can not leave ( all ) these fields empty. Make sure to choose at least one of these field(s) to set another imam sholat!</i>";
		} else {
			$message = "<p>Anda dapat menambahkan daftar imam masjid lainnya pada form dibawah ini setelah anda mengisi/memilih default imam sholat pada form inputan diatas.</p><i><b>Note:</b> Perlu diingat, bahwa anda tidak dapat membiarkan kosong keseluruhan inputan pada form dibawah ini. Setidaknya anda harus memilih satu diantara kelima waktu inputan pada form dibawah ini untuk menambahkan daftar nama imam sholat lainnya!</i>";
		}
		$this->form->addTag (
			'div',
			['class' => 'callout callout-info callout-alt'],
			$message
		);
	}
	
	/**
	 * Javascript Input Action
	 *
	 * @param boolean $edit_page
	 *
	 * created @Aug 20, 2018
	 * author: wisnuwidi
	 */
	private function action_js($edit_page = false) {
		$first_load_manipulate = false;
		if (false === $edit_page) {
			$first_load_manipulate = "$('#input_method').val(0).trigger(\"chosen:updated\");$('#imam_id').val(0).trigger(\"chosen:updated\");";
		}
		
		$this->theme->set_js("
			$(document).ready(function() {
				{$first_load_manipulate}
				if ($('.daterange-picker').val() == 'Invalid date | Invalid date') { $('.daterange-picker').val(null); }
				
				$('#input_method').on('change', function() {
					$('.{$this->name}').removeAttr('class').addClass('{$this->name}');
					$('#imam_id').val(0).trigger(\"chosen:updated\");
					
					if (1 == this.value) {
						{$this->combobox_chosen('imam_subuh', true)}
						{$this->combobox_chosen('imam_dzuhur', true)}
						{$this->combobox_chosen('imam_ashar', true)}
						{$this->combobox_chosen('imam_maghrib', true)}
						{$this->combobox_chosen('imam_isya', true)}
						
						$('.{$this->name}-single').removeAttr('class').addClass('{$this->name}-single');
						$('.{$this->name}-multiple').removeAttr('class').addClass('{$this->name}-multiple hide');
					} else if (2 == this.value) {
						{$this->combobox_chosen('imam_subuh', false)}
						{$this->combobox_chosen('imam_dzuhur', false)}
						{$this->combobox_chosen('imam_ashar', false)}
						{$this->combobox_chosen('imam_maghrib', false)}
						{$this->combobox_chosen('imam_isya', false)}
						
						$('.{$this->name}-single').removeAttr('class').addClass('{$this->name}-single');
						$('.{$this->name}-multiple').removeAttr('class').addClass('{$this->name}-multiple');
						
						$('#imam_id').on('change', function() {
							{$this->combobox_chosen('imam_subuh', true)}
							{$this->combobox_chosen('imam_dzuhur', true)}
							{$this->combobox_chosen('imam_ashar', true)}
							{$this->combobox_chosen('imam_maghrib', true)}
							{$this->combobox_chosen('imam_isya', true)}
						});
					} else {
						$('.{$this->name}').addClass('{$this->name} hide');
					}
				});
			});
		", 'bottom', false);
	}
	
	/**
	 * Draw Single | Multiple Imam Sholat Used for combobox
	 *
	 * @return array['', 'Single Imam', 'Multiple Imam']
	 *
	 * created @Aug 20, 2018
	 * author: wisnuwidi
	 */
	private $method_collections = ['', 'Single Imam', 'Multiple Imam'];
	
	/**
	 * Check Input Process Before Action
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\Request
	 *
	 * created @Aug 20, 2018
	 * author: wisnuwidi
	 */
	private function check_input_processor(Request $request) {
		$base_required = 'imam_id';
		$this->validations[$base_required] = 'required|not_in:0';
		$request->validate($this->validations);
		
		$dataRequests	= $request->all();
		$inputMethod	= intval($dataRequests['input_method']);
		$inputMasjid	= intval($dataRequests[$this->platform_key]);
		$imamDefault	= intval($dataRequests['imam_id']);
		$new_req			= [];
		$unique			= [];
		$base_value		= 0;
		
		$periods = [];
		if (!empty($request['periods'])) {
			$periodical = explode(' | ', $request['periods']);
			
			$periods['open_period']		= $periodical[0];
			$periods['closed_period']	= $periodical[1];
		}
		$request->request->remove('periods');
		
		if (2 === intval($inputMethod)) {
			foreach ($dataRequests as $field_name => $field_value) {
				if ('_token' !== $field_name && 'input_method' !== $field_name && 'general_flag' !== $field_name && $this->platform_key !== $field_name && 'imam_id' !== $field_name && '_method' !== $field_name) {
					if (0 === intval($field_value)) {
						$fieldValue = intval($imamDefault);
					} else {
						$fieldValue = intval($field_value);
					}
					
					$unique[$field_name] = $fieldValue;
				}
			}
			
			if (count(array_unique($unique)) <= 1) {
				$this->validations['imam_subuh']		= "required|not_in:{$imamDefault}|not_in:0";
				$this->validations['imam_dzuhur']	= "required|not_in:{$imamDefault}|not_in:0";
				$this->validations['imam_ashar']		= "required|not_in:{$imamDefault}|not_in:0";
				$this->validations['imam_maghrib']	= "required|not_in:{$imamDefault}|not_in:0";
				$this->validations['imam_isya']		= "required|not_in:{$imamDefault}|not_in:0";
				
				$request->validate($this->validations);
			}
			
			foreach ($dataRequests as $field_name => $field_value) {
				if ('_token' !== $field_name && 'input_method' !== $field_name && 'general_flag' !== $field_name && $this->platform_key !== $field_name && 'imam_id' !== $field_name && $base_required !== $field_name && '_method' !== $field_name) {
					if (0 === intval($field_value)) {
						$fieldValue = intval($imamDefault);
					} else {
						$fieldValue = intval($field_value);
					}
					
					$new_req[$field_name] = $fieldValue;
				} else {
					$new_req[$field_name] = $field_value;
				}
			}
			
		} else {
			$new_req['input_method'] = $inputMethod;
			foreach ($dataRequests as $field_name => $field_value) {
				if ('_token' !== $field_name && 'input_method' !== $field_name && 'general_flag' !== $field_name && $this->platform_key !== $field_name && 'imam_id' !== $field_name && $base_required !== $field_name && '_method' !== $field_name) {
					$new_req[$field_name] = $imamDefault;
				}
			}
		}
		unset($new_req['periods']);
		
		return $request->merge(array_merge_recursive($new_req, $periods));
	}
	
	private function get_data_imam($general = false) {
		if (true === $general) {
			return PrayTimes::where($this->platform_key, $this->platforms_flag_id)->where('general_flag', 1)->get();
		} else {
			return PrayTimes::where($this->platform_key, $this->platforms_flag_id)->where('general_flag', 0)->get();
		}
	}
	
	public function index() {
		$this->set_page("{$this->name} Lists", $this->name);
		$this->isFlag();
		$this->platforms_collections();
		
		if (count($this->unRegisteredImam()) < 1) {
			$this->hide_button_actions();
		}
		
		$this->model_query(PrayTimes::class, false);
		$this->form->set_relational_list_value('imam_id', 'fullname', 'mod_sholat_imam', 'id', 'Nama Imam ( Umum )');
		$this->form->lists($this->table, ['imam_id'], $this->model_data->where(['general_flag' => 1]), true, true, true, ['label' => 'Jadwal Default Keseharian', 'unlists_text' => true], 'table1');
		
		$this->model_query(PrayTimes::class, false);
		$this->form->set_relational_list_value('imam_subuh', 'fullname', 'mod_sholat_imam', 'id', 'Subuh');
		$this->form->set_relational_list_value('imam_dzuhur', 'fullname', 'mod_sholat_imam', 'id', 'Dzuhur');
		$this->form->set_relational_list_value('imam_ashar', 'fullname', 'mod_sholat_imam', 'id', 'Ashar');
		$this->form->set_relational_list_value('imam_maghrib', 'fullname', 'mod_sholat_imam', 'id', 'Maghrib');
		$this->form->set_relational_list_value('imam_isya', 'fullname', 'mod_sholat_imam', 'id', 'Isya\'');
		$this->form->lists($this->table, ['imam_subuh', 'imam_dzuhur', 'imam_ashar', 'imam_maghrib', 'imam_isya', 'event_name', 'open_period', 'closed_period'], $this->model_data->where(['general_flag' => 0]), true, true, true, ['label' => 'Jadwal Imam Sholat'], 'table2');
		
		return $this->render();
	}
	
	public function show($id) {
		$this->set_page("Add {$this->name}", $this->name);
		$this->isFlag();
		$this->platforms_collections();
		$model_data = PrayTimes::find($id);
		
		$this->table_config();
		$input_method = intval($model_data->input_method);
		$hideBox = false;
		if ($input_method >= 2) {
			$hideBox = false;
		} else {
			$hideBox = ' hide';
		}
		$this->form->model($this->model, false, $model_data->id);
		$this->form->selectbox('input_method', $this->method_collections, $input_method);
		
		$this->form->addOpenTag('div', ['class' => "{$this->name}"]);
		$this->form->setHiddenFields([$this->platform_key]);
		
		$this->form->addOpenTag('div', ['class' => "{$this->name}-single"]);
		$this->form->selectbox($this->platform_key, $this->platforms_collections, $this->platforms_flag_id, ['required', 'class' => 'read-only'], 'Masjid Name');
		$this->form->selectbox('imam_id', $this->input_imam(), $model_data->imam_id, ['required'], 'Imam Sholat ( Default )');
		$this->form->text('event_name', $model_data->event_name, [], 'Event Name');
		$this->form->addCloseTag('div');
		
		$this->form->addOpenTag('div', ['class' => "{$this->name}-multiple{$hideBox}"]);
		$this->masjid_tag_info();
		$this->form->open_tab('Subuh');
		$this->form->selectbox('imam_subuh', $this->input_imam(), $model_data->imam_subuh);
		$this->form->open_tab('Dzuhur');
		$this->form->selectbox('imam_dzuhur', $this->input_imam(), $model_data->imam_dzuhur);
		$this->form->open_tab('Ashar');
		$this->form->selectbox('imam_ashar', $this->input_imam(), $model_data->imam_ashar);
		$this->form->open_tab('Maghrib');
		$this->form->selectbox('imam_maghrib', $this->input_imam(), $model_data->imam_maghrib);
		$this->form->open_tab('Isya\'');
		$this->form->selectbox('imam_isya', $this->input_imam(), $model_data->imam_isya);
		$this->form->close_tab();
		$this->form->addCloseTag('div');
		
		$this->form->addCloseTag('div');
		
		$this->form->close('Submit', ['class' => 'btn btn-primary btn-slideright pull-right']);
		$this->action_js();
		
		return $this->render();
	}
	
	protected function destroy_session_flag() {
		Session::forget('related_module');
	}
	
	/**
	 * Check and create related module used for redirect back if data match
	 * 
	 * created @Dec 14, 2018
	 * author: wisnuwidi
	 * 
	 * @param Request $request
	 */
	private function check_related_module(Request $request) {
		$platform_key = intval($this->session[$this->platform_key]);
		if (!empty($this->session['flag']['info']['id'])) {
			$platform_key = intval($this->session['flag']['info']['id']);
		}
		$data_required['related_module'] = [
			'token'					=> $this->session['_token'],
			'user_id'				=> $this->session['id'],
			'user_group_id'		=> $this->session['id'],
			$this->platform_key	=> $platform_key,
			'url_back'				=> url($this->current_route->uri)
		];
		
		$redirect_back	= encrypt("back&url={$data_required['related_module']['url_back']}&t={$this->session['_token']}");
		$next_url		= url("modules/sholat/imam_sholat/create?redirect={$redirect_back}");
		$data_required['related_module']['next_url'] = $next_url;
		foreach ($data_required as $key => $prepare) {
			$request->session()->put($key, $prepare);
		}
		
		$this->form->addTag (
			'div', ['class' => 'callout callout-info callout-alt'],
			"<p>Masjid anda belum mempunyai data imam sholat.</p><i><b>Note:</b> Klik [ <b><u><a href=\"{$next_url}\">link</u></a></b> ] ini untuk mengisi Form Imam Sholat.</i>"
		);
	}
	
	public function create() {
		$this->set_page("Add {$this->name}", $this->name);
		$this->isFlag();
		$this->platforms_collections();
		$this->destroy_session_flag();
		
		$check_general = $this->get_data_imam(true);
		if (count($check_general) <= 0) {
			$imamSholat = false;
			if (!empty($this->session['flag']['info']['id'])) {
				$imamSholat = count(ImamSholat::where($this->platform_key, '=', intval($this->session['flag']['info']['id']))->get());
			}
			
			if (empty($imamSholat)) {
				$this->set_page("Add {$this->name}", $this->name);
			//	Session::forget('related_module');
				$this->check_related_module(_request());
				
				return $this->render();
			} else {
				return $this->set_general_form();
			}
		}
		
		$this->table_config();
		if (count($this->unRegisteredImam()) <= 0) {
			$this->form->setHiddenFields(['input_method']);
			$this->form->addTag (
				'div', ['class' => 'callout callout-info callout-alt'],
				"<p>Silahkan kembali ke menu awal</p><i><b>Note:</b> Tidak ada data imam masjid selain Imam Default</i>"
			);
		}
		
		$this->form->model($this->model, "{$this->route_group}.store");
		
		$this->form->selectbox('input_method', ['', 'Single Imam', 'Multiple Imam'], false, [], 'Metode Inputan');
		$this->form->addOpenTag('div', ['class' => "{$this->name} hide"]);
		$this->form->setHiddenFields([$this->platform_key]);
				
		$this->form->addOpenTag('div', ['class' => "{$this->name}-single hide"]);
		$this->form->selectbox($this->platform_key, $this->platforms_collections, $this->platforms_flag_id, ['required', 'class' => 'read-only'], 'Masjid Name');
		$this->form->selectbox('imam_id', $this->input_default_imam(), false, ['required'], 'Imam Sholat ( Default )');
		$this->form->text('event_name', null, [], 'Nama Event');
		$this->form->daterange('periods', null, [], 'Tanggal');
		
		$this->form->addCloseTag('div');
		
		$this->form->addOpenTag('div', ['class' => "{$this->name}-multiple hide"]);
		$this->masjid_tag_info();
		$this->form->open_tab('Subuh');
		$this->form->selectbox('imam_subuh', $this->input_imam());
		$this->form->open_tab('Dzuhur');
		$this->form->selectbox('imam_dzuhur', $this->input_imam());
		$this->form->open_tab('Ashar');
		$this->form->selectbox('imam_ashar', $this->input_imam());
		$this->form->open_tab('Maghrib');
		$this->form->selectbox('imam_maghrib', $this->input_imam());
		$this->form->open_tab('Isya\'');
		$this->form->selectbox('imam_isya', $this->input_imam());
		$this->form->close_tab();
		$this->form->addCloseTag('div');
		
		$this->form->addCloseTag('div');
		
		if (count($this->unRegisteredImam()) >= 1) {
			$this->form->close('Submit', ['class' => 'btn btn-primary btn-slideright pull-right']);
		}
		
		$this->theme->set_js("$('.daterange-picker').val(null);", 'bottom', false);
		$this->action_js();
		
		return $this->render();
	}
	
	private function set_general_form() {		
		$this->set_page("Add {$this->name}", $this->name);
		$this->isFlag();
		$this->platforms_collections();
		$this->form->addTag (
			'div', ['class' => 'callout callout-info callout-alt'],
			"<p>Masjid anda belum mempunyai default imam sholat.</p><i><b>Note:</b> Form ini akan membantu anda membuat (default) imam sholat.</i>"
		);
		$this->form->model($this->model, "{$this->route_group}.store");
		$this->form->setHiddenFields(['input_method', 'general_flag', $this->platform_key, 'imam_subuh', 'imam_dzuhur', 'imam_ashar', 'imam_maghrib', 'imam_isya']);
		
		$this->form->selectbox('input_method', ['', 'Single Imam', 'Multiple Imam'], 1, [], 'Metode Inputan');
		$this->form->selectbox($this->platform_key, $this->platforms_collections, $this->platforms_flag_id, ['required', 'class' => 'read-only'], 'Masjid Name');
		$this->form->selectbox('general_flag', active_box(), 1, [], 'General Status');
		
		$this->form->selectbox('imam_id', $this->input_default_imam(), false, ['required'], 'Imam Sholat ( Default )');
		
		$this->form->selectbox('imam_subuh', $this->input_imam());
		$this->form->selectbox('imam_dzuhur', $this->input_imam());
		$this->form->selectbox('imam_ashar', $this->input_imam());
		$this->form->selectbox('imam_maghrib', $this->input_imam());
		$this->form->selectbox('imam_isya', $this->input_imam());
		
		$this->form->close('Submit', ['class' => 'btn btn-primary btn-slideright pull-right']);
		
		return $this->render();
	}
	
	public function store(Request $request) {
		$req		= $this->check_input_processor($request);
		$model		= insert(new PrayTimes, $req, true);
		$route_back	= str_replace('.', '/', $this->route_group);
		
		return redirect("{$route_back}/{$model}/edit");
	}
	
	public function edit($id) {
		$this->set_page("Add {$this->name}", $this->name);
		$this->isFlag();
		$this->platforms_collections();
		$model_data = PrayTimes::find($id);
		
		if (count($this->unRegisteredImam()) < 1) {
			$this->hide_button_actions();
		}
		
		foreach ($this->get_data_imam(true) as $general_imam) {
			$check_general_id = intval($general_imam['id']);
		}
		
		if (intval($model_data->id) === $check_general_id) {
			$this->form->setHiddenFields(['input_method']);
		}
		
		$this->table_config();
		$input_method = intval($model_data->input_method);
		$hideBox = false;
		if ($input_method >= 2) {
			$hideBox = false;
		} else {
			$hideBox = ' hide';
		}
		$this->form->model($this->model, "{$this->set_route('update')}", $model_data->id);
		$this->form->selectbox('input_method', $this->method_collections, $input_method);
		
		$this->form->addOpenTag('div', ['class' => "{$this->name}"]);
		$this->form->setHiddenFields([$this->platform_key]);
		
		$this->form->addOpenTag('div', ['class' => "{$this->name}-single"]);
		$this->form->selectbox($this->platform_key, $this->platforms_collections, $this->platforms_flag_id, ['required', 'class' => 'read-only'], 'Masjid Name');
		$this->form->selectbox('imam_id', $this->input_imam($model_data->imam_id), $model_data->imam_id, ['required'], 'Imam Sholat ( Default )');
		
		if (intval($model_data->id) === $check_general_id) {
			$this->form->setHiddenFields(['event_name', 'periods']);
		}
		$this->form->text('event_name', $model_data->event_name, [], 'Event Name');
		$daterage_value = "{$model_data->open_period} | {$model_data->closed_period}";
		$this->form->daterange('periods', $daterage_value, [], 'Tanggal');
		
		$this->form->addCloseTag('div');
		
		$this->form->addOpenTag('div', ['class' => "{$this->name}-multiple{$hideBox}"]);
		$this->masjid_tag_info();
		$this->form->open_tab('Subuh');
		$this->form->selectbox('imam_subuh', $this->input_imam($model_data->imam_subuh), $model_data->imam_subuh);
		$this->form->open_tab('Dzuhur');
		$this->form->selectbox('imam_dzuhur', $this->input_imam($model_data->imam_dzuhur), $model_data->imam_dzuhur);
		$this->form->open_tab('Ashar');
		$this->form->selectbox('imam_ashar', $this->input_imam($model_data->imam_ashar), $model_data->imam_ashar);
		$this->form->open_tab('Maghrib');
		$this->form->selectbox('imam_maghrib', $this->input_imam($model_data->imam_maghrib), $model_data->imam_maghrib);
		$this->form->open_tab('Isya\'');
		$this->form->selectbox('imam_isya', $this->input_imam($model_data->imam_isya), $model_data->imam_isya);
		$this->form->close_tab();
		$this->form->addCloseTag('div');
		
		$this->form->addCloseTag('div');
		
		$this->form->close('Submit', ['class' => 'btn btn-primary btn-slideright pull-right']);
		$this->action_js(true);
		
		return $this->render();
	}
	
	public function update(Request $request, $id) {
		$req = $this->check_input_processor($request);
		return update(PrayTimes::find($id), $req, true);
	}
	
	public function destroy(Request $request, $id, PrayTimes $model) {
		return delete($request, $id, $model, $this->route_group);
	}
}