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
	Route::get('auth/logout', ['as'=>'logout','uses'=>'Auth\AuthController@getLogout']);
	//Route::post('auth/register', 'Auth\AuthController@postRegister');
	//Route::get('auth/register', ['uses' => 'Auth\AuthController@getRegister','as' => 'register']);
	Route::get('lang/{dil}', array('as' => 'languageChoose', 'uses' => 'AppController@languageChoose'));
	Route::group(['middleware' => 'auth'], function () {

		Route::get('/', ['uses'=>'DashboardController@index','as' => 'dashboard.index']);

	});


	Route::group(['middleware' => ['auth','acl']], function () {
	Route::get('/users/',['uses'=>'UserController@index','as'=>'users','permission' => 'manage_user']);
	Route::get('/users/newuser',['uses'=>'UserController@create','as'=>'newusers','permission' => 'manage_user']);
	Route::post('/users/storeuser',['uses'=>'UserController@store','as'=>'storeusers','permission' => 'manage_user']);
	Route::get('/users/blockuser/{id}',['uses'=>'UserController@block','as'=>'blockusers','permission' => 'manage_user']);
	Route::get('/users/unblockuser/{id}',['uses'=>'UserController@unblock','as'=>'unblockusers','permission' => 'manage_user']);

	//cashier Managerment
	Route::get('/cashier', ['uses'=>'CashierController@showCashier','as' => 'showcashier','permission' => 'view_cashier']);
	Route::get('/cashier/newcashier', ['uses'=>'CashierController@getCashier','as' => 'getcashier','permission' => 'insert_cashier']);
	Route::post('/cashier/newcashier', ['uses'=>'CashierController@postCashier','as' => 'postcashier','permission' => 'insert_cashier']);
	Route::get('/cashier/edit/{id}',['uses'=>'CashierController@geteditCashier','as'=>'editcashier','permission'=>'update_cashier']);
	Route::put('/cashier/edit/',['uses'=>'CashierController@puteditCashier','as'=>'puteditcashier','permission'=>'update_cashier']);
	Route::delete('/cashier/delete/{id}',['uses'=>'CashierController@destroy','as'=>'destroycashier','permission'=>'delete_cashier']);
	//Service
	Route::get('/service',['uses'=>'ServiceController@index','as'=>'service','permission'=>'view_service']);
	Route::get('/service/create',['uses'=>'ServiceController@create','as'=>'createservice','permission'=>'insert_service']);
	Route::post('/service/store',['uses'=>'ServiceController@store','as'=>'storeservice','permission'=>'insert_service']);
	Route::get('/service/edit/{id}',['uses'=>'ServiceController@edit','as'=>'editservice','permission'=>'update_service']);	
	Route::put('/service/edit/',['uses'=>'ServiceController@update','as'=>'updateservice','permission'=>'update_service']);	
	Route::delete('/service/delete/{id}',['uses'=>'ServiceController@destroy','as'=>'deleteservice','permission'=>'delete_service']);	
		
	//service type
	Route::get('/servicetype',['uses'=>'ServiceTypeController@index','as'=>'servicetype','permission'=>'view_service']);
	Route::get('/servicetype/create',['uses'=>'ServiceTypeController@create','as'=>'createservicetype','permission'=>'insert_service']);
	Route::post('/servicetype/store',['uses'=>'ServiceTypeController@store','as'=>'storeservicetype','permission'=>'insert_service']);
	Route::get('/servicetype/edit/{id}',['uses'=>'ServiceTypeController@edit','as'=>'editservicetype','permission'=>'update_service']);
	Route::put('/servicetype/edit',['uses'=>'ServiceTypeController@update','as'=>'updateservicetype','permission'=>'update_service']);
	Route::delete('/servicetype/delete/{id}',['uses'=>'ServiceTypeController@destroy','as'=>'deleteservicetype','permission'=>'delete_service']);

	//serviceclass
	Route::get('/serviceclass',['uses'=>'ServiceClassController@index','as'=>'serviceclass','permission'=>'view_service']);
	Route::get('/serviceclass/create',['uses'=>'ServiceClassController@create','as'=>'createserviceclass','permission'=>'insert_service']);
	Route::post('/serviceclass/store',['uses'=>'ServiceClassController@store','as'=>'storeserviceclass','permission'=>'insert_service']);
	Route::get('/serviceclass/edit/{id}',['uses'=>'ServiceClassController@edit','as'=>'editserviceclass','permission'=>'update_service']);
	Route::put('/serviceclass/edit',['uses'=>'ServiceClassController@update','as'=>'updateserviceclass','permission'=>'update_service']);
	Route::delete('/serviceclass/delete/{id}',['uses'=>'ServiceClassController@destroy','as'=>'deleteserviceclass','permission'=>'delete_service']);

	//online_shops
	Route::get('/onlineshop',['uses'=>'OnlineShopController@index','as'=>'onlineshop','permission'=>'view_onlineshop']);
	Route::get('/onlineshop/create',['uses'=>'OnlineShopController@create','as'=>'createonlineshop','permission'=>'insert_onlineshop']);
	Route::post('/onlineshop/store',['uses'=>'OnlineShopController@store','as'=>'storeonlineshop','permission'=>'insert_onlineshop']);
	Route::get('/onlineshop/edit/{id}',['uses'=>'OnlineShopController@edit','as'=>'editonlineshop','permission'=>'update_onlineshop']);
	Route::put('/onlineshop/edit',['uses'=>'OnlineShopController@update','as'=>'updateonlineshop','permission'=>'update_onlineshop']);
	Route::delete('/onlineshop/delete/{id}',['uses'=>'OnlineShopController@destroy','as'=>'deleteonlineshop','permission'=>'delete_onlineshop']);

	//online_shop_item
	Route::get('/onlineshopitem',['uses'=>'OnlineShopItemController@index','as'=>'onlineshopitem','permission'=>'view_onlineshop']);
	Route::get('/onlineshopitem/create',['uses'=>'OnlineShopItemController@create','as'=>'createonlineshopitem','permission'=>'insert_onlineshop']);
	Route::post('/onlineshopitem/store',['uses'=>'OnlineShopItemController@store','as'=>'storeonlineshopitem','permission'=>'insert_onlineshop']);
	Route::get('/onlineshopitem/edit/{id}',['uses'=>'OnlineShopItemController@edit','as'=>'editonlineshopitem','permission'=>'update_onlineshop']);
	Route::put('/onlineshopitem/edit/{id}',['uses'=>'OnlineShopItemController@update','as'=>'updateonlineshopitem','permission'=>'update_onlineshop']);
	Route::delete('/onlineshopitem/delete/{id}',['uses'=>'OnlineShopItemController@destroy','as'=>'deleteonlineshopitem','permission'=>'delete_onlineshop']);
	
	//Roles
	Route::get('/role',['uses'=>'RoleController@index','as'=>'role','permission'=>'manage_user']);
	Route::get('/role/create',['uses'=>'RoleController@create','as'=>'createrole','permission'=>'manage_user']);
	Route::post('/role/store',['uses'=>'RoleController@store','as'=>'storerole','permission'=>'manage_user']);
	Route::get('/role/edit/{id}',['uses'=>'RoleController@edit','as'=>'editrole','permission'=>'manage_user']);
	Route::put('/role/edit/{id}',['uses'=>'RoleController@update','as'=>'updaterole','permission'=>'manage_user']);
	Route::delete('/role/delete/{id}',['uses'=>'RoleController@destroy','as'=>'deleterole','permission'=>'manage_user']);

	//Permission
	Route::get('/permission',['uses'=>'PermissionController@index','as'=>'permission','permission'=>'manage_user']);
	Route::get('/permission/create',['uses'=>'PermissionController@create','as'=>'createpermission','permission'=>'manage_user']);
	Route::post('/permission/store',['uses'=>'PermissionController@store','as'=>'storepermission','permission'=>'manage_user']);


	//Permission_role
	Route::get('/permissionrole',['uses'=>'PermissionRoleController@index','as'=>'permissionrole','permission'=>'manage_user']);
	Route::get('/permissionrole/create',['uses'=>'PermissionRoleController@create','as'=>'createpermissionrole','permission'=>'manage_user']);
	Route::post('/permissionrole/store',['uses'=>'PermissionRoleController@store','as'=>'storepermissionrole','permission'=>'manage_user']);

	});

	