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
Route::get('/blogedit/{id}', 'PostsController@edit');
Route::get('/blogdelete/{id}', 'PostsController@delete');
Route::resource('/posts', 'PostsController');

Route::resource('/inventory', 'InventoryController');

Route::resource('/store', 'StoreController');
Route::get('/addToCart/{id}', 'StoreController@storeCart');
Route::get('/removeItem/{id}', 'StoreController@removeItem');
Route::get('/getCart', 'StoreController@getCart');
Route::get('/checkout', 'StoreController@getCheckout');

//Stripe Checkouts route
Route::post('/chargeCheckout/{total}', 'TransactionsController@getChargeCheckout');
//Stripe Elements route
Route::post('/chargeElements/{total}', 'TransactionsController@getChargeElements');
Route::get('/transactionStore/{data}', 'TransactionsController@storeTransaction');
Route::resource('/transactions', 'TransactionsController');

Auth::routes();
Route::get('/dashboard', 'DashboardController@index');



//Route::post('/checkout', function(Request $request){
   // dd($request->all());
//});
Route::post('/task', function (Request $request) {
   //
   $validator = Validator::make($request->all(), [
       // Do not allow any shady characters
       'names' => 'required|max:255|regex:[A-Za-z1-9 ]',
   ]);
   if ($validator->fails()) {
       return redirect('/')
       ->withInput()
       ->withErrors($validator);
   }
   $task = new Task;
   $task->names = $request->names;
   $task->save();
   return redirect('/');
});