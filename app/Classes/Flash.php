<?php namespace App\Classes;

use Session;

class Flash {

	public static function success($msg)
	{
	  	Session::flash('class', "alert-success"); 
	  	Session::flash('message', $msg); 
	}
	
	public static function warning($msg)
	{
	  	Session::flash('class', "alert-warning"); 
	  	Session::flash('message', $msg); 
	}
	
	public static function error($msg)
	{
	  	Session::flash('class', "alert-danger"); 
	  	Session::flash('message', $msg); 
	}

	public static function info($msg)
	{
	  	Session::flash('class', "alert-info"); 
	  	Session::flash('message', $msg); 
	}

	public static function getMessage()
	{
	  	if(Session::has('message'))
	  	{
	  		echo '
	  			<div class="alert '.Session::get('class').' alert-dismissible fade in" role="alert">
					<button class="close" aria-label="Close" data-dismiss="alert" type="button">
						<span aria-hidden="true">×</span>
					</button>
					'.Session::get('message').'
				</div>
	  		';
	  	}
	}

}