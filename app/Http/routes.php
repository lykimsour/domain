<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

	Route::get('home', function () {
    	return redirect('/');
	});
	
	Route::get('auth/login', 'Auth\AuthController@getLogin');
	Route::post('auth/login', 'Auth\AuthController@postLogin');
	Route::get('auth/logout', 'Auth\AuthController@getLogout');
	Route::post('auth/register', 'Auth\AuthController@postRegister');
	Route::get('auth/register', 'Auth\AuthController@getRegister');
	Route::get('lang/{dil}', array('as' => 'languageChoose', 'uses' => 'AppController@languageChoose'));

	Route::group(['middleware' => ['auth','acl']], function () {
	Route::get('/', ['uses'=>'DashboardController@index','as' => 'dashboard.index','permission' => 'viewer_user']);
	Route::get('/createuser/',['uses'=>'UserController@createUser','as'=>'createuser','permission' => 'super_user']);
	//cashier Managerment
	Route::get('/cashier', ['uses'=>'CashierController@showCashier','as' => 'showcashier','permission' => 'super_user']);
	Route::get('/cashier/newcashier', ['uses'=>'CashierController@getCashier','as' => 'getcashier','permission' => 'super_user']);
	Route::post('/cashier/newcashier', ['uses'=>'CashierController@postCashier','as' => 'postcashier','permission' => 'super_user']);
	Route::get('/cashier/edit/{id}',['uses'=>'CashierController@geteditCashier','as'=>'editcashier','permission'=>'super_user']);
	Route::put('/cashier/edit/',['uses'=>'CashierController@puteditCashier','as'=>'puteditcashier','permission'=>'super_user']);
	Route::delete('/cashier/delete/{id}',['uses'=>'CashierController@destroy','as'=>'destroycashier','permission'=>'super_user']);
	//Service
	Route::get('/service',['uses'=>'ServiceController@index','as'=>'service','permission'=>'super_user']);
	Route::get('/service/create',['uses'=>'ServiceController@create','as'=>'createservice','permission'=>'super_user']);
	Route::post('/service/store',['uses'=>'ServiceController@store','as'=>'storeservice','permission'=>'super_user']);
	Route::get('/service/edit/{id}',['uses'=>'ServiceController@edit','as'=>'editservice','permission'=>'super_user']);	
	Route::put('/service/edit/',['uses'=>'ServiceController@update','as'=>'updateservice','permission'=>'super_user']);	
	Route::delete('/service/delete/{id}',['uses'=>'ServiceController@destroy','as'=>'deleteservice','permission'=>'super_user']);	
		
	//service type
	Route::get('/servicetype',['uses'=>'ServiceTypeController@index','as'=>'servicetype','permission'=>'super_user']);
	Route::get('/servicetype/create',['uses'=>'ServiceTypeController@create','as'=>'createservicetype','permission'=>'super_user']);
	Route::post('/servicetype/store',['uses'=>'ServiceTypeController@store','as'=>'storeservicetype','permission'=>'super_user']);
	Route::get('/servicetype/edit/{id}',['uses'=>'ServiceTypeController@edit','as'=>'editservicetype','permission'=>'super_user']);
	Route::put('/servicetype/edit',['uses'=>'ServiceTypeController@update','as'=>'updateservicetype','permission'=>'super_user']);
	Route::delete('/servicetype/delete/{id}',['uses'=>'ServiceTypeController@destroy','as'=>'deleteservicetype','permission'=>'super_user']);

	//serviceclass
	Route::get('/serviceclass',['uses'=>'ServiceClassController@index','as'=>'serviceclass','permission'=>'super_user']);
	Route::get('/serviceclass/create',['uses'=>'ServiceClassController@create','as'=>'createserviceclass','permission'=>'super_user']);
	Route::post('/serviceclass/store',['uses'=>'ServiceClassController@store','as'=>'storeserviceclass','permission'=>'super_user']);
	Route::get('/serviceclass/edit/{id}',['uses'=>'ServiceClassController@edit','as'=>'editserviceclass','permission'=>'super_user']);
	Route::put('/serviceclass/edit',['uses'=>'ServiceClassController@update','as'=>'updateserviceclass','permission'=>'super_user']);
	Route::delete('/serviceclass/delete/{id}',['uses'=>'ServiceClassController@destroy','as'=>'deleteserviceclass','permission'=>'super_user']);

	//online_shops
	Route::get('/onlineshop',['uses'=>'OnlineShopController@index','as'=>'onlineshop','permission'=>'super_user']);
	Route::get('/onlineshop/create',['uses'=>'OnlineShopController@create','as'=>'createonlineshop','permission'=>'super_user']);
	Route::post('/onlineshop/store',['uses'=>'OnlineShopController@store','as'=>'storeonlineshop','permission'=>'super_user']);
	Route::get('/onlineshop/edit/{id}',['uses'=>'OnlineShopController@edit','as'=>'editonlineshop','permission'=>'super_user']);
	Route::put('/onlineshop/edit',['uses'=>'OnlineShopController@update','as'=>'updateonlineshop','permission'=>'super_user']);
	Route::delete('/onlineshop/delete/{id}',['uses'=>'OnlineShopController@destroy','as'=>'deleteonlineshop','permission'=>'super_user']);

	//online_shop_item
	Route::get('/onlineshopitem',['uses'=>'OnlineShopItemController@index','as'=>'onlineshopitem','permission'=>'super_user']);
	Route::get('/onlineshopitem/create',['uses'=>'OnlineShopItemController@create','as'=>'createonlineshopitem','permission'=>'super_user']);
	Route::post('/onlineshopitem/store',['uses'=>'OnlineShopItemController@store','as'=>'storeonlineshopitem','permission'=>'super_user']);

	});

	