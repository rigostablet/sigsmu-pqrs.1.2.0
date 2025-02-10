<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



	Route::get('', 'IndexController@index')->name('index')->middleware(['redirect.to.home']);
	Route::get('index/login', 'IndexController@login')->name('login');

	Route::post('auth/login', 'AuthController@login')->name('auth.login');
	Route::any('auth/logout', 'AuthController@logout')->name('logout')->middleware(['auth']);

	Route::get('auth/accountcreated', 'AuthController@accountcreated')->name('accountcreated');
	Route::get('auth/accountpending', 'AuthController@accountpending')->name('accountpending');
	Route::get('auth/accountblocked', 'AuthController@accountblocked')->name('accountblocked');
	Route::get('auth/accountinactive', 'AuthController@accountinactive')->name('accountinactive');



	Route::post('auth/login', 'AuthController@login')->name('auth.login');
	Route::get('auth/password/forgotpassword', 'AuthController@showForgotPassword')->name('password.forgotpassword');
	Route::post('auth/password/sendemail', 'AuthController@sendPasswordResetLink')->name('password.email');
	Route::get('auth/password/reset', 'AuthController@showResetPassword')->name('password.reset.token');
	Route::post('auth/password/resetpassword', 'AuthController@resetPassword')->name('password.resetpassword');
	Route::get('auth/password/resetcompleted', 'AuthController@passwordResetCompleted')->name('password.resetcompleted');
	Route::get('auth/password/linksent', 'AuthController@passwordResetLinkSent')->name('password.resetlinksent');


/**
 * All routes which requires auth
 */
