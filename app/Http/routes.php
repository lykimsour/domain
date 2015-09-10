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

	//Route::get('/', ['uses'=>'DashboardController@index','as' => 'dashboard.index']);

	Route::group(['middleware' => ['auth','acl']], function () {
	Route::get('/', ['uses'=>'DashboardController@index','as' => 'dashboard.index','permission' => 'viewdashboard']);
	Route::get('/users/',['uses'=>'UserController@index','as'=>'users','permission' => 'manage_user']);
	Route::get('/users/newuser',['uses'=>'UserController@create','as'=>'newusers','permission' => 'manage_user']);
	Route::post('/users/storeuser',['uses'=>'UserController@store','as'=>'storeusers','permission' => 'manage_user']);
	Route::get('/users/blockuser/{id}',['uses'=>'UserController@block','as'=>'blockusers','permission' => 'manage_user']);
	Route::get('/users/unblockuser/{id}',['uses'=>'UserController@unblock','as'=>'unblockusers','permission' => 'manage_user']);

	//cashier Managerment
	Route::get('/cashier', ['uses'=>'CashierController@showCashier','as' => 'showcashier','permission' => 'viewcashier']);
	Route::get('/cashier/newcashier', ['uses'=>'CashierController@getCashier','as' => 'getcashier','permission' => 'insertcashier']);
	Route::post('/cashier/newcashier', ['uses'=>'CashierController@postCashier','as' => 'postcashier','permission' => 'insertcashier']);
	Route::get('/cashier/edit/{id}',['uses'=>'CashierController@geteditCashier','as'=>'editcashier','permission'=>'updatecashier']);
	Route::put('/cashier/edit/',['uses'=>'CashierController@puteditCashier','as'=>'puteditcashier','permission'=>'updatecashier']);
	Route::delete('/cashier/delete/{id}',['uses'=>'CashierController@destroy','as'=>'destroycashier','permission'=>'deletecashier']);
	//Service
	Route::get('/service',['uses'=>'ServiceController@index','as'=>'service','permission'=>'viewservice']);
	Route::get('/service/create',['uses'=>'ServiceController@create','as'=>'createservice','permission'=>'insertservice']);
	Route::post('/service/store',['uses'=>'ServiceController@store','as'=>'storeservice','permission'=>'insertservice']);
	Route::get('/service/edit/{id}',['uses'=>'ServiceController@edit','as'=>'editservice','permission'=>'updateservice']);	
	Route::put('/service/edit/',['uses'=>'ServiceController@update','as'=>'updateservice','permission'=>'updateservice']);	
	Route::delete('/service/delete/{id}',['uses'=>'ServiceController@destroy','as'=>'deleteservice','permission'=>'deleteservice']);	
		
	//service type
	Route::get('/servicetype',['uses'=>'ServiceTypeController@index','as'=>'servicetype','permission'=>'viewservice']);
	Route::get('/servicetype/create',['uses'=>'ServiceTypeController@create','as'=>'createservicetype','permission'=>'insertservice']);
	Route::post('/servicetype/store',['uses'=>'ServiceTypeController@store','as'=>'storeservicetype','permission'=>'insertservice']);
	Route::get('/servicetype/edit/{id}',['uses'=>'ServiceTypeController@edit','as'=>'editservicetype','permission'=>'updateservice']);
	Route::put('/servicetype/edit',['uses'=>'ServiceTypeController@update','as'=>'updateservicetype','permission'=>'updateservice']);
	Route::delete('/servicetype/delete/{id}',['uses'=>'ServiceTypeController@destroy','as'=>'deleteservicetype','permission'=>'deleteservice']);

	//serviceclass
	Route::get('/serviceclass',['uses'=>'ServiceClassController@index','as'=>'serviceclass','permission'=>'viewservice']);
	Route::get('/serviceclass/create',['uses'=>'ServiceClassController@create','as'=>'createserviceclass','permission'=>'insertservice']);
	Route::post('/serviceclass/store',['uses'=>'ServiceClassController@store','as'=>'storeserviceclass','permission'=>'insertservice']);
	Route::get('/serviceclass/edit/{id}',['uses'=>'ServiceClassController@edit','as'=>'editserviceclass','permission'=>'updateservice']);
	Route::put('/serviceclass/edit',['uses'=>'ServiceClassController@update','as'=>'updateserviceclass','permission'=>'updateservice']);
	Route::delete('/serviceclass/delete/{id}',['uses'=>'ServiceClassController@destroy','as'=>'deleteserviceclass','permission'=>'deleteservice']);

	//online_shops
	Route::get('/onlineshop',['uses'=>'OnlineShopController@index','as'=>'onlineshop','permission'=>'viewonlineshop']);
	Route::get('/onlineshop/create',['uses'=>'OnlineShopController@create','as'=>'createonlineshop','permission'=>'insertonlineshop']);
	Route::post('/onlineshop/store',['uses'=>'OnlineShopController@store','as'=>'storeonlineshop','permission'=>'insertonlineshop']);
	Route::get('/onlineshop/edit/{id}',['uses'=>'OnlineShopController@edit','as'=>'editonlineshop','permission'=>'updateonlineshop']);
	Route::put('/onlineshop/edit',['uses'=>'OnlineShopController@update','as'=>'updateonlineshop','permission'=>'updateonlineshop']);
	Route::delete('/onlineshop/delete/{id}',['uses'=>'OnlineShopController@destroy','as'=>'deleteonlineshop','permission'=>'deleteonlineshop']);

	//online_shop_item
	Route::get('/onlineshopitem',['uses'=>'OnlineShopItemController@index','as'=>'onlineshopitem','permission'=>'viewonlineshop']);
	Route::get('/onlineshopitem/create',['uses'=>'OnlineShopItemController@create','as'=>'createonlineshopitem','permission'=>'insertonlineshop']);
	Route::post('/onlineshopitem/store',['uses'=>'OnlineShopItemController@store','as'=>'storeonlineshopitem','permission'=>'insertonlineshop']);
	Route::get('/onlineshopitem/edit/{id}',['uses'=>'OnlineShopItemController@edit','as'=>'editonlineshopitem','permission'=>'updateonlineshop']);
	Route::put('/onlineshopitem/edit/{id}',['uses'=>'OnlineShopItemController@update','as'=>'updateonlineshopitem','permission'=>'updateonlineshop']);
	Route::delete('/onlineshopitem/delete/{id}',['uses'=>'OnlineShopItemController@destroy','as'=>'deleteonlineshopitem','permission'=>'deleteonlineshop']);
	
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

	