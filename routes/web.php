<?php
use Illuminate\http\Request;
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

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');

Route::get('/blogview', 'PostsController@index');
Route::get('/blogedit/{id}', 'PostsController@editBlog');
Route::get('/blogdelete/{id}', 'PostsController@delete');
Route::resource('/posts', 'PostsController');

Route::resource('/inventory', 'InventoryController');

Route::get('/test', 'StoreController@test');

Route::get('/addToCart/{id}', 'StoreController@storeCart');
Route::get('/removeItem/{id}', 'StoreController@removeItem');
Route::get('/getCart', 'StoreController@getCart');
Route::get('/checkout', 'StoreController@getCheckout');
Route::resource('/store', 'StoreController');
Route::post('/charge/{total}', 'StoreController@getCharge');
Route::post('/checkout', function(Request $request){
    dd($request->all());
});
Route::resource('/transactions', 'TransactionsController');

Auth::routes();
Route::get('/dashboard', 'DashboardController@index');