Route::middleware(['auth', 'rbac'])->group(function () {

	Route::get('home', 'HomeController@index')->name('home');



/* routes for DetalleVen Controller */
	Route::get('detalleven', 'DetalleVenController@index')->name('detalleven.index');
	Route::get('detalleven/index/{filter?}/{filtervalue?}', 'DetalleVenController@index')->name('detalleven.index_filter');

/* routes for NotPqrs Controller */
	Route::get('notpqrs', 'NotPqrsController@index')->name('notpqrs.index');
	Route::get('notpqrs/index/{filter?}/{filtervalue?}', 'NotPqrsController@index')->name('notpqrs.index_filter');
	Route::get('notpqrs/view/{rec_id}', 'NotPqrsController@view')->name('notpqrs.view');
	Route::get('notpqrs/add', 'NotPqrsController@add')->name('notpqrs.add');
	Route::post('notpqrs/add', 'NotPqrsController@store')->name('notpqrs.store');

	Route::any('notpqrs/edit/{rec_id}', 'NotPqrsController@edit')->name('notpqrs.edit');
	Route::get('notpqrs/delete/{rec_id}', 'NotPqrsController@delete');

/* routes for Permissions Controller */
	Route::get('permissions', 'PermissionsController@index')->name('permissions.index');
	Route::get('permissions/index/{filter?}/{filtervalue?}', 'PermissionsController@index')->name('permissions.index_filter');
	Route::get('permissions/view/{rec_id}', 'PermissionsController@view')->name('permissions.view');
	Route::get('permissions/add', 'PermissionsController@add')->name('permissions.add');
	Route::post('permissions/add', 'PermissionsController@store')->name('permissions.store');

	Route::any('permissions/edit/{rec_id}', 'PermissionsController@edit')->name('permissions.edit');
	Route::get('permissions/delete/{rec_id}', 'PermissionsController@delete');

/* routes for PqrsAsig Controller */
	Route::get('pqrsasig', 'PqrsAsigController@index')->name('pqrsasig.index');
	Route::get('pqrsasig/index/{filter?}/{filtervalue?}', 'PqrsAsigController@index')->name('pqrsasig.index_filter');
	Route::get('pqrsasig/view/{rec_id}', 'PqrsAsigController@view')->name('pqrsasig.view');
	Route::get('pqrsasig/add', 'PqrsAsigController@add')->name('pqrsasig.add');
	Route::post('pqrsasig/add', 'PqrsAsigController@store')->name('pqrsasig.store');

	Route::any('pqrsasig/edit/{rec_id}', 'PqrsAsigController@edit')->name('pqrsasig.edit');
	Route::get('pqrsasig/delete/{rec_id}', 'PqrsAsigController@delete');

/* routes for PqrsCarg Controller */
	Route::get('pqrscarg', 'PqrsCargController@index')->name('pqrscarg.index');
	Route::get('pqrscarg/index/{filter?}/{filtervalue?}', 'PqrsCargController@index')->name('pqrscarg.index_filter');
	Route::get('pqrscarg/view/{rec_id}', 'PqrsCargController@view')->name('pqrscarg.view');
	Route::get('pqrscarg/add', 'PqrsCargController@add')->name('pqrscarg.add');
	Route::post('pqrscarg/add', 'PqrsCargController@store')->name('pqrscarg.store');

	Route::any('pqrscarg/edit/{rec_id}', 'PqrsCargController@edit')->name('pqrscarg.edit');
	Route::get('pqrscarg/delete/{rec_id}', 'PqrsCargController@delete');

/* routes for PqrsDpto Controller */
	Route::get('pqrsdpto', 'PqrsDptoController@index')->name('pqrsdpto.index');
	Route::get('pqrsdpto/index/{filter?}/{filtervalue?}', 'PqrsDptoController@index')->name('pqrsdpto.index_filter');
	Route::get('pqrsdpto/view/{rec_id}', 'PqrsDptoController@view')->name('pqrsdpto.view');
	Route::get('pqrsdpto/add', 'PqrsDptoController@add')->name('pqrsdpto.add');
	Route::post('pqrsdpto/add', 'PqrsDptoController@store')->name('pqrsdpto.store');

	Route::any('pqrsdpto/edit/{rec_id}', 'PqrsDptoController@edit')->name('pqrsdpto.edit');
	Route::get('pqrsdpto/delete/{rec_id}', 'PqrsDptoController@delete');

/* routes for PqrsEnt Controller */
	Route::get('pqrsent', 'PqrsEntController@index')->name('pqrsent.index');
	Route::get('pqrsent/index/{filter?}/{filtervalue?}', 'PqrsEntController@index')->name('pqrsent.index_filter');
	Route::get('pqrsent/view/{rec_id}', 'PqrsEntController@view')->name('pqrsent.view');
	Route::get('pqrsent/add', 'PqrsEntController@add')->name('pqrsent.add');
	Route::post('pqrsent/add', 'PqrsEntController@store')->name('pqrsent.store');

	Route::any('pqrsent/edit/{rec_id}', 'PqrsEntController@edit')->name('pqrsent.edit');
	Route::get('pqrsent/delete/{rec_id}', 'PqrsEntController@delete');

/* routes for PqrsMun Controller */
	Route::get('pqrsmun', 'PqrsMunController@index')->name('pqrsmun.index');
	Route::get('pqrsmun/index/{filter?}/{filtervalue?}', 'PqrsMunController@index')->name('pqrsmun.index_filter');
	Route::get('pqrsmun/view/{rec_id}', 'PqrsMunController@view')->name('pqrsmun.view');
	Route::get('pqrsmun/add', 'PqrsMunController@add')->name('pqrsmun.add');
	Route::post('pqrsmun/add', 'PqrsMunController@store')->name('pqrsmun.store');

	Route::any('pqrsmun/edit/{rec_id}', 'PqrsMunController@edit')->name('pqrsmun.edit');
	Route::get('pqrsmun/delete/{rec_id}', 'PqrsMunController@delete');

/* routes for PqrsPet Controller */
	Route::get('pqrspet', 'PqrsPetController@index')->name('pqrspet.index');
	Route::get('pqrspet/index/{filter?}/{filtervalue?}', 'PqrsPetController@index')->name('pqrspet.index_filter');
	Route::get('pqrspet/view/{rec_id}', 'PqrsPetController@view')->name('pqrspet.view');
	Route::get('pqrspet/add', 'PqrsPetController@add')->name('pqrspet.add');
	Route::post('pqrspet/add', 'PqrsPetController@store')->name('pqrspet.store');

	Route::any('pqrspet/edit/{rec_id}', 'PqrsPetController@edit')->name('pqrspet.edit');
	Route::get('pqrspet/delete/{rec_id}', 'PqrsPetController@delete');

/* routes for PqrsRegPqrs Controller */
	Route::get('pqrsregpqrs', 'PqrsRegPqrsController@index')->name('pqrsregpqrs.index');
	Route::get('pqrsregpqrs/index/{filter?}/{filtervalue?}', 'PqrsRegPqrsController@index')->name('pqrsregpqrs.index_filter');
	Route::get('pqrsregpqrs/view/{rec_id}', 'PqrsRegPqrsController@view')->name('pqrsregpqrs.view');
	Route::get('pqrsregpqrs/masterdetail/{rec_id}', 'PqrsRegPqrsController@masterDetail')->name('pqrsregpqrs.masterdetail')->withoutMiddleware(['rbac']);
	Route::get('pqrsregpqrs/add', 'PqrsRegPqrsController@add')->name('pqrsregpqrs.add');
	Route::post('pqrsregpqrs/add', 'PqrsRegPqrsController@store')->name('pqrsregpqrs.store');

	Route::any('pqrsregpqrs/edit/{rec_id}', 'PqrsRegPqrsController@edit')->name('pqrsregpqrs.edit');
	Route::get('pqrsregpqrs/delete/{rec_id}', 'PqrsRegPqrsController@delete');
	Route::get('pqrsregpqrs/pqrs_sin_asignar', 'PqrsRegPqrsController@pqrs_sin_asignar');
	Route::get('pqrsregpqrs/pqrs_sin_asignar/{filter?}/{filtervalue?}', 'PqrsRegPqrsController@pqrs_sin_asignar');
	Route::get('pqrsregpqrs/pqrs_asignados', 'PqrsRegPqrsController@pqrs_asignados');
	Route::get('pqrsregpqrs/pqrs_asignados/{filter?}/{filtervalue?}', 'PqrsRegPqrsController@pqrs_asignados');
	Route::get('pqrsregpqrs/pqrs_respond', 'PqrsRegPqrsController@pqrs_respond');
	Route::get('pqrsregpqrs/pqrs_respond/{filter?}/{filtervalue?}', 'PqrsRegPqrsController@pqrs_respond');
	Route::get('pqrsregpqrs/list_pqrs_contrat', 'PqrsRegPqrsController@list_pqrs_contrat');
	Route::get('pqrsregpqrs/list_pqrs_contrat/{filter?}/{filtervalue?}', 'PqrsRegPqrsController@list_pqrs_contrat');
	Route::get('pqrsregpqrs/add_pqrs_contrat', 'PqrsRegPqrsController@add_pqrs_contrat')->name('pqrsregpqrs.add_pqrs_contrat');
	Route::post('pqrsregpqrs/add_pqrs_contrat', 'PqrsRegPqrsController@add_pqrs_contrat_store')->name('pqrsregpqrs.add_pqrs_contrat_store');

	Route::get('pqrsregpqrs/list_pqrs_total_cont_', 'PqrsRegPqrsController@list_pqrs_total_cont_');
	Route::get('pqrsregpqrs/list_pqrs_total_cont_/{filter?}/{filtervalue?}', 'PqrsRegPqrsController@list_pqrs_total_cont_');

/* routes for PqrsRespon Controller */
	Route::get('pqrsrespon', 'PqrsResponController@index')->name('pqrsrespon.index');
	Route::get('pqrsrespon/index/{filter?}/{filtervalue?}', 'PqrsResponController@index')->name('pqrsrespon.index_filter');
	Route::get('pqrsrespon/view/{rec_id}', 'PqrsResponController@view')->name('pqrsrespon.view');
	Route::get('pqrsrespon/add', 'PqrsResponController@add')->name('pqrsrespon.add');
	Route::post('pqrsrespon/add', 'PqrsResponController@store')->name('pqrsrespon.store');

	Route::any('pqrsrespon/edit/{rec_id}', 'PqrsResponController@edit')->name('pqrsrespon.edit');
	Route::get('pqrsrespon/delete/{rec_id}', 'PqrsResponController@delete');

/* routes for PqrsRespu Controller */
	Route::get('pqrsrespu', 'PqrsRespuController@index')->name('pqrsrespu.index');
	Route::get('pqrsrespu/index/{filter?}/{filtervalue?}', 'PqrsRespuController@index')->name('pqrsrespu.index_filter');
	Route::get('pqrsrespu/view/{rec_id}', 'PqrsRespuController@view')->name('pqrsrespu.view');
	Route::get('pqrsrespu/add', 'PqrsRespuController@add')->name('pqrsrespu.add');
	Route::post('pqrsrespu/add', 'PqrsRespuController@store')->name('pqrsrespu.store');

	Route::any('pqrsrespu/edit/{rec_id}', 'PqrsRespuController@edit')->name('pqrsrespu.edit');
	Route::get('pqrsrespu/delete/{rec_id}', 'PqrsRespuController@delete');

/* routes for PqrsTipdoc Controller */
	Route::get('pqrstipdoc', 'PqrsTipdocController@index')->name('pqrstipdoc.index');
	Route::get('pqrstipdoc/index/{filter?}/{filtervalue?}', 'PqrsTipdocController@index')->name('pqrstipdoc.index_filter');
	Route::get('pqrstipdoc/view/{rec_id}', 'PqrsTipdocController@view')->name('pqrstipdoc.view');
	Route::get('pqrstipdoc/add', 'PqrsTipdocController@add')->name('pqrstipdoc.add');
	Route::post('pqrstipdoc/add', 'PqrsTipdocController@store')->name('pqrstipdoc.store');

	Route::any('pqrstipdoc/edit/{rec_id}', 'PqrsTipdocController@edit')->name('pqrstipdoc.edit');
	Route::get('pqrstipdoc/delete/{rec_id}', 'PqrsTipdocController@delete');

/* routes for PqrsTipent Controller */
	Route::get('pqrstipent', 'PqrsTipentController@index')->name('pqrstipent.index');
	Route::get('pqrstipent/index/{filter?}/{filtervalue?}', 'PqrsTipentController@index')->name('pqrstipent.index_filter');
	Route::get('pqrstipent/view/{rec_id}', 'PqrsTipentController@view')->name('pqrstipent.view');
	Route::get('pqrstipent/add', 'PqrsTipentController@add')->name('pqrstipent.add');
	Route::post('pqrstipent/add', 'PqrsTipentController@store')->name('pqrstipent.store');

	Route::any('pqrstipent/edit/{rec_id}', 'PqrsTipentController@edit')->name('pqrstipent.edit');
	Route::get('pqrstipent/delete/{rec_id}', 'PqrsTipentController@delete');

/* routes for PqrsTipsol Controller */
	Route::get('pqrstipsol', 'PqrsTipsolController@index')->name('pqrstipsol.index');
	Route::get('pqrstipsol/index/{filter?}/{filtervalue?}', 'PqrsTipsolController@index')->name('pqrstipsol.index_filter');
	Route::get('pqrstipsol/view/{rec_id}', 'PqrsTipsolController@view')->name('pqrstipsol.view');
	Route::get('pqrstipsol/add', 'PqrsTipsolController@add')->name('pqrstipsol.add');
	Route::post('pqrstipsol/add', 'PqrsTipsolController@store')->name('pqrstipsol.store');

	Route::any('pqrstipsol/edit/{rec_id}', 'PqrsTipsolController@edit')->name('pqrstipsol.edit');
	Route::get('pqrstipsol/delete/{rec_id}', 'PqrsTipsolController@delete');

/* routes for Roles Controller */
	Route::get('roles', 'RolesController@index')->name('roles.index');
	Route::get('roles/index/{filter?}/{filtervalue?}', 'RolesController@index')->name('roles.index_filter');
	Route::get('roles/view/{rec_id}', 'RolesController@view')->name('roles.view');
	Route::get('roles/masterdetail/{rec_id}', 'RolesController@masterDetail')->name('roles.masterdetail')->withoutMiddleware(['rbac']);
	Route::get('roles/add', 'RolesController@add')->name('roles.add');
	Route::post('roles/add', 'RolesController@store')->name('roles.store');

	Route::any('roles/edit/{rec_id}', 'RolesController@edit')->name('roles.edit');
	Route::get('roles/delete/{rec_id}', 'RolesController@delete');

/* routes for User Controller */
	Route::get('user', 'UserController@index')->name('user.index');
	Route::get('user/index/{filter?}/{filtervalue?}', 'UserController@index')->name('user.index_filter');
	Route::get('user/view/{rec_id}', 'UserController@view')->name('user.view');
	Route::any('account/edit', 'AccountController@edit')->name('account.edit');
	Route::get('account', 'AccountController@index');
	Route::post('account/changepassword', 'AccountController@changepassword')->name('account.changepassword');
	Route::get('user/add', 'UserController@add')->name('user.add');
	Route::post('user/add', 'UserController@store')->name('user.store');

	Route::any('user/edit/{rec_id}', 'UserController@edit')->name('user.edit');
	Route::get('user/delete/{rec_id}', 'UserController@delete');

/* routes for Users Controller */
	Route::get('users', 'UsersController@index')->name('users.index');
	Route::get('users/index/{filter?}/{filtervalue?}', 'UsersController@index')->name('users.index_filter');
	Route::get('users/view/{rec_id}', 'UsersController@view')->name('users.view');
	Route::get('users/add', 'UsersController@add')->name('users.add');
	Route::post('users/add', 'UsersController@store')->name('users.store');

	Route::any('users/edit/{rec_id}', 'UsersController@edit')->name('users.edit');
	Route::get('users/delete/{rec_id}', 'UsersController@delete');
});



