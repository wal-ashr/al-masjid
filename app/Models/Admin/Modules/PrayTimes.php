<?php
namespace App\Models\Admin\Modules;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
/**
 * Created on May 25, 2018
 * Time Created	: 11:43:50 PM
 * Filename		: PrayTimes.php
 *
 * @filesource	PrayTimes.php
 *
 * @author		wisnuwidi@gmail.com - 2018
 * @copyright	wisnuwidi
 * @email		wisnuwidi@gmail.com
 */

class PrayTimes extends Model {
	protected $table	= 'mod_sholat_jadwal';
	protected $guarded	= [];
	public $timestamps	= false;
}