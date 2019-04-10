<?php
namespace App\Models\Admin\Modules;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Created on May 25, 2018
 * Time Created	: 10:49:41 AM
 * Filename		: ImamSholat.php
 *
 * @filesource	ImamSholat.php
 *
 * @author		wisnuwidi@gmail.com - 2018
 * @copyright	wisnuwidi
 * @email		wisnuwidi@gmail.com
 */
 
class ImamSholat extends Model {
	use SoftDeletes;
	
	protected $table	= 'mod_sholat_imam';
	protected $guarded	= [];
	protected $dates	= ['deleted_at'];
}