Route::get('componentsdata/role_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->role_id_option_list($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/id_ent_asig_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->id_ent_asig_option_list($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/id_resp_asig_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->id_resp_asig_option_list($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/email_asig_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->email_asig_option_list($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/tip_ent_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->tip_ent_option_list($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/mun_ent_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->mun_ent_option_list($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/dpto_mun_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->dpto_mun_option_list($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/pqrsmun_cod_mun_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->pqrsmun_cod_mun_value_exist($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/cod_mun_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->cod_mun_option_list($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/id_ent_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->id_ent_option_list($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/pet_ent_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->pet_ent_option_list($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/pet_tipdoc_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->pet_tipdoc_option_list($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/carg_pet_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->carg_pet_option_list($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/pqrspet_email_pet_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->pqrspet_email_pet_value_exist($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/dpto_pet_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->dpto_pet_option_list($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/mun_pet_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->mun_pet_option_list($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/tip_ent_sol_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->tip_ent_sol_option_list($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/id_ent_sol_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->id_ent_sol_option_list($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/id_pet_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->id_pet_option_list($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/tip_sol_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->tip_sol_option_list($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/id_tip_ent_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->id_tip_ent_option_list($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/id_ent_resp_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->id_ent_resp_option_list($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/dpt_resp_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->dpt_resp_option_list($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/rad_respu_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->rad_respu_option_list($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/user_username_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->user_username_value_exist($request);
	}
)->middleware(['auth']);

