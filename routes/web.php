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
Route::get('/', function () {
   return view('welcome');
 });

// Route::get('/', [
//     'uses' => 'TransactionController@getIndex',
//      'as' => 'transact.index' 
//   ]);
  

//   Route::get('/customers', [
//    'uses' => 'CustomerController@getCustomers',
//     'as' => 'getCustomers',
//    //  'middleware' => 'role:customer',
//     'middleware' => 'auth'
//  ]);

// Route::get('/customer/edit/{id}', [
//     'uses' => 'CustomerController@edit',
//      'as' => 'customer.edit' 
//   ]);

//   Route::post('/customer/edit/{id}', [
//    'uses' => 'CustomerController@destroy',
//     'as' => 'customer.destroy' 
//  ]);
 
  Route::resource('customer', 'CustomerController');
  Route::post('/customer/import', 'CustomerController@import')->name('customer-import');
 



// Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
// // Route::get('/customer/create', [CustomerController::class, 'create'])->name('customers.create');
// // Route::post('/customer/store', [CustomerController::class, 'store'])->name('customers.store');
// Route::put('/customers/{id}/update', [CustomerController::class, 'update'])->name('customer.update');

// Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
// Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');

// Route::group(['middleware' => ['auth']], function () {
//    Route::resource('customer', 'CustomerController')->except(['index']);
 
//   });

  Route::group(['prefix' => 'user'], function(){
   Route::group(['middleware' => 'guest'], function() {
             Route::get('signup', [
             'uses' => 'UserController@getSignup',
             'as' => 'user.signups',
                 ]);
             Route::post('signup', [
                     'uses' => 'userController@postSignup',
                     'as' => 'user.signup',
                 ]);
             Route::get('signin', [
                     'uses' => 'userController@getSignin',
                     'as' => 'user.signins',
                  ]);
             Route::post('signin', [
                     'uses' => 'LoginController@postSignin',
                     'as' => 'user.signin',
                 ]);
         });
   
   Route::group(['middleware' => 'role:customer'], function() {

       Route::get('profile', [
             'uses' => 'UserController@getProfile',
             'as' => 'user.profile',
            //  'middleware' => 'role:customer'
          ]);
         });
     });

     Route::get('/customers', [
      'uses' => 'CustomerController@getCustomers',
       'as' => 'getCustomers',
       'middleware' => 'role:customer',
      //  'middleware' => 'auth'
    ]);
    //Route::resource('customer', 'CustomerController')->except(['index']);

   //  Route::resource('customer', 'CustomerController');


           
       Route::get('logout',[
          'uses' => 'LoginController@logout',
          'as' => 'user.logout',
          'middleware'=>'auth'
         ]);



   //     Route::get('add-to-cart/{id}',[
   //           'uses' => 'ProductController@getAddToCart',
   //           'as' => 'product.addToCart'
   //       ]);
   //     Route::get('shopping-cart', [
   //       'uses' => 'ProductController@getCart',
   //       'as' => 'product.shoppingCart',
   //       'middleware' =>'role:customer'
   //   ]);
   //     Route::get('checkout',[
   //           'uses' => 'productController@postCheckout',
   //           'as' => 'checkout',
   //           'middleware' =>'role:customer'
   //       ]);
   //     Route::get('reduce/{id}',[
   //           'uses' => 'productController@getReduceByOne',
   //           'as' => 'product.reduceByOne',
   //           'middleware' =>'role:customer'
   //       ]);
   //     Route::get('remove/{id}',[
   //           'uses'=>'productController@getRemoveItem',
   //           'as' => 'product.remove',
   //           'middleware' =>'role:customer'
   //       ]);
   //     Route::get('/dashboard',['uses'=>'DashboardController@index','as'=>'dashboard.index'])->middleware('role:admin');
       
   // Route::group(['middleware' => 'role:admin,encoder'], function() {
   //       Route::post('/import', 'ItemController@import')->name('item-import');
   //       Route::get('/export',[
   //           'uses'=>'ItemController@export',
   //           'as' => 'item.export'
   //       ]);
   //       Route::get('/get-item',[ 'uses'=>'ItemController@getItem','as' => 'item.getItem']);
   //       Route::resource('item', 'ItemController');
   //   });
   //       Route::get('logout',[
   //     'uses' => 'LoginController@logout',
   //     'as' => 'user.logout',
   //     'middleware'=>'auth'
   //    ]);
         Route::fallback(function () {
           return redirect()->back();
     });

     

  