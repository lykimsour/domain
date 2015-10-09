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
		Route::get('/usersedit', ['uses'=>'UserController@edit','as' => 'edituser']);
		Route::put('/usersedit', ['uses'=>'UserController@update','as' => 'updateuser']);


	});


	Route::group(['middleware' => ['auth','acl']], function () {
	Route::get('/users/',['uses'=>'UserController@index','as'=>'users','permission' => 'manage_user']);
	Route::get('/users/newuser',['uses'=>'UserController@create','as'=>'newusers','permission' => 'manage_user']);
	Route::post('/users/storeuser',['uses'=>'UserController@store','as'=>'storeusers','permission' => 'manage_user']);
	Route::get('/users/blockuser/{id}',['uses'=>'UserController@block','as'=>'blockusers','permission' => 'manage_user']);
	Route::get('/users/unblockuser/{id}',['uses'=>'UserController@unblock','as'=>'unblockusers','permission' => 'manage_user']);
	Route::get('/users/edit/{id}', ['uses'=>'UserController@editOtherUser','as' => 'editotheruser','permission' => 'manage_user']);
	Route::put('/users/edit/{id}', ['uses'=>'UserController@updateOtherUser','as' => 'updateotheruser','permission' => 'manage_user']);
	Route::delete('/users/delete/{id}', ['uses'=>'UserController@deleteOtherUser','as' => 'deleteotheruser','permission' => 'manage_user']);


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
	Route::get('/permissionrole/edit/{id}',['uses'=>'PermissionRoleController@edit','as'=>'editpermissionrole','permission'=>'manage_user']);
	Route::put('/permissionrole/edit/{id}',['uses'=>'PermissionRoleController@update','as'=>'updatepermissionrole','permission'=>'manage_user']);
	Route::delete('/permissionrole/delete/{id}',['uses'=>'PermissionRoleController@destroy','as'=>'deletepermissionrole','permission'=>'manage_user']);

	//promotion
	Route::get('/promotion',['uses'=>'PromotionController@index','as'=>'promotion','permission'=>'view_promotion']);
	Route::get('/promotion/create',['uses'=>'PromotionController@create','as'=>'createpromotion','permission'=>'insert_promotion']);
	Route::post('/promotion/store',['uses'=>'PromotionController@store','as'=>'storepromotion','permission'=>'insert_promotion']);
	Route::get('/promotion/edit/{id}',['uses'=>'PromotionController@edit','as'=>'editpromotion','permission'=>'update_promotion']);
	Route::put('/promotion/edit/{id}',['uses'=>'PromotionController@update','as'=>'updatepromotion','permission'=>'update_promotion']);
	Route::delete('/promotion/delete/{id}',['uses'=>'PromotionController@destroy','as'=>'deletepromotion','permission'=>'delete_promotion']);


	//Merchant
	Route::get('/merchant',['uses'=>'MerchantController@index','as'=>'merchant','permission'=>'view_merchant']);
	Route::get('/merchant/create',['uses'=>'MerchantController@create','as'=>'createmerchant','permission'=>'insert_merchant']);
	Route::post('/merchant/store',['uses'=>'MerchantController@store','as'=>'storemerchant','permission'=>'insert_merchant']);
	Route::get('/merchant/edit/{id}',['uses'=>'MerchantController@edit','as'=>'editmerchant','permission'=>'update_merchant']);
	Route::put('/merchant/edit/{id}',['uses'=>'MerchantController@update','as'=>'updatemerchant','permission'=>'update_merchant']);
	Route::delete('/merchant/delete/{id}',['uses'=>'MerchantController@destroy','as'=>'deletemerchant','permission'=>'delete_merchant']);

	//Report cashierToreseller

	Route::get('/cashiertoreseller',['uses'=>'ReportCashierToReseller@index','as'=>'cashiertoreseller', 'permission'=>'manage_user']);
	
    //Report CommissionToCashier
    Route::get('/commissiontocashier', ['uses'=>'ReportCommissionToCashierController@index','as'=>'commissiontocashier', 'permission'=>'manage_user']);
	
	Route::get('/commissiontocashier/{type}', ['uses'=>'ReportCommissionToCashierController@index','as'=>'commissiontocashier', 'permission'=>'manage_user']);

	//Report CommissionToCashier
	Route::post('/commissiontocashier', ['uses'=>'ReportCommissionToCashierController@index','as'=>'commissiontocashier', 'permission'=>'manage_user']);
	
	//Report Detail CommissionToCashier
	Route::get('/commissiontocashier/detail/{id}', ['uses'=>'ReportCommissionToCashierController@show','as'=>'detailcommissiontocashier', 'permission'=>'manage_user']);
	
	//Report Detail Service CommissionToCashier
	Route::get('/commissiontocashier/servicedetail/{id}', ['uses'=>'ReportCommissionToCashierController@servicedetail','as'=>'detailservicecommissiontocashier', 'permission'=>'manage_user']);

	//Report CommissionToReseller
	Route::get('/commissiontoreseller', ['uses'=>'ReportCommissionToResellerController@index','as'=>'commissiontoreseller', 'permission'=>'manage_user']);
	Route::get('/commissiontoreseller/{type}', ['uses'=>'ReportCommissionToResellerController@index','as'=>'commissiontoreseller', 'permission'=>'manage_user']);
	Route::post('/commissiontoreseller', ['uses'=>'ReportCommissionToResellerController@index','as'=>'commissiontoreseller', 'permission'=>'manage_user']);

	//Report Detail CommissionToReseller
	Route::get('/commissiontoreseller/detail/{id}', ['uses'=>'ReportCommissionToResellerController@show','as'=>'detailcommissiontoreseller', 'permission'=>'manage_user']);
	//Report Detail Service CommissionToReseller
	Route::get('/commissiontoreseller/servicedetail/{id}', ['uses'=>'ReportCommissionToResellerController@servicedetail','as'=>'detailservicecommissiontoreseller', 'permission'=>'manage_user']);

	


	//Report  UserToServiceLog
	Route::get('/usertoservicelog', ['uses'=>'ReportUserToServiceLogController@index','as'=>'usertoservicelog', 'permission'=>'manage_user']);

	//Report Detail UserToServiceLog
	Route::get('/usertoservicelog/detail/{id}', ['uses'=>'ReportUserToServiceLogController@show','as'=>'detailusertoservicelog', 'permission'=>'manage_user']);

	//Report Detail UserToServiceLog
	Route::get('/usertoservicelog/servicedetail/{id}', ['uses'=>'ReportUserToServiceLogController@detailserviceuserlog','as'=>'detailserviceuserlog', 'permission'=>'manage_user']);
	
	

	Route::get('/usertoservicelog/{type}', ['uses'=>'ReportUserToServiceLogController@index','as'=>'usertoservicelog', 'permission'=>'manage_user']);
	
	Route::post('/usertoservicelog', ['uses'=>'ReportUserToServiceLogController@index','as'=>'usertoservicelog', 'permission'=>'manage_user']);
	
	//Report User To Merchant Log
	Route::get('/usertomerchantlog', ['uses'=>'ReportUserToMerchantLogController@index','as'=>'usertomerchantlog', 'permission'=>'manage_user']);
	Route::get('/usertomerchantlog/{type}', ['uses'=>'ReportUserToMerchantLogController@index','as'=>'usertomerchantlog', 'permission'=>'manage_user']);
	Route::post('/usertomerchantlog', ['uses'=>'ReportUserToMerchantLogController@index','as'=>'usertomerchantlog', 'permission'=>'manage_user']);
	Route::get('/cashiertoreseller',['uses'=>'ReportCashierToReseller@index','as'=>'cashiertoreseller','permission'=>'manage_user']);


	
	Route::post('/cashiertoreseller/detail/{id}',['uses'=>'ReportCashierToReseller@details','as'=>'detail','permission'=>'manage_user']);
	Route::get('/cashiertoreseller/detail/{id}/{time}/{startdate}/{enddate}',['uses'=>'ReportCashierToReseller@detail','as'=>'detail','permission'=>'manage_user']);
	Route::get('/cashiertoreseller/recorddetail/{id}',['uses'=>'ReportCashierToReseller@recorddetail','as'=>'recorddetail','permission'=>'manage_user']);
	Route::post('/cashiertoreseller/type/',['uses'=>'ReportCashierToReseller@queryreport','as'=>'queryreport','permission'=>'manage_user']);
	Route::get('/cashiertoreseller/type/{type}/{time}/{startdate}/{enddate}',['uses'=>'ReportCashierToReseller@queryreport','as'=>'report','permission'=>'manage_user']);
	});

	