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
	//Route::post('auth/register', 'Auth\AuthController@postRegister');
	//Route::get('auth/register', ['uses' => 'Auth\AuthController@getRegister','as' => 'register']);
	Route::get('lang/{dil}', array('as' => 'languageChoose', 'uses' => 'AppController@languageChoose'));

	Route::group(['middleware' => ['auth','acl']], function () {
	Route::get('/', ['uses'=>'DashboardController@index','as' => 'dashboard.index','permission' => 'view']);
	Route::get('/users/',['uses'=>'UserController@createUser','as'=>'users','permission' => 'view']);
	//cashier Managerment
	Route::get('/cashier', ['uses'=>'CashierController@showCashier','as' => 'showcashier','permission' => 'view']);
	Route::get('/cashier/newcashier', ['uses'=>'CashierController@getCashier','as' => 'getcashier','permission' => 'insert']);
	Route::post('/cashier/newcashier', ['uses'=>'CashierController@postCashier','as' => 'postcashier','permission' => 'insert']);
	Route::get('/cashier/edit/{id}',['uses'=>'CashierController@geteditCashier','as'=>'editcashier','permission'=>'update']);
	Route::put('/cashier/edit/',['uses'=>'CashierController@puteditCashier','as'=>'puteditcashier','permission'=>'update']);
	Route::delete('/cashier/delete/{id}',['uses'=>'CashierController@destroy','as'=>'destroycashier','permission'=>'delete']);
	//Service
	Route::get('/service',['uses'=>'ServiceController@index','as'=>'service','permission'=>'view']);
	Route::get('/service/create',['uses'=>'ServiceController@create','as'=>'createservice','permission'=>'insert']);
	Route::post('/service/store',['uses'=>'ServiceController@store','as'=>'storeservice','permission'=>'insert']);
	Route::get('/service/edit/{id}',['uses'=>'ServiceController@edit','as'=>'editservice','permission'=>'update']);	
	Route::put('/service/edit/',['uses'=>'ServiceController@update','as'=>'updateservice','permission'=>'update']);	
	Route::delete('/service/delete/{id}',['uses'=>'ServiceController@destroy','as'=>'deleteservice','permission'=>'delete']);	
		
	//service type
	Route::get('/servicetype',['uses'=>'ServiceTypeController@index','as'=>'servicetype','permission'=>'view']);
	Route::get('/servicetype/create',['uses'=>'ServiceTypeController@create','as'=>'createservicetype','permission'=>'insert']);
	Route::post('/servicetype/store',['uses'=>'ServiceTypeController@store','as'=>'storeservicetype','permission'=>'insert']);
	Route::get('/servicetype/edit/{id}',['uses'=>'ServiceTypeController@edit','as'=>'editservicetype','permission'=>'update']);
	Route::put('/servicetype/edit',['uses'=>'ServiceTypeController@update','as'=>'updateservicetype','permission'=>'update']);
	Route::delete('/servicetype/delete/{id}',['uses'=>'ServiceTypeController@destroy','as'=>'deleteservicetype','permission'=>'delete']);

	//serviceclass
	Route::get('/serviceclass',['uses'=>'ServiceClassController@index','as'=>'serviceclass','permission'=>'view']);
	Route::get('/serviceclass/create',['uses'=>'ServiceClassController@create','as'=>'createserviceclass','permission'=>'insert']);
	Route::post('/serviceclass/store',['uses'=>'ServiceClassController@store','as'=>'storeserviceclass','permission'=>'insert']);
	Route::get('/serviceclass/edit/{id}',['uses'=>'ServiceClassController@edit','as'=>'editserviceclass','permission'=>'update']);
	Route::put('/serviceclass/edit',['uses'=>'ServiceClassController@update','as'=>'updateserviceclass','permission'=>'update']);
	Route::delete('/serviceclass/delete/{id}',['uses'=>'ServiceClassController@destroy','as'=>'deleteserviceclass','permission'=>'delete']);

	//online_shops
	Route::get('/onlineshop',['uses'=>'OnlineShopController@index','as'=>'onlineshop','permission'=>'view']);
	Route::get('/onlineshop/create',['uses'=>'OnlineShopController@create','as'=>'createonlineshop','permission'=>'insert']);
	Route::post('/onlineshop/store',['uses'=>'OnlineShopController@store','as'=>'storeonlineshop','permission'=>'insert']);
	Route::get('/onlineshop/edit/{id}',['uses'=>'OnlineShopController@edit','as'=>'editonlineshop','permission'=>'update']);
	Route::put('/onlineshop/edit',['uses'=>'OnlineShopController@update','as'=>'updateonlineshop','permission'=>'update']);
	Route::delete('/onlineshop/delete/{id}',['uses'=>'OnlineShopController@destroy','as'=>'deleteonlineshop','permission'=>'delete']);

	//online_shop_item
	Route::get('/onlineshopitem',['uses'=>'OnlineShopItemController@index','as'=>'onlineshopitem','permission'=>'view']);
	Route::get('/onlineshopitem/create',['uses'=>'OnlineShopItemController@create','as'=>'createonlineshopitem','permission'=>'insert']);
	Route::post('/onlineshopitem/store',['uses'=>'OnlineShopItemController@store','as'=>'storeonlineshopitem','permission'=>'insert']);
	Route::get('/onlineshopitem/edit/{id}',['uses'=>'OnlineShopItemController@edit','as'=>'editonlineshopitem','permission'=>'update']);
	Route::put('/onlineshopitem/edit/{id}',['uses'=>'OnlineShopItemController@update','as'=>'updateonlineshopitem','permission'=>'update']);
	Route::delete('/onlineshopitem/delete/{id}',['uses'=>'OnlineShopItemController@destroy','as'=>'deleteonlineshopitem','permission'=>'delete']);
	
	//Roles
	Route::get('/role',['uses'=>'RoleController@index','as'=>'role','permission'=>'view']);
	Route::get('/role/create',['uses'=>'RoleController@create','as'=>'createrole','permission'=>'insert']);
	Route::post('/role/store',['uses'=>'RoleController@store','as'=>'storerole','permission'=>'insert']);
	Route::get('/role/edit/{id}',['uses'=>'RoleController@edit','as'=>'editrole','permission'=>'update']);
	Route::put('/role/edit/{id}',['uses'=>'RoleController@update','as'=>'updaterole','permission'=>'update']);
	Route::delete('/role/delete/{id}',['uses'=>'RoleController@destroy','as'=>'deleterole','permission'=>'delete']);

	//Permission
	Route::get('/permission',['uses'=>'PermissionController@index','as'=>'permission','permission'=>'view']);
	Route::get('/permission/create',['uses'=>'PermissionController@create','as'=>'createpermission','permission'=>'insert']);
	Route::post('/permission/store',['uses'=>'PermissionController@store','as'=>'storepermission','permission'=>'insert']);


	//Permission_role
	Route::get('/permissionrole',['uses'=>'PermissionRoleController@index','as'=>'permissionrole','permission'=>'manage_user']);
	Route::get('/permissionrole/create',['uses'=>'PermissionRoleController@create','as'=>'createpermissionrole','permission'=>'manage_user']);
	Route::post('/permissionrole/store',['uses'=>'PermissionRoleController@store','as'=>'storepermissionrole','permission'=>'manage_user']);

	});

	