<?php
namespace App\Models\Admin\System;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Created on Sep 15, 2018
 * Time Created	: 12:40:16 AM
 * Filename		: Faqs.php
 *
 * @filesource	Faqs.php
 *
 * @author		wisnuwidi@gmail.com - 2018
 * @copyright	wisnuwidi
 * @email		wisnuwidi@gmail.com
 */
 
class Faqs extends Model {
	use SoftDeletes;
	
	protected $table	= 'base_faq';
	protected $guarded	= [];
	protected $dates	= ['deleted_at'];
}