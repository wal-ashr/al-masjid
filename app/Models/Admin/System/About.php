<?php
namespace App\Models\Admin\System;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Created on Sep 15, 2018
 * Time Created	: 12:39:21 AM
 * Filename		: About.php
 *
 * @filesource	About.php
 *
 * @author		wisnuwidi@gmail.com - 2018
 * @copyright	wisnuwidi
 * @email		wisnuwidi@gmail.com
 */
 
class About extends Model {
	use SoftDeletes;
	
	protected $table	= 'base_about';
	protected $guarded	= [];
	protected $dates	= ['deleted_at'];
}