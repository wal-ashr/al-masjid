<?php
/**
 * Created on Mar 4, 2019
 * Time Created	: 11:32:16 AM
 * Filename			: index.blade.php
 *
 * @filesource	index.blade.php
 *
 * @author		wisnuwidi@gmail.com - 2019
 * @copyright	wisnuwidi
 * @email		wisnuwidi@gmail.com
 */
?>

@extends('templates.default.frontend.master')

@section('content')
	@foreach($content_page as $content)
		{!! $content !!}
	@endforeach
@endsection