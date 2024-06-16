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

$controller_path = 'App\Http\Controllers';

// Main Page Route

// pages

Route::get('/public', function (Request $request) {
    dd("Hola!!!");
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    $controller_path = 'App\Http\Controllers';

    Route::get('/', $controller_path . '\pages\HomePage@index')->name('pages-home');


    Route::get('/home/pendingdebts/', $controller_path . '\pages\homepage@pendingdebts')->name('pages-homepage-pendingdebts');
    Route::get('/home/paiddebts/', $controller_path . '\pages\homepage@paiddebts')->name('pages-homepage-paiddebts');

    //Communities
    Route::get('/communities', $controller_path . '\pages\communities@index')->name('pages-communities');
    Route::get('/communities/create/', $controller_path . '\pages\communities@create')->name('pages-communities-create');
    Route::post('/communities/setactive', $controller_path . '\pages\communities@setActive')->name('pages-communities-setactive');
    Route::post('/communities/store/', $controller_path . '\pages\communities@store')->name('pages-communities-store');

    Route::get('/communities/show/{community_id}', $controller_path . '\pages\communities@show')->name('pages-communities-show');
    Route::post('/communities/update', $controller_path . '\pages\communities@update')->name('pages-communities-update');

    Route::get('/communities/destroy/{community_id}', $controller_path . '\pages\communities@destroy')->name('pages-communities-destroy');


    //Properties
    Route::get('/properties', $controller_path . '\pages\properties@index')->name('pages-properties');
    Route::get('/properties/create/', $controller_path . '\pages\properties@create')->name('pages-properties-create');
    Route::post('/properties/store/', $controller_path . '\pages\properties@store')->name('pages-properties-store');

    Route::get('/properties/show/{property_id}', $controller_path . '\pages\properties@show')->name('pages-properties-show');
    Route::post('/properties/update', $controller_path . '\pages\properties@update')->name('pages-properties-update');

    Route::get('/properties/destroy/{property_id}', $controller_path . '\pages\properties@destroy')->name('pages-properties-destroy');


    //Neihgbors
    Route::get('/neighbors', $controller_path . '\pages\neighbors@index')->name('pages-neighbors');
    Route::get('/neighbors/create/', $controller_path . '\pages\neighbors@create')->name('pages-neighbors-create');
    Route::post('/neighbors/store/', $controller_path . '\pages\neighbors@store')->name('pages-neighbors-store');

    Route::get('/neighbors/show/{neighbor_id}', $controller_path . '\pages\neighbors@show')->name('pages-neighbors-show');
    Route::post('/neighbors/update', $controller_path . '\pages\neighbors@update')->name('pages-neighbors-update');

    Route::get('/neighbors/destroy/{neighbor_id}', $controller_path . '\pages\neighbors@destroy')->name('pages-neighbors-destroy');

    //debts
    Route::get('/debts', $controller_path . '\pages\debts@index')->name('pages-debts');
    Route::get('/debts/create/', $controller_path . '\pages\debts@create')->name('pages-debts-create');
    Route::get('/debts/createglobal/', $controller_path . '\pages\debts@createglobal')->name('pages-debts-createglobal');
    Route::post('/debts/store/', $controller_path . '\pages\debts@store')->name('pages-debts-store');

    Route::get('/debts/show/{debts}', $controller_path . '\pages\debts@show')->name('pages-debts-show');
    Route::post('/debts/update', $controller_path . '\pages\debts@update')->name('pages-debts-update');

    Route::get('/debts/pay/{debts}', $controller_path . '\pages\debts@pay')->name('pages-debts-pay');
    Route::get('/debts/reopen/{debts}', $controller_path . '\pages\debts@reopen')->name('pages-debts-reopen');
    Route::get('/debts/destroy/{debts}', $controller_path . '\pages\debts@destroy')->name('pages-debts-destroy');
    Route::get('/debts/export/', $controller_path . '\pages\debts@export')->name('pages-debts-export');


    //Property Statuses
    Route::get('/propertystatuses', $controller_path . '\pages\propertystatuses@index')->name('pages-propertystatuses');
    Route::get('/propertystatuses/create/', $controller_path . '\pages\propertystatuses@create')->name('pages-propertystatuses-create');
    Route::post('/propertystatuses/store/', $controller_path . '\pages\propertystatuses@store')->name('pages-propertystatuses-store');

    Route::get('/propertystatuses/show/{propertystatus_id}', $controller_path . '\pages\propertystatuses@show')->name('pages-propertystatuses-show');
    Route::post('/propertystatuses/update', $controller_path . '\pages\propertystatuses@update')->name('pages-propertystatuses-update');

    Route::get('/propertystatuses/destroy/{propertystatus_id}', $controller_path . '\pages\propertystatuses@destroy')->name('pages-propertystatuses-destroy');





});
