<?php

use Illuminate\Support\Facades\Route;

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


/* main pages */

Route::get('/', 'MainController@main')->name('main');
Route::get('/solution', 'MainController@solution')->name('solution');
Route::get('/contact', 'MainController@contact')->name('contact');
Route::get('/politics', 'MainController@politic')->name('politic');
Route::get('/score', 'MainController@score')->name('score');
Route::get('/call', 'CallController@getPage')->name('call');

/* registration */
Route::get('/registration', 'AuthController@register')->name('register');
Route::post('/registration/user', 'AuthController@postRegister')->name('user-create');
Route::post('/registration/valid', 'AuthController@registrValidation')->name('registr.validation');
Route::get('/registration/accept', 'AuthController@accept')->name('register-accept');

/* authorization */
Route::get('/authorization', 'AuthController@auth')->name('author');
Route::post('/authorization/valid', 'AuthController@authValidation')->name('author.validation');
Route::post('/authorization/enter', 'AuthController@postAuth')->name('enter');

/* call */
Route::post('/call/valid', 'CallController@callValidation')->name('call.validation');

/* lk */
Route::group(['middleware' => 'auth','prefix' => 'lk', 'namespace' => 'lk'], function() {
	Route::get('/', 'OfficeController@get')->name('office');
	Route::get('/logout', 'OfficeController@logout')->name('logout');
	Route::get('/tariff', 'TariffController@get')->name('tariff');
	Route::get('/tariff/delete', 'OfficeController@delete')->name('tariff.delete');
	Route::get('/tariff/price/{month}', 'TariffController@getPrice');
	Route::get('/operations/{count}/{status}', 'OfficeController@getTable');
	/*
		Autopay Control
	*/
	Route::put('/autopay/on', 'AutopayController@on')->name('auto.on');
	Route::put('/autopay/off', 'AutopayController@off')->name('auto.off');
});


/* all pays */
Route::group(['namespace' => 'pay'], function() {
	/* оплата внутреннего кошелька */
	Route::post('/pay/purse', 'PayController@purseUp')->name('pay.purse.up');
	/* можно вручную вбить страницу! нужны динамичекие данные в таблицу БД и динамическая переменная {token} */
	Route::get('/pay/purse/success/{token}', 'PayController@purseSuccess')->name('pay.purse.up.success');
	Route::get('/pay/purse/fail', 'PayController@purseFail')->name('pay.purse.up.fail');
	/* оплата тарифа */
	Route::post('/pay/tariff', 'PayController@payTariff')->name('pay.tariff');
	/* можно вручную вбить страницу! нужны динамичекие данные в таблицу БД и динамическая переменная {token} */
	Route::get('/pay/tariff/success/{token}', 'PayController@paySuccess')->name('pay.tariff.success');
	Route::get('/pay/tariff/fail', 'PayController@payFail')->name('pay.tariff.fail');
});


/* admin */
Route::group(['prefix' => 'admin', 'namespace' => 'admin'], function() {
	Route::match(['get', 'post'], '/login', 'AuthController@author')->name('admin.author');
	Route::group(['middleware' => 'isAdmin'], function() {
		Route::get('/', 'MainController@main')->name('admin.main');
		Route::get('/operations/{count}/{status}', 'MainController@getOperations')->name('admin.operations');
		Route::get('/search', 'SearchController@searchPage')->name('admin.search');
		Route::get('/search/result/{name}', 'SearchController@getResult')->name('admin.search.result');
		Route::get('/user-page/{id}', 'SearchController@getUserPage')->name('admin.get.user.page');
		Route::post('search/valid', 'SearchController@registrValidation')->name('admin.registr.valid');
		Route::delete('search/delete', 'SearchController@deleteUsers')->name('admin.user.delete');

		/*logout admin*/
		Route::get('/logout', 'AuthController@logout')->name('admin.logout');
	});
});




/* 404 */

Route::get('/404', function() {
	return "404 error";
})->name('404');