<?php
namespace App\Http\Controllers\Admin\Modules;

use Illuminate\Http\Request;

use Expresscode\Controllers\Core\Controller;
use Expresscode\Models\Admin\Modules\Articles;
use Expresscode\Models\Admin\System\ArticlesType;
use Expresscode\Models\Admin\System\ArticlesApproval;

/**
 * Created on Mar 2, 2018
 * Time Created	: 1:04:21 PM
 * Filename		: TestingController.php
 *
 * @filesource	TestingController.php
 *
 * @author		wisnuwidi@gmail.com - 2018
 * @copyright	wisnuwidi
 * @email		wisnuwidi@gmail.com
 */
class TestingController extends Controller {
	
	private $model			= [];
	private $name			= 'articles';
	private $route_group	= 'modules.article';
	private $table			= 'mod_articles';
	
	private $_hide_fields	= ['id'];
	private $_set_tab		= [];
	private $_tab_config	= [];
	private $flag			= [];
	
	public function __construct() {
		parent::__construct();
		
		$this->model = Articles::withTrashed();
		$this->model_query($this->model, false);
	}
	
	private function set_route($path) {
		return "{$this->route_group}.{$path}";
	}
	
	private function table_config() {
		$this->form->table_hide_fields($this->table, $this->_hide_fields);
	}
	
	private function input_article_type($user_group = false) {
		return set_combobox_data(ArticlesType::all(), 'id', 'title');
	}
	
	public function index() {
		$this->set_page($this->name . ' Lists', $this->name);
		
		$this->setIndex();
		
		$this->testing_table();
		
		return $this->render();
	}
	
