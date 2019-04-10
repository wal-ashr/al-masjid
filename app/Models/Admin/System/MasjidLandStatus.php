<?php
namespace App\Models\Admin\System;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Created on Sep 13, 2018
 * Time Created	: 10:45:44 AM
 * Filename		: MasjidLandStatus.php
 *
 * @filesource	MasjidLandStatus.php
 *
 * @author		wisnuwidi@gmail.com - 2018
 * @copyright	wisnuwidi
 * @email		wisnuwidi@gmail.com
 */

class MasjidLandStatus extends Model {
	use SoftDeletes;
	
	protected $table;
	protected $guarded	= [];
	protected $dates	= ['deleted_at'];
	
	public function __construct() {
		parent::__construct();
		
		$this->table = get_config('settings.platform_table') . '_land_status';
	}
}