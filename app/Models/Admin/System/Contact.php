<?php
namespace App\Models\Admin\System;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Created on Sep 15, 2018
 * Time Created	: 12:39:51 AM
 * Filename		: Contact.php
 *
 * @filesource	Contact.php
 *
 * @author		wisnuwidi@gmail.com - 2018
 * @copyright	wisnuwidi
 * @email		wisnuwidi@gmail.com
 */
 
class Contact extends Model {
	use SoftDeletes;
	
	protected $table	= 'base_contact';
	protected $guarded	= [];
	protected $dates	= ['deleted_at'];
}