	private function testing_table() {
		$this->form->draw($this->test_table());
		$this->form->draw($this->test_table1());
		/* 
		$this->theme->set_css('https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css', 'top');
		$this->theme->set_css('https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css', 'top');
		
		//	$this->theme->set_js('https://code.jquery.com/jquery-3.3.1.js', 'bottom');
		$this->theme->set_js('https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js', 'top');
		$this->theme->set_js('https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js', 'top'); */
		$this->theme->set_js('
$(document).ready(function() {
	jQuery(function($) {
	    $("#example").DataTable({
			"ajax": "http://localhost/test.txt",
			"processing": true,
			"serverSide": false,
			"columns": [
			//	{ "data": "DT_RowIndex","name": "DT_RowIndex",	"class": "center un-clickable", "sortable": false, "searchable": false, "onclick": "return false" },
				{ "data": "name",			"name": "name",			"class": "clickable auto-cut-text" },
				{ "data": "position",	"name": "position",		"class": "clickable auto-cut-text" },
				{ "data": "office",		"name": "office",			"class": "clickable auto-cut-text" },
				{ "data": "extn",			"name": "extn",			"class": "clickable auto-cut-text" },
				{ "data": "start_date",	"name": "start_date",	"class": "center un-clickable", "sortable": false, "searchable": true },
				{ "data": "salary",		"name": "salary",			"class": "center un-clickable", "sortable": false, "searchable": true }
			]
			,order:[[1, "asc"]],columnDefs:[{targets:[1],visible:true,searchable:false,className:"control"}]
		});
		$("#example1").DataTable();
	})
});
		', 'bottom', false);
		
		return $this;
	}
	
	private function test_table() {
		return '
<table id="example" class="expresscode-table table animated fadeIn table-striped table-default table-bordered table-hover dataTable repeater display responsive nowrap" style="width:100%">
	<thead>
		<tr>
			<th>Name</th>
			<th>Position</th>
			<th>Office</th>
			<th>Extn.</th>
			<th>Start date</th>
			<th>Salary</th>
		</tr>
	</thead>
</table>';
	}
	private function test_table1() {
		return '<table id="example1" class="display responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>First name</th>
                <th>Last name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
                <th>Extn.</th>
                <th>E-mail</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger</td>
                <td>Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
                <td>5421</td>
                <td>t.nixon@datatables.net</td>
            </tr>
            <tr>
                <td>Garrett</td>
                <td>Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011/07/25</td>
                <td>$170,750</td>
                <td>8422</td>
                <td>g.winters@datatables.net</td>
            </tr>
            <tr>
                <td>Ashton</td>
                <td>Cox</td>
                <td>Junior Technical Author</td>
                <td>San Francisco</td>
                <td>66</td>
                <td>2009/01/12</td>
                <td>$86,000</td>
                <td>1562</td>
                <td>a.cox@datatables.net</td>
            </tr>
            <tr>
                <td>Cedric</td>
                <td>Kelly</td>
                <td>Senior Javascript Developer</td>
                <td>Edinburgh</td>
                <td>22</td>
                <td>2012/03/29</td>
                <td>$433,060</td>
                <td>6224</td>
                <td>c.kelly@datatables.net</td>
            </tr>
            <tr>
                <td>Airi</td>
                <td>Satou</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>33</td>
                <td>2008/11/28</td>
                <td>$162,700</td>
                <td>5407</td>
                <td>a.satou@datatables.net</td>
            </tr>
            <tr>
                <td>Brielle</td>
                <td>Williamson</td>
                <td>Integration Specialist</td>
                <td>New York</td>
                <td>61</td>
                <td>2012/12/02</td>
                <td>$372,000</td>
                <td>4804</td>
                <td>b.williamson@datatables.net</td>
            </tr>
            <tr>
                <td>Herrod</td>
                <td>Chandler</td>
                <td>Sales Assistant</td>
                <td>San Francisco</td>
                <td>59</td>
                <td>2012/08/06</td>
                <td>$137,500</td>
                <td>9608</td>
                <td>h.chandler@datatables.net</td>
            </tr>
            <tr>
                <td>Rhona</td>
                <td>Davidson</td>
                <td>Integration Specialist</td>
                <td>Tokyo</td>
                <td>55</td>
                <td>2010/10/14</td>
                <td>$327,900</td>
                <td>6200</td>
                <td>r.davidson@datatables.net</td>
            </tr>
            <tr>
                <td>Colleen</td>
                <td>Hurst</td>
                <td>Javascript Developer</td>
                <td>San Francisco</td>
                <td>39</td>
                <td>2009/09/15</td>
                <td>$205,500</td>
                <td>2360</td>
                <td>c.hurst@datatables.net</td>
            </tr>
            <tr>
                <td>Sonya</td>
                <td>Frost</td>
                <td>Software Engineer</td>
                <td>Edinburgh</td>
                <td>23</td>
                <td>2008/12/13</td>
                <td>$103,600</td>
                <td>1667</td>
                <td>s.frost@datatables.net</td>
            </tr>
            <tr>
                <td>Jena</td>
                <td>Gaines</td>
                <td>Office Manager</td>
                <td>London</td>
                <td>30</td>
                <td>2008/12/19</td>
                <td>$90,560</td>
                <td>3814</td>
                <td>j.gaines@datatables.net</td>
            </tr>
            <tr>
                <td>Quinn</td>
                <td>Flynn</td>
                <td>Support Lead</td>
                <td>Edinburgh</td>
                <td>22</td>
                <td>2013/03/03</td>
                <td>$342,000</td>
                <td>9497</td>
                <td>q.flynn@datatables.net</td>
            </tr>
            <tr>
                <td>Charde</td>
                <td>Marshall</td>
                <td>Regional Director</td>
                <td>San Francisco</td>
                <td>36</td>
                <td>2008/10/16</td>
                <td>$470,600</td>
                <td>6741</td>
                <td>c.marshall@datatables.net</td>
            </tr>
            <tr>
                <td>Haley</td>
                <td>Kennedy</td>
                <td>Senior Marketing Designer</td>
                <td>London</td>
                <td>43</td>
                <td>2012/12/18</td>
                <td>$313,500</td>
                <td>3597</td>
                <td>h.kennedy@datatables.net</td>
            </tr>
            <tr>
                <td>Tatyana</td>
                <td>Fitzpatrick</td>
                <td>Regional Director</td>
                <td>London</td>
                <td>19</td>
                <td>2010/03/17</td>
                <td>$385,750</td>
                <td>1965</td>
                <td>t.fitzpatrick@datatables.net</td>
            </tr>
            <tr>
                <td>Michael</td>
                <td>Silva</td>
                <td>Marketing Designer</td>
                <td>London</td>
                <td>66</td>
                <td>2012/11/27</td>
                <td>$198,500</td>
                <td>1581</td>
                <td>m.silva@datatables.net</td>
            </tr>
            <tr>
                <td>Paul</td>
                <td>Byrd</td>
                <td>Chief Financial Officer (CFO)</td>
                <td>New York</td>
                <td>64</td>
                <td>2010/06/09</td>
                <td>$725,000</td>
                <td>3059</td>
                <td>p.byrd@datatables.net</td>
            </tr>
            <tr>
                <td>Gloria</td>
                <td>Little</td>
                <td>Systems Administrator</td>
                <td>New York</td>
                <td>59</td>
                <td>2009/04/10</td>
                <td>$237,500</td>
                <td>1721</td>
                <td>g.little@datatables.net</td>
            </tr>
            <tr>
                <td>Bradley</td>
                <td>Greer</td>
                <td>Software Engineer</td>
                <td>London</td>
                <td>41</td>
                <td>2012/10/13</td>
                <td>$132,000</td>
                <td>2558</td>
                <td>b.greer@datatables.net</td>
            </tr>
            <tr>
                <td>Dai</td>
                <td>Rios</td>
                <td>Personnel Lead</td>
                <td>Edinburgh</td>
                <td>35</td>
                <td>2012/09/26</td>
                <td>$217,500</td>
                <td>2290</td>
                <td>d.rios@datatables.net</td>
            </tr>
            <tr>
                <td>Jenette</td>
                <td>Caldwell</td>
                <td>Development Lead</td>
                <td>New York</td>
                <td>30</td>
                <td>2011/09/03</td>
                <td>$345,000</td>
                <td>1937</td>
                <td>j.caldwell@datatables.net</td>
            </tr>
            <tr>
                <td>Yuri</td>
                <td>Berry</td>
                <td>Chief Marketing Officer (CMO)</td>
                <td>New York</td>
                <td>40</td>
                <td>2009/06/25</td>
                <td>$675,000</td>
                <td>6154</td>
                <td>y.berry@datatables.net</td>
            </tr>
            <tr>
                <td>Caesar</td>
                <td>Vance</td>
                <td>Pre-Sales Support</td>
                <td>New York</td>
                <td>21</td>
                <td>2011/12/12</td>
                <td>$106,450</td>
                <td>8330</td>
                <td>c.vance@datatables.net</td>
            </tr>
            <tr>
                <td>Doris</td>
                <td>Wilder</td>
                <td>Sales Assistant</td>
                <td>Sidney</td>
                <td>23</td>
                <td>2010/09/20</td>
                <td>$85,600</td>
                <td>3023</td>
                <td>d.wilder@datatables.net</td>
            </tr>
            <tr>
                <td>Angelica</td>
                <td>Ramos</td>
                <td>Chief Executive Officer (CEO)</td>
                <td>London</td>
                <td>47</td>
                <td>2009/10/09</td>
                <td>$1,200,000</td>
                <td>5797</td>
                <td>a.ramos@datatables.net</td>
            </tr>
            <tr>
                <td>Gavin</td>
                <td>Joyce</td>
                <td>Developer</td>
                <td>Edinburgh</td>
                <td>42</td>
                <td>2010/12/22</td>
                <td>$92,575</td>
                <td>8822</td>
                <td>g.joyce@datatables.net</td>
            </tr>
            <tr>
                <td>Jennifer</td>
                <td>Chang</td>
                <td>Regional Director</td>
                <td>Singapore</td>
                <td>28</td>
                <td>2010/11/14</td>
                <td>$357,650</td>
                <td>9239</td>
                <td>j.chang@datatables.net</td>
            </tr>
            <tr>
                <td>Brenden</td>
                <td>Wagner</td>
                <td>Software Engineer</td>
                <td>San Francisco</td>
                <td>28</td>
                <td>2011/06/07</td>
                <td>$206,850</td>
                <td>1314</td>
                <td>b.wagner@datatables.net</td>
            </tr>
            <tr>
                <td>Fiona</td>
                <td>Green</td>
                <td>Chief Operating Officer (COO)</td>
                <td>San Francisco</td>
                <td>48</td>
                <td>2010/03/11</td>
                <td>$850,000</td>
                <td>2947</td>
                <td>f.green@datatables.net</td>
            </tr>
            <tr>
                <td>Shou</td>
                <td>Itou</td>
                <td>Regional Marketing</td>
                <td>Tokyo</td>
                <td>20</td>
                <td>2011/08/14</td>
                <td>$163,000</td>
                <td>8899</td>
                <td>s.itou@datatables.net</td>
            </tr>
            <tr>
                <td>Michelle</td>
                <td>House</td>
                <td>Integration Specialist</td>
                <td>Sidney</td>
                <td>37</td>
                <td>2011/06/02</td>
                <td>$95,400</td>
                <td>2769</td>
                <td>m.house@datatables.net</td>
            </tr>
            <tr>
                <td>Suki</td>
                <td>Burks</td>
                <td>Developer</td>
                <td>London</td>
                <td>53</td>
                <td>2009/10/22</td>
                <td>$114,500</td>
                <td>6832</td>
                <td>s.burks@datatables.net</td>
            </tr>
            <tr>
                <td>Prescott</td>
                <td>Bartlett</td>
                <td>Technical Author</td>
                <td>London</td>
                <td>27</td>
                <td>2011/05/07</td>
                <td>$145,000</td>
                <td>3606</td>
                <td>p.bartlett@datatables.net</td>
            </tr>
            <tr>
                <td>Gavin</td>
                <td>Cortez</td>
                <td>Team Leader</td>
                <td>San Francisco</td>
                <td>22</td>
                <td>2008/10/26</td>
                <td>$235,500</td>
                <td>2860</td>
                <td>g.cortez@datatables.net</td>
            </tr>
            <tr>
                <td>Martena</td>
                <td>Mccray</td>
                <td>Post-Sales support</td>
                <td>Edinburgh</td>
                <td>46</td>
                <td>2011/03/09</td>
                <td>$324,050</td>
                <td>8240</td>
                <td>m.mccray@datatables.net</td>
            </tr>
            <tr>
                <td>Unity</td>
                <td>Butler</td>
                <td>Marketing Designer</td>
                <td>San Francisco</td>
                <td>47</td>
                <td>2009/12/09</td>
                <td>$85,675</td>
                <td>5384</td>
                <td>u.butler@datatables.net</td>
            </tr>
            <tr>
                <td>Howard</td>
                <td>Hatfield</td>
                <td>Office Manager</td>
                <td>San Francisco</td>
                <td>51</td>
                <td>2008/12/16</td>
                <td>$164,500</td>
                <td>7031</td>
                <td>h.hatfield@datatables.net</td>
            </tr>
            <tr>
                <td>Hope</td>
                <td>Fuentes</td>
                <td>Secretary</td>
                <td>San Francisco</td>
                <td>41</td>
                <td>2010/02/12</td>
                <td>$109,850</td>
                <td>6318</td>
                <td>h.fuentes@datatables.net</td>
            </tr>
            <tr>
                <td>Vivian</td>
                <td>Harrell</td>
                <td>Financial Controller</td>
                <td>San Francisco</td>
                <td>62</td>
                <td>2009/02/14</td>
                <td>$452,500</td>
                <td>9422</td>
                <td>v.harrell@datatables.net</td>
            </tr>
            <tr>
                <td>Timothy</td>
                <td>Mooney</td>
                <td>Office Manager</td>
                <td>London</td>
                <td>37</td>
                <td>2008/12/11</td>
                <td>$136,200</td>
                <td>7580</td>
                <td>t.mooney@datatables.net</td>
            </tr>
            <tr>
                <td>Jackson</td>
                <td>Bradshaw</td>
                <td>Director</td>
                <td>New York</td>
                <td>65</td>
                <td>2008/09/26</td>
                <td>$645,750</td>
                <td>1042</td>
                <td>j.bradshaw@datatables.net</td>
            </tr>
            <tr>
                <td>Olivia</td>
                <td>Liang</td>
                <td>Support Engineer</td>
                <td>Singapore</td>
                <td>64</td>
                <td>2011/02/03</td>
                <td>$234,500</td>
                <td>2120</td>
                <td>o.liang@datatables.net</td>
            </tr>
            <tr>
                <td>Bruno</td>
                <td>Nash</td>
                <td>Software Engineer</td>
                <td>London</td>
                <td>38</td>
                <td>2011/05/03</td>
                <td>$163,500</td>
                <td>6222</td>
                <td>b.nash@datatables.net</td>
            </tr>
            <tr>
                <td>Sakura</td>
                <td>Yamamoto</td>
                <td>Support Engineer</td>
                <td>Tokyo</td>
                <td>37</td>
                <td>2009/08/19</td>
                <td>$139,575</td>
                <td>9383</td>
                <td>s.yamamoto@datatables.net</td>
            </tr>
            <tr>
                <td>Thor</td>
                <td>Walton</td>
                <td>Developer</td>
                <td>New York</td>
                <td>61</td>
                <td>2013/08/11</td>
                <td>$98,540</td>
                <td>8327</td>
                <td>t.walton@datatables.net</td>
            </tr>
            <tr>
                <td>Finn</td>
                <td>Camacho</td>
                <td>Support Engineer</td>
                <td>San Francisco</td>
                <td>47</td>
                <td>2009/07/07</td>
                <td>$87,500</td>
                <td>2927</td>
                <td>f.camacho@datatables.net</td>
            </tr>
            <tr>
                <td>Serge</td>
                <td>Baldwin</td>
                <td>Data Coordinator</td>
                <td>Singapore</td>
                <td>64</td>
                <td>2012/04/09</td>
                <td>$138,575</td>
                <td>8352</td>
                <td>s.baldwin@datatables.net</td>
            </tr>
            <tr>
                <td>Zenaida</td>
                <td>Frank</td>
                <td>Software Engineer</td>
                <td>New York</td>
                <td>63</td>
                <td>2010/01/04</td>
                <td>$125,250</td>
                <td>7439</td>
                <td>z.frank@datatables.net</td>
            </tr>
            <tr>
                <td>Zorita</td>
                <td>Serrano</td>
                <td>Software Engineer</td>
                <td>San Francisco</td>
                <td>56</td>
                <td>2012/06/01</td>
                <td>$115,000</td>
                <td>4389</td>
                <td>z.serrano@datatables.net</td>
            </tr>
            <tr>
                <td>Jennifer</td>
                <td>Acosta</td>
                <td>Junior Javascript Developer</td>
                <td>Edinburgh</td>
                <td>43</td>
                <td>2013/02/01</td>
                <td>$75,650</td>
                <td>3431</td>
                <td>j.acosta@datatables.net</td>
            </tr>
            <tr>
                <td>Cara</td>
                <td>Stevens</td>
                <td>Sales Assistant</td>
                <td>New York</td>
                <td>46</td>
                <td>2011/12/06</td>
                <td>$145,600</td>
                <td>3990</td>
                <td>c.stevens@datatables.net</td>
            </tr>
            <tr>
                <td>Hermione</td>
                <td>Butler</td>
                <td>Regional Director</td>
                <td>London</td>
                <td>47</td>
                <td>2011/03/21</td>
                <td>$356,250</td>
                <td>1016</td>
                <td>h.butler@datatables.net</td>
            </tr>
            <tr>
                <td>Lael</td>
                <td>Greer</td>
                <td>Systems Administrator</td>
                <td>London</td>
                <td>21</td>
                <td>2009/02/27</td>
                <td>$103,500</td>
                <td>6733</td>
                <td>l.greer@datatables.net</td>
            </tr>
            <tr>
                <td>Jonas</td>
                <td>Alexander</td>
                <td>Developer</td>
                <td>San Francisco</td>
                <td>30</td>
                <td>2010/07/14</td>
                <td>$86,500</td>
                <td>8196</td>
                <td>j.alexander@datatables.net</td>
            </tr>
            <tr>
                <td>Shad</td>
                <td>Decker</td>
                <td>Regional Director</td>
                <td>Edinburgh</td>
                <td>51</td>
                <td>2008/11/13</td>
                <td>$183,000</td>
                <td>6373</td>
                <td>s.decker@datatables.net</td>
            </tr>
            <tr>
                <td>Michael</td>
                <td>Bruce</td>
                <td>Javascript Developer</td>
                <td>Singapore</td>
                <td>29</td>
                <td>2011/06/27</td>
                <td>$183,000</td>
                <td>5384</td>
                <td>m.bruce@datatables.net</td>
            </tr>
            <tr>
                <td>Donna</td>
                <td>Snider</td>
                <td>Customer Support</td>
                <td>New York</td>
                <td>27</td>
                <td>2011/01/25</td>
                <td>$112,000</td>
                <td>4226</td>
                <td>d.snider@datatables.net</td>
            </tr>
        </tbody>
    </table>';
	}
	
	private function setIndex() {
		$this->check_platforms_sessions($this->model);
		
		$this->table_config();
		if (true === is_multiplatform()) {
			$this->form->set_relational_list_value($this->platform_key, 'name', $this->platform_table, 'id', $this->platform_label);
		}
		$this->form->set_image_list_tag(['images' => [30, 50]]);
		$this->form->lists($this->table, ['title', 'author', 'images', 'active'], $this->model_data, true, true);
		
		return $this;
	}
	public function create() {
		$this->set_page('Add ' . camel_case($this->name), $this->name);
		$this->isFlag();
		$this->platforms_collections();
		
		$this->table_config();
		if (true === is_multiplatform()) {
			$this->form->setHiddenFields([$this->platform_key]);
		}
		$this->form->model($this->model, "{$this->route_group}.store", false, true);
		
		if (true === is_multiplatform()) {
			$this->form->selectbox($this->platform_key, $this->platforms_collections, $this->platforms_flag_id, ['required', 'class' => 'read-only'], 'Masjid Name');
		}
		
		$this->form->text('title', null, ['required']);
		$this->form->file('images');
		$this->form->text('video');
		$this->form->file('file');
		$this->form->textarea('content', null, ['required', 'class' => 'form-control ckeditor']);
		$this->form->tags('tags');
		$this->form->text('author', $this->session['fullname'], ['required']);
		$this->form->text('author_alias', $this->session['name']);
		$this->form->selectbox('sticky', active_box(), false, ['required']);
		$this->form->selectbox('share_button', active_box(), false, ['required']);
		$this->form->selectbox('enable_comment', active_box(), false, ['required']);
		
		$this->form->selectbox('article_type', $this->input_article_type(), false, ['required']);
		$this->form->selectbox('relational_flag', relational_flag(), false, ['required'], 'National Request');
		$this->form->selectbox('active', active_box(), false, ['required']);
		
		$this->form->close('Submit', ['class' => 'btn btn-primary btn-slideright pull-right']);
		$this->js_showhide_combobox('relational_flag', 'active');
		
		return $this->render();
	}
	
	public function store(Request $request, Articles $model_object) {
		if (0 == $request->all()['article_type']) {
			$request->merge(['article_type' => NULL]);
		}
		
		$files	= ['images' => $this->set_image_validation(50), 'file' => false];
		$data		= $this->data_file_processor($this->name, $request, $files);
		$model	= insert($model_object, $data, true);
		$this->approval_relate_process(__FUNCTION__, $request->all(), ArticlesApproval::class, $model, $this->table, 'base_articles');
		$route_back	= str_replace('.', '/', $this->route_group);
		
		return redirect("{$route_back}/{$model}/edit");
	}
	
	public function edit($id) {
		$this->set_page('Edit ' . camel_case($this->name), $this->name);
		$this->platforms_collections();
		$model_data = Articles::find($id);
		
		if (!empty($this->session['related_link'])) {
			session_forget('related_link');
		}
		
		$this->table_config();
		
		$this->form->model($model_data, "{$this->set_route('update')}", $model_data->id, true);
		if (true === is_multiplatform()) {
			$this->form->setHiddenFields([$this->platform_key]);
			$this->form->selectbox($this->platform_key, $this->platforms_collections, $this->platforms_flag_id, ['required', 'class' => 'read-only'], 'Masjid Name');
		}
		
		$this->form->text('title', $model_data->title, ['required']);
		$this->form->file('images', ['imagepreview']);
		$this->render_input_js_imagepreview($model_data->images);
		$this->form->text('video', $model_data->video);
		$this->form->file('file');
		$this->form->textarea('content', $model_data->content, ['required', 'class' => 'form-control ckeditor']);
		$this->form->tags('tags', $model_data->tags);
		$this->form->text('author', $this->session['fullname'], ['required']);
		$this->form->text('author_alias', $this->session['name']);
		$this->form->selectbox('sticky', active_box(), $model_data->sticky, ['required']);
		$this->form->selectbox('share_button', active_box(), $model_data->share_button, ['required']);
		$this->form->selectbox('enable_comment', active_box(), $model_data->enable_comment, ['required']);
		
		$this->form->selectbox('article_type', $this->input_article_type(), $model_data->article_type, ['required']);
		$this->form->selectbox('relational_flag', relational_flag(), $model_data->relational_flag, ['required'], 'National Request');
		$this->form->selectbox('active', active_box(), $model_data->active, ['required']);
		
		$this->form->close('Submit');
		$flag = false;
		if (intval($model_data->relational_flag) >= 1) {
			$flag = true;
		}
		$this->js_showhide_combobox('relational_flag', 'active', $flag);
		
		return $this->render();
	}
	
	public function update(Request $request, $id, Articles $model_object) {
		if (0 == $request->all()['article_type']) {
			$request->merge(['article_type' => NULL]);
		}
		
		$filename	 = 'images';
		$req		 = $request->all();
		if (isset($req[$filename])) {
			$files	= [$filename => $this->set_image_validation(50), 'file' => false];
			$data	= $this->data_file_processor($this->name, $request, $files);
		} else {
			// throw file request
			$data	= array_merge_recursive ($request->except($filename));
		}
		
		$model_object = $model_object::find($id);
		$this->approval_relate_process(__FUNCTION__, $data, ArticlesApproval::class, $model_object->id, $this->table, 'base_articles');
		
		return update($model_object, $data, true);
	}
	
	public function destroy(Request $request, $id, Articles $model) {
		return delete($request, $id, $model, $this->route_group);
	}
}