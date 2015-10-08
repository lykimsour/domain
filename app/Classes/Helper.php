<?php namespace App\Classes;

use Carbon\Carbon;
use Request;
use Session;
use Hash;
use Crypt;

class Helper {

	public static function activeMenu($route) 
	{
		if( Request::path() == $route ) {
			$active = "class = active";
		}
		else {
			$active = '';
		}
		return $active;
	}

	public static function humanDate($date) 
	{
		if(!empty($date))
		{
			$date = new Carbon($date);

			if ($date->diffInDays() > 30) 
			{
			    $timestamp = $date->toFormattedDateString();
			} 
			else 
			{
			    $timestamp = $date->diffForHumans();
			}
		} else {
			$timestamp = '';
		}
		return $timestamp;
	}

	public static function to_int($str) 
	{
		return intval($str);
	}

	public static function KHR_datetime($utc_date) 
	{
		$date = Carbon::createFromFormat('Y-m-d H:i:s', $utc_date);
		$date->setTimezone('Asia/Phnom_Penh');
		return $date->format('Y-m-d H:i:s');
	}

	public static function currentlang()
	{
		$lang = session('locale');
		switch ($lang) {
		    case 'kh':
		        $img = 'cambodia';
		        break;
		    case 'mm':
		        $img = 'myanmar';
		        break;
		    case 'cn':
		        $img = 'china';
		        break;
		    case 'vn':
		        $img = 'vietnam';
		        break;
		    default:
		        $img = 'england';
		} 
		return '<img src="'.url().'/images/icons/'.$img.'.png"/>';
	}

	public static function langStylesheet()
	{
		$lang = session('locale');
		switch ($lang) {
		    case 'kh':
		        $stylesheet = 'cambodia';
		        break;
		    case 'mm':
		        $stylesheet = 'myanmar';
		        break;
		    case 'cn':
		        $stylesheet = 'china';
		        break;
		    case 'vn':
		        $stylesheet = 'vietnam';
		        break;
		    default:
		        $stylesheet = 'england';
		} 
		return '<link media="all" type="text/css" rel="stylesheet" href="'.url().'/css/lang/'.$stylesheet.'.css">';
	}
	
} // End Helper