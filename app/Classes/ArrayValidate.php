<?php namespace App\Classes;

use Validator;

class ArrayValidate {

	private static function validator($rules, $data)
	{
		if(is_array($data) && count($data) == count($rules))
		{
			$validator = Validator::make($data, $rules);
			return !$validator->fails();
		}
		return false;
	}

	public static function login($data)
	{
		$rules = [
			'_token' 		=> 'required|string',
			'username' 		=> 'required|string|min:4',
			'password' 		=> 'required|string|min:8'
		];
		return self::validator($rules, $data);
	}

}