// NUEVO CODIGO AGREGADO PARA VALIDACION DEL NUMERO DE DOCUMENTO DEL PETICIONARIO
Route::get('componentsdata/pqrs_pet_pet_numpet_value_exist',  function(Request $request){
	$compModel = new App\Models\ComponentsData();
	return $compModel->pqrs_pet_pet_numpet_value_exist($request);
}
)->middleware(['auth']);


//-----------------------------------

Route::get('componentsdata/user_email_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->user_email_value_exist($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/oficina_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->oficina_option_list($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/dpto_user_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->dpto_user_option_list($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/user_cod_mun_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->user_cod_mun_option_list($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/role_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->role_option_list($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/getcount_sinnotificar',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->getcount_sinnotificar($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/getcount_sinresponder',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->getcount_sinresponder($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/getcount_respuestas',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->getcount_respuestas($request);
	}
)->middleware(['auth']);

Route::get('componentsdata/getcount_totalpqrs',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->getcount_totalpqrs($request);
	}
)->middleware(['auth']);


Route::post('fileuploader/upload/{fieldname}', 'FileUploaderController@upload');
Route::post('fileuploader/s3upload/{fieldname}', 'FileUploaderController@s3upload');
Route::post('fileuploader/remove_temp_file', 'FileUploaderController@remove_temp_file');


