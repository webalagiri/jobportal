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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'common'], function()
{
   Route::group(['namespace' => 'Common'], function(){
      Route::get('rest/api/listgroups', array('as' => 'common.listgroups', 'uses' => 'CommonController@getListGroups'));
   });
});
