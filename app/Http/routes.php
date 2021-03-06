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

	Route::get('auth/login', 'Auth\LdapAuthController@getLogin');
	Route::post('auth/login', 'Auth\LdapAuthController@postLogin');
	Route::get('auth/logout', ['as'=>'logout','uses'=>'Auth\LdapAuthController@getLogout']);

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
		Route::get('/permission/edit/{id}',['uses'=>'PermissionController@edit','as'=>'editpermission','permission'=>'manage_user']);
		Route::put('/permission/edit/{id}',['uses'=>'PermissionController@update','as'=>'updatepermission','permission'=>'manage_user']);

		//Permission_role
		Route::get('/permissionrole',['uses'=>'PermissionRoleController@index','as'=>'permissionrole','permission'=>'manage_user']);
		Route::get('/permissionrole/create/{roleid}',['uses'=>'PermissionRoleController@create','as'=>'createpermissionrole','permission'=>'manage_user']);
		Route::post('/permissionrole/store',['uses'=>'PermissionRoleController@store','as'=>'storepermissionrole','permission'=>'manage_user']);
		Route::get('/permissionrole/edit/{id}',['uses'=>'PermissionRoleController@edit','as'=>'editpermissionrole','permission'=>'manage_user']);
		Route::put('/permissionrole/edit/{id}',['uses'=>'PermissionRoleController@update','as'=>'updatepermissionrole','permission'=>'manage_user']);
		Route::delete('/permissionrole/delete/{id}',['uses'=>'PermissionRoleController@destroy','as'=>'deletepermissionrole','permission'=>'manage_user']);
		Route::get('/permissionrole/check/{id}',['uses'=>'PermissionRoleController@check','as'=>'checkpermissionrole','permission'=>'manage_user']);

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

	    //Report CommissionToCashier
	    Route::get('/commissiontocashier', ['uses'=>'ReportCommissionToCashierController@index','as'=>'commissiontocashier', 'permission'=>'manage_user']);
		Route::get('/commissiontocashier/{type}', ['uses'=>'ReportCommissionToCashierController@index','as'=>'commissiontocashier', 'permission'=>'manage_user']);
		Route::get('/commissiontocashier/period/{startdate}/{enddate}', ['uses'=>'ReportCommissionToCashierController@index','as'=>'commissiontocashier', 'permission'=>'manage_user']);
		Route::post('/commissiontocashier', ['uses'=>'ReportCommissionToCashierController@index','as'=>'commissiontocashier', 'permission'=>'manage_user']);
		Route::get('/commissiontocashier/detail/{id}/{type}', ['uses'=>'ReportCommissionToCashierController@show','as'=>'detailcommissiontocashier', 'permission'=>'manage_user']);
		Route::get('/commissiontocashier/detail/{id}/{type}/{startdate}/{enddate}', ['uses'=>'ReportCommissionToCashierController@show','as'=>'detailcommissiontocashier', 'permission'=>'manage_user']);
		Route::get('/commissiontocashier/servicedetail/{id}/{type}', ['uses'=>'ReportCommissionToCashierController@servicedetail','as'=>'detailservicecommissiontocashier', 'permission'=>'manage_user']);
		Route::get('/commissiontocashier/servicedetail/{id}/{type}/{startdate}/{enddate}', ['uses'=>'ReportCommissionToCashierController@servicedetail','as'=>'detailservicecommissiontocashier', 'permission'=>'manage_user']);

		//Report CommissionToReseller
		Route::get('/commissiontoreseller', ['uses'=>'ReportCommissionToResellerController@index','as'=>'commissiontoreseller', 'permission'=>'manage_user']);
		Route::get('/commissiontoreseller/{type}', ['uses'=>'ReportCommissionToResellerController@index','as'=>'commissiontoreseller', 'permission'=>'manage_user']);
		Route::get('/commissiontoreseller/period/{startdate}/{enddate}', ['uses'=>'ReportCommissionToResellerController@index','as'=>'commissiontoreseller', 'permission'=>'manage_user']);
		Route::post('/commissiontoreseller', ['uses'=>'ReportCommissionToResellerController@index','as'=>'commissiontoreseller', 'permission'=>'manage_user']);
		Route::get('/commissiontoreseller/detail/{id}/{type}', ['uses'=>'ReportCommissionToResellerController@show','as'=>'detailcommissiontoreseller', 'permission'=>'manage_user']);
		Route::get('/commissiontoreseller/detail/{id}/{type}/{startdate}/{enddate}', ['uses'=>'ReportCommissionToResellerController@show','as'=>'detailcommissiontoreseller', 'permission'=>'manage_user']);
		Route::get('/commissiontoreseller/servicedetail/{id}/{type}', ['uses'=>'ReportCommissionToResellerController@servicedetail','as'=>'detailservicecommissiontoreseller', 'permission'=>'manage_user']);
		Route::get('/commissiontoreseller/servicedetail/{id}/{type}/{startdate}/{enddate}', ['uses'=>'ReportCommissionToResellerController@servicedetail','as'=>'detailservicecommissiontoreseller', 'permission'=>'manage_user']);

		//Report  UserToService Log
		Route::get('/usertoservicelog', ['uses'=>'ReportUserToServiceLogController@index','as'=>'usertoservicelog', 'permission'=>'manage_user']);
		Route::get('/usertoservicelog/{type}', ['uses'=>'ReportUserToServiceLogController@index','as'=>'usertoservicelog', 'permission'=>'manage_user']);
		Route::get('/usertoservicelog/period/{startdate}/{enddate}', ['uses'=>'ReportUserToServiceLogController@index','as'=>'detailusertoservicelog', 'permission'=>'manage_user']);
		Route::post('/usertoservicelog', ['uses'=>'ReportUserToServiceLogController@index','as'=>'usertoservicelog', 'permission'=>'manage_user']);
		Route::get('/usertoservicelog/detail/{id}/{type}', ['uses'=>'ReportUserToServiceLogController@show','as'=>'detailusertoservicelog', 'permission'=>'manage_user']);
		Route::get('/usertoservicelog/detail/{id}/{type}/{startdate}/{enddate}', ['uses'=>'ReportUserToServiceLogController@show','as'=>'detailusertoservicelog', 'permission'=>'manage_user']);
		Route::get('/usertoservicelog/servicedetail/{id}/{type}', ['uses'=>'ReportUserToServiceLogController@servicedetail','as'=>'detailserviceuserlog', 'permission'=>'manage_user']);
		Route::get('/usertoservicelog/servicedetail/{id}/{type}/{startdate}/{enddate}', ['uses'=>'ReportUserToServiceLogController@servicedetail','as'=>'detailserviceuserlog', 'permission'=>'manage_user']);
		
		
		//Report User To Merchant Log
		Route::get('/usertomerchantlog', ['uses'=>'ReportUserToMerchantLogController@index','as'=>'usertomerchantlog', 'permission'=>'manage_user']);
		Route::get('/usertomerchantlog/{type}', ['uses'=>'ReportUserToMerchantLogController@index','as'=>'usertomerchantlog', 'permission'=>'manage_user']);
		Route::post('/usertomerchantlog', ['uses'=>'ReportUserToMerchantLogController@index','as'=>'usertomerchantlog', 'permission'=>'manage_user']);
		Route::get('/usertomerchantlog/detail/{id}/{type}', ['uses'=>'ReportUserToMerchantLogController@show','as'=>'detailusertomerchant', 'permission'=>'manage_user']);
		Route::get('/usertomerchantlog/detail/{id}/{type}/{startdate}/{enddate}', ['uses'=>'ReportUserToMerchantLogController@show','as'=>'detailusertomerchant', 'permission'=>'manage_user']);
		Route::get('/usertomerchantlog/servicedetail/{id}/{type}', ['uses'=>'ReportUserToMerchantLogController@servicedetail','as'=>'detailserviceusertomerchant', 'permission'=>'manage_user']);
		Route::get('/usertomerchantlog/servicedetail/{id}/{type}/{startdate}/{enddate}', ['uses'=>'ReportUserToMerchantLogController@servicedetail','as'=>'detailserviceusertomerchant', 'permission'=>'manage_user']);

		//report cashtoreseller
		Route::get('/cashiertoreseller',['uses'=>'ReportCashierToReseller@index','as'=>'cashiertoreseller', 'permission'=>'view_cashier_report']);
		Route::post('/cashiertoreseller/detail/{id}',['uses'=>'ReportCashierToReseller@details','as'=>'detail','permission'=>'view_cashier_report']);
		Route::get('/cashiertoreseller/detail/{id}/{time}/{startdate}/{enddate}',['uses'=>'ReportCashierToReseller@detail','as'=>'detail','permission'=>'view_cashier_report']);
		Route::get('/cashiertoreseller/recorddetail/{id}',['uses'=>'ReportCashierToReseller@recorddetail','as'=>'recorddetail','permission'=>'view_cashier_report']);
		Route::post('/cashiertoreseller/type/',['uses'=>'ReportCashierToReseller@queryreport','as'=>'queryreport','permission'=>'view_cashier_report']);
		Route::get('/cashiertoreseller/type/{type}/{time}/{startdate}/{enddate}',['uses'=>'ReportCashierToReseller@queryreport','as'=>'report','permission'=>'view_cashier_report']);
		
		//report cashtouser
		Route::get('/cashtouser',['uses'=>'ReportCashtoUserController@index','as'=>'cashtouser', 'permission'=>'view_cashier_report']);
		Route::post('/cashtouser/type/',['uses'=>'ReportCashtoUserController@queryreport','as'=>'queryreportcashtouser','permission'=>'view_cashier_report']);
		Route::get('/cashtouser/type/{type}/{time}/{startdate}/{enddate}',['uses'=>'ReportCashtoUserController@queryreport','as'=>'cashtouserreport','permission'=>'view_cashier_report']);
		Route::get('/cashtouser/detail/{id}/{time}/{startdate}/{enddate}',['uses'=>'ReportCashtoUserController@detail','as'=>'detailcashtouser','permission'=>'view_cashier_report']);
		Route::post('/cashtouser/detail/{id}/',['uses'=>'ReportCashtoUserController@details','as'=>'detailscashtouser','permission'=>'view_cashier_report']);
		Route::get('/cashtouser/recorddetail/{id}',['uses'=>'ReportCashtoUserController@recorddetail','as'=>'recorddetailcashtouser','permission'=>'view_cashier_report']);

		//Report User To Shop Log
		Route::get('/usertoshoplog', ['uses'=>'ReportUserToShopLogController@index','as'=>'usertoshoplog', 'permission'=>'manage_user']);
		Route::get('/usertoshoplog/{type}', ['uses'=>'ReportUserToShopLogController@index','as'=>'usertoshoplog', 'permission'=>'manage_user']);
		Route::get('/usertoshoplog/period/{startdate}/{enddate}', ['uses'=>'ReportUserToShopLogController@index','as'=>'usertoshoplog', 'permission'=>'manage_user']);
		Route::post('/usertoshoplog', ['uses'=>'ReportUserToShopLogController@index','as'=>'usertoshoplog', 'permission'=>'manage_user']);
		Route::get('/usertoshoplog/detail/{id}/{type}', ['uses'=>'ReportUserToShopLogController@show','as'=>'detailusertoshoplog', 'permission'=>'manage_user']);
		Route::get('/usertoshoplog/detail/{id}/{type}/{startdate}/{enddate}', ['uses'=>'ReportUserToShopLogController@show','as'=>'detailusertoshoplog', 'permission'=>'manage_user']);
		Route::get('/usertoshoplog/servicedetail/{id}/{type}', ['uses'=>'ReportUserToShopLogController@servicedetail','as'=>'detailserviceshoplog', 'permission'=>'manage_user']);
		Route::get('/usertoshoplog/servicedetail/{id}/{type}/{startdate}/{enddate}', ['uses'=>'ReportUserToShopLogController@servicedetail','as'=>'detailserviceshoplog', 'permission'=>'manage_user']);
		
		//Report cashierToreseller

		Route::get('/cashiertoreseller',['uses'=>'ReportCashierToReseller@index','as'=>'cashiertoreseller','permission'=>'manage_user']);
		Route::post('/cashiertoreseller/detail/{id}',['uses'=>'ReportCashierToReseller@details','as'=>'detail','permission'=>'manage_user']);
		Route::get('/cashiertoreseller/detail/{id}/{time}/{startdate}/{enddate}',['uses'=>'ReportCashierToReseller@detail','as'=>'detail','permission'=>'manage_user']);
		Route::get('/cashiertoreseller/recorddetail/{id}',['uses'=>'ReportCashierToReseller@recorddetail','as'=>'recorddetail','permission'=>'manage_user']);
		Route::post('/cashiertoreseller/type/',['uses'=>'ReportCashierToReseller@queryreport','as'=>'queryreport','permission'=>'manage_user']);
		Route::get('/cashiertoreseller/type/{type}/{time}/{startdate}/{enddate}',['uses'=>'ReportCashierToReseller@queryreport','as'=>'report','permission'=>'manage_user']);
		
		//Report Credit to User
		Route::get('/credittouser', ['uses'=>'ReportCredittoUserController@index','as'=>'credittouser', 'permission'=>'manage_user']);
		Route::post('/credittouser/type', ['uses'=>'ReportCredittoUserController@queryreport','as'=>'queryreportcredittouser', 'permission'=>'manage_user']);
		Route::get('/credittouser/type/{time}/{startdate}/{enddate}', ['uses'=>'ReportCredittoUserController@queryreport','as'=>'queryreportcredittouser1', 'permission'=>'manage_user']);
		Route::get('/credittouser/detail/{id}/{time}/{startdate}/{enddate}', ['uses'=>'ReportCredittoUserController@detail','as'=>'detailcredittouser', 'permission'=>'manage_user']);
		Route::post('/credittouser/detail/{id}', ['uses'=>'ReportCredittoUserController@details','as'=>'detailscredittouser', 'permission'=>'manage_user']);
		Route::get('/credittouser/recorddetail/{id}', ['uses'=>'ReportCredittoUserController@recorddetail','as'=>'recorddetailscredittouser', 'permission'=>'manage_user']);

		//Report Credit2Reseller
		Route::get('/credittoreseller',['uses'=>'ReportCredittoResellerController@index','as'=>'credittoreseller','permission'=>'manage_user']);
		Route::post('/credittoreseller/type',['uses'=>'ReportCredittoResellerController@queryreport','as'=>'queryreportcredittoreseller','permission'=>'manage_user']);
		Route::get('/credittoreseller/type/{time}/{startdate}/{enddate}',['uses'=>'ReportCredittoResellerController@queryreport','as'=>'queryreportcredittoreseller1','permission'=>'manage_user']);
		Route::get('/credittoreseller/detail/{id}/{time}/{startdate}/{enddate}',['uses'=>'ReportCredittoResellerController@detail','as'=>'detailcredittoreseller','permission'=>'manage_user']);
		Route::post('/credittoreseller/detail/{id}',['uses'=>'ReportCredittoResellerController@details','as'=>'detailscredittoreseller','permission'=>'manage_user']);

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
		Route::get('/permission/edit/{id}',['uses'=>'PermissionController@edit','as'=>'editpermission','permission'=>'manage_user']);
		Route::put('/permission/edit/{id}',['uses'=>'PermissionController@update','as'=>'updatepermission','permission'=>'manage_user']);

		//Permission_role
		Route::get('/permissionrole',['uses'=>'PermissionRoleController@index','as'=>'permissionrole','permission'=>'manage_user']);
		Route::get('/permissionrole/create/{roleid}',['uses'=>'PermissionRoleController@create','as'=>'createpermissionrole','permission'=>'manage_user']);
		Route::post('/permissionrole/store',['uses'=>'PermissionRoleController@store','as'=>'storepermissionrole','permission'=>'manage_user']);
		Route::get('/permissionrole/edit/{id}',['uses'=>'PermissionRoleController@edit','as'=>'editpermissionrole','permission'=>'manage_user']);
		Route::put('/permissionrole/edit/{id}',['uses'=>'PermissionRoleController@update','as'=>'updatepermissionrole','permission'=>'manage_user']);
		Route::delete('/permissionrole/delete/{id}',['uses'=>'PermissionRoleController@destroy','as'=>'deletepermissionrole','permission'=>'manage_user']);
		Route::get('/permissionrole/check/{id}',['uses'=>'PermissionRoleController@check','as'=>'checkpermissionrole','permission'=>'manage_user']);

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

	    //Report CommissionToCashier
	    Route::get('/commissiontocashier', ['uses'=>'ReportCommissionToCashierController@index','as'=>'commissiontocashier', 'permission'=>'manage_user']);
		Route::get('/commissiontocashier/{type}', ['uses'=>'ReportCommissionToCashierController@index','as'=>'commissiontocashier', 'permission'=>'manage_user']);
		Route::get('/commissiontocashier/period/{startdate}/{enddate}', ['uses'=>'ReportCommissionToCashierController@index','as'=>'commissiontocashier', 'permission'=>'manage_user']);
		Route::post('/commissiontocashier', ['uses'=>'ReportCommissionToCashierController@index','as'=>'commissiontocashier', 'permission'=>'manage_user']);
		Route::get('/commissiontocashier/detail/{id}/{type}', ['uses'=>'ReportCommissionToCashierController@show','as'=>'detailcommissiontocashier', 'permission'=>'manage_user']);
		Route::get('/commissiontocashier/detail/{id}/{type}/{startdate}/{enddate}', ['uses'=>'ReportCommissionToCashierController@show','as'=>'detailcommissiontocashier', 'permission'=>'manage_user']);
		Route::get('/commissiontocashier/servicedetail/{id}/{type}', ['uses'=>'ReportCommissionToCashierController@servicedetail','as'=>'detailservicecommissiontocashier', 'permission'=>'manage_user']);
		Route::get('/commissiontocashier/servicedetail/{id}/{type}/{startdate}/{enddate}', ['uses'=>'ReportCommissionToCashierController@servicedetail','as'=>'detailservicecommissiontocashier', 'permission'=>'manage_user']);

		//Report CommissionToReseller
		Route::get('/commissiontoreseller', ['uses'=>'ReportCommissionToResellerController@index','as'=>'commissiontoreseller', 'permission'=>'manage_user']);
		Route::get('/commissiontoreseller/{type}', ['uses'=>'ReportCommissionToResellerController@index','as'=>'commissiontoreseller', 'permission'=>'manage_user']);
		Route::get('/commissiontoreseller/period/{startdate}/{enddate}', ['uses'=>'ReportCommissionToResellerController@index','as'=>'commissiontoreseller', 'permission'=>'manage_user']);
		Route::post('/commissiontoreseller', ['uses'=>'ReportCommissionToResellerController@index','as'=>'commissiontoreseller', 'permission'=>'manage_user']);
		Route::get('/commissiontoreseller/detail/{id}/{type}', ['uses'=>'ReportCommissionToResellerController@show','as'=>'detailcommissiontoreseller', 'permission'=>'manage_user']);
		Route::get('/commissiontoreseller/detail/{id}/{type}/{startdate}/{enddate}', ['uses'=>'ReportCommissionToResellerController@show','as'=>'detailcommissiontoreseller', 'permission'=>'manage_user']);
		Route::get('/commissiontoreseller/servicedetail/{id}/{type}', ['uses'=>'ReportCommissionToResellerController@servicedetail','as'=>'detailservicecommissiontoreseller', 'permission'=>'manage_user']);
		Route::get('/commissiontoreseller/servicedetail/{id}/{type}/{startdate}/{enddate}', ['uses'=>'ReportCommissionToResellerController@servicedetail','as'=>'detailservicecommissiontoreseller', 'permission'=>'manage_user']);

		//Report  UserToService Log
		Route::get('/usertoservicelog', ['uses'=>'ReportUserToServiceLogController@index','as'=>'usertoservicelog', 'permission'=>'manage_user']);
		Route::get('/usertoservicelog/{type}', ['uses'=>'ReportUserToServiceLogController@index','as'=>'usertoservicelog', 'permission'=>'manage_user']);
		Route::get('/usertoservicelog/period/{startdate}/{enddate}', ['uses'=>'ReportUserToServiceLogController@index','as'=>'detailusertoservicelog', 'permission'=>'manage_user']);
		Route::post('/usertoservicelog', ['uses'=>'ReportUserToServiceLogController@index','as'=>'usertoservicelog', 'permission'=>'manage_user']);
		Route::get('/usertoservicelog/detail/{id}/{type}', ['uses'=>'ReportUserToServiceLogController@show','as'=>'detailusertoservicelog', 'permission'=>'manage_user']);
		Route::get('/usertoservicelog/detail/{id}/{type}/{startdate}/{enddate}', ['uses'=>'ReportUserToServiceLogController@show','as'=>'detailusertoservicelog', 'permission'=>'manage_user']);
		Route::get('/usertoservicelog/servicedetail/{id}/{type}', ['uses'=>'ReportUserToServiceLogController@servicedetail','as'=>'detailserviceuserlog', 'permission'=>'manage_user']);
		Route::get('/usertoservicelog/servicedetail/{id}/{type}/{startdate}/{enddate}', ['uses'=>'ReportUserToServiceLogController@servicedetail','as'=>'detailserviceuserlog', 'permission'=>'manage_user']);
		
		
		//Report User To Merchant Log
		Route::get('/usertomerchantlog', ['uses'=>'ReportUserToMerchantLogController@index','as'=>'usertomerchantlog', 'permission'=>'manage_user']);
		Route::get('/usertomerchantlog/{type}', ['uses'=>'ReportUserToMerchantLogController@index','as'=>'usertomerchantlog', 'permission'=>'manage_user']);
		Route::post('/usertomerchantlog', ['uses'=>'ReportUserToMerchantLogController@index','as'=>'usertomerchantlog', 'permission'=>'manage_user']);
		Route::get('/usertomerchantlog/detail/{id}/{type}', ['uses'=>'ReportUserToMerchantLogController@show','as'=>'detailusertomerchant', 'permission'=>'manage_user']);
		Route::get('/usertomerchantlog/detail/{id}/{type}/{startdate}/{enddate}', ['uses'=>'ReportUserToMerchantLogController@show','as'=>'detailusertomerchant', 'permission'=>'manage_user']);
		Route::get('/usertomerchantlog/servicedetail/{id}/{type}', ['uses'=>'ReportUserToMerchantLogController@servicedetail','as'=>'detailserviceusertomerchant', 'permission'=>'manage_user']);
		Route::get('/usertomerchantlog/servicedetail/{id}/{type}/{startdate}/{enddate}', ['uses'=>'ReportUserToMerchantLogController@servicedetail','as'=>'detailserviceusertomerchant', 'permission'=>'manage_user']);

		//report cashtoreseller
		Route::get('/cashiertoreseller',['uses'=>'ReportCashierToReseller@index','as'=>'cashiertoreseller', 'permission'=>'view_cashier_report']);
		Route::post('/cashiertoreseller/detail/{id}',['uses'=>'ReportCashierToReseller@details','as'=>'detail','permission'=>'view_cashier_report']);
		Route::get('/cashiertoreseller/detail/{id}/{time}/{startdate}/{enddate}',['uses'=>'ReportCashierToReseller@detail','as'=>'detail','permission'=>'view_cashier_report']);
		Route::get('/cashiertoreseller/recorddetail/{id}',['uses'=>'ReportCashierToReseller@recorddetail','as'=>'recorddetail','permission'=>'view_cashier_report']);
		Route::post('/cashiertoreseller/type/',['uses'=>'ReportCashierToReseller@queryreport','as'=>'queryreport','permission'=>'view_cashier_report']);
		Route::get('/cashiertoreseller/type/{type}/{time}/{startdate}/{enddate}',['uses'=>'ReportCashierToReseller@queryreport','as'=>'report','permission'=>'view_cashier_report']);
		
		//report cashtouser
		Route::get('/cashtouser',['uses'=>'ReportCashtoUserController@index','as'=>'cashtouser', 'permission'=>'view_cashier_report']);
		Route::post('/cashtouser/type/',['uses'=>'ReportCashtoUserController@queryreport','as'=>'queryreportcashtouser','permission'=>'view_cashier_report']);
		Route::get('/cashtouser/type/{type}/{time}/{startdate}/{enddate}',['uses'=>'ReportCashtoUserController@queryreport','as'=>'cashtouserreport','permission'=>'view_cashier_report']);
		Route::get('/cashtouser/detail/{id}/{time}/{startdate}/{enddate}',['uses'=>'ReportCashtoUserController@detail','as'=>'detailcashtouser','permission'=>'view_cashier_report']);
		Route::post('/cashtouser/detail/{id}/',['uses'=>'ReportCashtoUserController@details','as'=>'detailscashtouser','permission'=>'view_cashier_report']);
		Route::get('/cashtouser/recorddetail/{id}',['uses'=>'ReportCashtoUserController@recorddetail','as'=>'recorddetailcashtouser','permission'=>'view_cashier_report']);
		

		Route::get('/cashtouser/salereport/{id}/{time}/{startdate}/{enddate}',['uses'=>'ReportCashtoUserController@salereport','as'=>'salereport','permission'=>'view_cashier_report']);
		Route::post('/cashtouser/salereport/{id}',['uses'=>'ReportCashtoUserController@salereportpost','as'=>'salereportpost','permission'=>'view_cashier_report']);

		//Report User To Shop Log
		Route::get('/usertoshoplog', ['uses'=>'ReportUserToShopLogController@index','as'=>'usertoshoplog', 'permission'=>'manage_user']);
		Route::get('/usertoshoplog/{type}', ['uses'=>'ReportUserToShopLogController@index','as'=>'usertoshoplog', 'permission'=>'manage_user']);
		Route::get('/usertoshoplog/period/{startdate}/{enddate}', ['uses'=>'ReportUserToShopLogController@index','as'=>'usertoshoplog', 'permission'=>'manage_user']);
		Route::post('/usertoshoplog', ['uses'=>'ReportUserToShopLogController@index','as'=>'usertoshoplog', 'permission'=>'manage_user']);
		Route::get('/usertoshoplog/detail/{id}/{type}', ['uses'=>'ReportUserToShopLogController@show','as'=>'detailusertoshoplog', 'permission'=>'manage_user']);
		Route::get('/usertoshoplog/detail/{id}/{type}/{startdate}/{enddate}', ['uses'=>'ReportUserToShopLogController@show','as'=>'detailusertoshoplog', 'permission'=>'manage_user']);
		Route::get('/usertoshoplog/servicedetail/{id}/{type}', ['uses'=>'ReportUserToShopLogController@servicedetail','as'=>'detailserviceshoplog', 'permission'=>'manage_user']);
		Route::get('/usertoshoplog/servicedetail/{id}/{type}/{startdate}/{enddate}', ['uses'=>'ReportUserToShopLogController@servicedetail','as'=>'detailserviceshoplog', 'permission'=>'manage_user']);
		
		//Report cashierToreseller

		/*Route::get('/cashiertoreseller',['uses'=>'ReportCashierToReseller@index','as'=>'cashiertoreseller','permission'=>'manage_user']);
		Route::post('/cashiertoreseller/detail/{id}',['uses'=>'ReportCashierToReseller@details','as'=>'detail','permission'=>'manage_user']);
		Route::get('/cashiertoreseller/detail/{id}/{time}/{startdate}/{enddate}',['uses'=>'ReportCashierToReseller@detail','as'=>'detail','permission'=>'manage_user']);
		Route::get('/cashiertoreseller/recorddetail/{id}',['uses'=>'ReportCashierToReseller@recorddetail','as'=>'recorddetail','permission'=>'manage_user']);
		Route::post('/cashiertoreseller/type/',['uses'=>'ReportCashierToReseller@queryreport','as'=>'queryreport','permission'=>'manage_user']);
		Route::get('/cashiertoreseller/type/{type}/{time}/{startdate}/{enddate}',['uses'=>'ReportCashierToReseller@queryreport','as'=>'report','permission'=>'manage_user']);*/
		
		//Report Credit to User
		Route::get('/credittouser', ['uses'=>'ReportCredittoUserController@index','as'=>'credittouser', 'permission'=>'manage_user']);
		Route::post('/credittouser/type', ['uses'=>'ReportCredittoUserController@queryreport','as'=>'queryreportcredittouser', 'permission'=>'manage_user']);
		Route::get('/credittouser/type/{time}/{startdate}/{enddate}', ['uses'=>'ReportCredittoUserController@queryreport','as'=>'queryreportcredittouser1', 'permission'=>'manage_user']);
		Route::get('/credittouser/detail/{id}/{time}/{startdate}/{enddate}', ['uses'=>'ReportCredittoUserController@detail','as'=>'detailcredittouser', 'permission'=>'manage_user']);
		Route::post('/credittouser/detail/{id}', ['uses'=>'ReportCredittoUserController@details','as'=>'detailscredittouser', 'permission'=>'manage_user']);
		Route::get('/credittouser/recorddetail/{id}', ['uses'=>'ReportCredittoUserController@recorddetail','as'=>'recorddetailscredittouser', 'permission'=>'manage_user']);

		//Report Credit2Reseller
		Route::get('/credittoreseller',['uses'=>'ReportCredittoResellerController@index','as'=>'credittoreseller','permission'=>'manage_user']);
		Route::post('/credittoreseller/type',['uses'=>'ReportCredittoResellerController@queryreport','as'=>'queryreportcredittoreseller','permission'=>'manage_user']);
		Route::get('/credittoreseller/type/{time}/{startdate}/{enddate}',['uses'=>'ReportCredittoResellerController@queryreport','as'=>'queryreportcredittoreseller1','permission'=>'manage_user']);
		Route::get('/credittoreseller/detail/{id}/{time}/{startdate}/{enddate}',['uses'=>'ReportCredittoResellerController@detail','as'=>'detailcredittoreseller','permission'=>'manage_user']);
		Route::post('/credittoreseller/detail/{id}',['uses'=>'ReportCredittoResellerController@details','as'=>'detailscredittoreseller','permission'=>'manage_user']);

		//Report Gold2User
		Route::get('/goldtouser',['uses'=>'ReportGoldtoUserController@index','as'=>'goldtouser','permission'=>'manage_user']);
		Route::post('/goldtouser/type',['uses'=>'ReportGoldtoUserController@queryreport','as'=>'queryreportgoldtouser','permission'=>'manage_user']);
		Route::get('/goldtouser/type/{type}/{time}/{startdate}/{enddate}',['uses'=>'ReportGoldtoUserController@queryreport','as'=>'getqueryreportgoldtouser','permission'=>'manage_user']);
		Route::post('/goldtouser/detail/{id}',['uses'=>'ReportGoldtoUserController@details','as'=>'detailgoldtouser','permission'=>'manage_user']);
		Route::get('/goldtouser/detail/{id}/{time}/{startdate}/{enddate}',['uses'=>'ReportGoldtoUserController@detail','as'=>'detailsreportgoldtouser','permission'=>'manage_user']);
		Route::get('/goldtouser/recorddetail/{id}',['uses'=>'ReportGoldtoUserController@recorddetail','as'=>'recorddetailsreportgoldtouser','permission'=>'manage_user']);

		//Item Management
		Route::get('/item/game/{gametype}',['uses'=>'ItemController@getgametype','as'=>'getgametype','permission'=>'manage_user']);
		Route::get('/item',['uses'=>'ItemController@index','as'=>'item','permission'=>'manage_user']);
		Route::get('/item/create/{gametype}',['uses'=>'ItemController@create','as'=>'createitem','permission'=>'manage_user']);
		Route::post('/item/store',['uses'=>'ItemController@store','as'=>'storeitem','permission'=>'manage_user']);
		Route::get('/item/edit/{id}/{gametype}',['uses'=>'ItemController@edit','as'=>'edititem','permission'=>'manage_user']);
		Route::put('/item/update/{id}/{gametype}',['uses'=>'ItemController@update','as'=>'updateitem','permission'=>'manage_user']);
		Route::delete('/item/destroy/{id}/{gametype}',['uses'=>'ItemController@destroy','as'=>'destroyitem','permission'=>'manage_user']);
	

		//ItemGroup
		Route::get('/itemgroup/game/{gametype}',['uses'=>'ItemGroupController@getgametype','as'=>'getgametypegroup','permission'=>'manage_user']);
		Route::get('/itemgroup',['uses'=>'ItemGroupController@index','as'=>'itemgroup','permission'=>'manage_user']);
		Route::get('/itemgroup/create/{gametype}',['uses'=>'ItemGroupController@create','as'=>'createitemgroup','permission'=>'manage_user']);
		Route::post('/itemgroup/store',['uses'=>'ItemGroupController@store','as'=>'storeitemgroup','permission'=>'manage_user']);
		Route::get('/itemgroup/edit/{id}/{gametype}',['uses'=>'ItemGroupController@edit','as'=>'edititemgroup','permission'=>'manage_user']);
		Route::put('/itemgroup/update/{id}/{gametype}',['uses'=>'ItemGroupController@update','as'=>'updateitemgroup','permission'=>'manage_user']);
		Route::delete('/itemgroup/destroy/{id}/{gametype}',['uses'=>'ItemGroupController@destroy','as'=>'destroyitemgroup','permission'=>'manage_user']);

		//Itemtype
		Route::get('/itemtype/game/{gametype}',['uses'=>'ItemTypeController@getgametype','as'=>'getgametypetype','permission'=>'manage_user']);
		Route::get('/itemtype',['uses'=>'ItemTypeController@index','as'=>'itemtype','permission'=>'manage_user']);
		Route::get('/itemtype/create/{gametype}',['uses'=>'ItemTypeController@create','as'=>'createitemtype','permission'=>'manage_user']);
		Route::post('/itemtype/store',['uses'=>'ItemTypeController@store','as'=>'storeitemtype','permission'=>'manage_user']);
		Route::get('/itemtype/edit/{id}/{gametype}',['uses'=>'ItemTypeController@edit','as'=>'edititemtype','permission'=>'manage_user']);
		Route::put('/itemtype/update/{id}/{gametype}',['uses'=>'ItemTypeController@update','as'=>'updateitemtype','permission'=>'manage_user']);
		Route::delete('/itemtype/destroy/{id}/{gametype}',['uses'=>'ItemTypeController@destroy','as'=>'destroyitemtype','permission'=>'manage_user']);

		//Reseller management
		Route::get('/reseller',['uses'=>'ResellerController@index','as'=>'reseller','permission'=>'manage_user']);
		Route::get('/reseller/requesttoken/{id}',['uses'=>'ResellerController@requesttoken','as'=>'requesttoken','permission'=>'manage_user']);

	

		//GameUpdate
		Route::get('/gameupdate',['uses'=>'GameUpdateController@index','as'=>'gameupdate','permission'=>'manage_user']);
		Route::get('/gameupdate/create/{gametype}',['uses'=>'GameUpdateController@create','as'=>'creategameupdate','permission'=>'manage_user']);
		Route::post('/gameupdate/store',['uses'=>'GameUpdateController@store','as'=>'storegameupdate','permission'=>'manage_user']);
		Route::delete('/gameupdate/destroy/{id}',['uses'=>'GameUpdateController@destroy','as'=>'destroygameupdate','permission'=>'manage_user']);
		Route::get('/gameupdate/edit/{id}/{gametype}',['uses'=>'GameUpdateController@edit','as'=>'editgameupdate','permission'=>'manage_user']);
		Route::put('/gameupdate/update/{id}',['uses'=>'GameUpdateController@update','as'=>'updategameupdate','permission'=>'manage_user']);

	});

	