/**
 * All static content routes
 */
Route::get('info/about',  function(){
		return view("pages.info.about");
	}
);
Route::get('info/faq',  function(){
		return view("pages.info.faq");
	}
);

Route::get('info/contact',  function(){
	return view("pages.info.contact");
}
);
Route::get('info/contactsent',  function(){
	return view("pages.info.contactsent");
}
);

Route::post('info/contact',  function(Request $request){
		$request->validate([
			'name' => 'required',
			'email' => 'required|email',
			'message' => 'required'
		]);

		$senderName = $request->name;
		$senderEmail = $request->email;
		$message = $request->message;

		$receiverEmail = config("mail.from.address");

		Mail::send(
			'pages.info.contactemail', [
				'name' => $senderName,
				'email' => $senderEmail,
				'comment' => $message
			],
			function ($mail) use ($senderEmail, $receiverEmail) {
				$mail->from($senderEmail);
				$mail->to($receiverEmail)
					->subject('Contact Form');
			}
		);
		return redirect("info/contactsent");
	}
);


Route::get('info/features',  function(){
		return view("pages.info.features");
	}
);
Route::get('info/privacypolicy',  function(){
		return view("pages.info.privacypolicy");
	}
);
Route::get('info/termsandconditions',  function(){
		return view("pages.info.termsandconditions");
	}
);

Route::get('info/changelocale/{locale}', function ($locale) {
	app()->setlocale($locale);
	session()->put('locale', $locale);
    return redirect()->back();
})->name('info.changelocale');
