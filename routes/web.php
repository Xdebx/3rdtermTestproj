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
// Route::get('/', function () {
//    return view('welcome');
//  });
Route::get('/', [
  'uses' => 'TransactionController@Index',
   'as' => 'transact.index',
   'middleware' => 'auth'
]);

 // option 1
  // Route::resource('customer', 'CustomerController');
  // Route::post('/customer/import', 'CustomerController@import')->name('customer-import');
// option 2

  // Route::get('/Admin/create','PetController@create')->name('admin.create');
  // Route::post('/Admin/store','PetController@store')->name('admin.store');

Route::resource('employee', 'EmployeeController');

  Route::get('/Customer/edit/{id}','CustomerController@edit')->name('customer.edit');
  Route::put('/Customer/update{id}',['uses' => 'CustomerController@update','as' => 'customer.update']); 
  Route::delete('/Customer/delete/{id}',['uses' => 'CustomerController@destroy','as' => 'customer.destroy']);
  Route::get('/customer/restore/{id}',['uses' => 'CustomerController@restore','as' => 'customer.restore']);
  Route::post('/customer/import', 'CustomerController@import')->name('customer-import');

  // Route::get('/Employee/edit/{id}','EmployeeController@edit')->name('employee.edit');
  // Route::get('/Employee/edit/{id}','EmployeeController@edit')->name('employee.edit');
  // Route::put('/Employee/update{id}',['uses' => 'EmployeeController@updateUser','as' => 'employee.update']); 
  // Route::delete('/Employee/delete/{id}',['uses' => 'EmployeeController@destroy','as' => 'employee.destroy']);
  Route::post('/employee/import', 'EmployeeController@import')->name('employee-import');


  Route::get('/Grooming/create','GroomingServiceController@create')->name('grooming.create');
  Route::post('/Grooming/store','GroomingServiceController@store')->name('grooming.store');
  Route::get('/Grooming/edit/{id}','GroomingServiceController@edit')->name('grooming.edit');
  Route::put('/Grooming/update{id}',['uses' => 'GroomingServiceController@update','as' => 'grooming.update']);
  Route::delete('/Grooming/delete/{id}',['uses' => 'GroomingServiceController@destroy','as' => 'grooming.destroy']);
  Route::post('/Grooming/import', 'GroomingServiceController@import')->name('grooming-import');


  Route::get('/Pet/create','PetController@create')->name('pet.create');
  Route::post('/Pet/store','PetController@store')->name('pet.store');
  Route::get('/Pet/edit/{id}','PetController@edit')->name('pet.edit')->middleware('role:admin');
  Route::put('/Pet/update{id}',['uses' => 'PetController@update','as' => 'pet.update']);
  Route::delete('/Pet/delete/{id}',['uses' => 'PetController@destroy','as' => 'pet.destroy'])->middleware('role:admin');
  Route::post('/Pet/import', 'PetController@import')->name('pet-import');


Route::get('/Consult/create','ConsultationController@create')->name('consult.create');
Route::post('/Consult/store','ConsultationController@store')->name('consult.store');
Route::get('/Consult/edit/{id}','ConsultationController@edit')->name('consult.edit');
Route::put('/Consult/update{id}',['uses' => 'ConsultationController@update','as' => 'consult.update']);
Route::delete('/Consult/delete/{id}',['uses' => 'ConsultationController@destroy','as' => 'consult.destroy']);


Route::get('/Transact/edit/{id}','TransactionController@edit')->name('transacts.edit');
Route::put('/Transact/update{id}',['uses' => 'TransactionController@update','as' => 'transacts.update']);
Route::delete('/Transact/delete/{id}',['uses' => 'TransactionController@destroy','as' => 'transacts.destroy']);



  Route::group(['prefix' => 'user'], function(){
   Route::group(['middleware' => 'guest'], function() {
             Route::get('signup', [
             'uses' => 'UserController@getSignup',
             'as' => 'user.signups',
                 ]);
             Route::post('signup', [
                     'uses' => 'UserController@postSignup',
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

                 Route::get('esignup', [
                  'uses' => 'UserController@getEsignup',
                  'as' => 'user.esignups',
                      ]);

                 Route::post('esignup', [
                        'uses' => 'UserController@postEsignup',
                        'as' => 'user.esignup',
                    ]);

                    Route::get('asignup', [
                      'uses' => 'UserController@getAsignup',
                      'as' => 'user.asignups',
                          ]);
    
                     Route::post('asignup', [
                            'uses' => 'UserController@postAdminSignup',
                            'as' => 'user.asignup',
                        ]);

         });
   
   Route::group(['middleware' => 'role:customer,admin,employee'], function() {
       Route::get('profile', [
             'uses' => 'UserController@getProfile',
             'as' => 'user.profile',
          ]);
       Route::get('eprofile', [
            'uses' => 'UserController@getEprofile',
            'as' => 'user.eprofile',
         ]);
         Route::get('aprofile', [
          'uses' => 'UserController@getAprofile',
          'as' => 'user.aprofile',
       ]);
        });  
     });

   Route::get('/customers', [
      'uses' => 'CustomerController@getCustomers',
       'as' => 'getCustomers',
       'middleware' => 'role:admin',
    ]);

    Route::get('/transacts', [
      'uses' => 'TransactionController@getTransacts',
       'as' => 'getTransacts',
       'middleware' => 'role:employee',
    ]);

    Route::get('/employees', [
      'uses' => 'EmployeeController@getEmployees',
       'as' => 'getEmployees',
       'middleware' => 'role:admin',
 
    ]);

    Route::get('/grooming', [
      'uses' => 'GroomingServiceController@getGroomingServices',
       'as' => 'getGroomingServices',
       'middleware' => 'role:admin',   ]);

    Route::get('/pets', [
      'uses' => 'PetController@getPets',
        'as' => 'getPets',
        'middleware' => 'role:admin',   ]);

    Route::get('/consults', [
         'uses' => 'ConsultationController@getConsults',
           'as' => 'getConsults',
           'middleware' => 'role:employee',   ]);

        
     Route::get('logout',[
          'uses' => 'LoginController@logout',
          'as' => 'user.logout',
          'middleware'=>'auth'
         ]);

     Route::get('/dashboard',['uses'=>'DashboardController@index','as'=>'dashboard.index'])->middleware('role:admin');


// Route::resource('transact', 'TransactionController');


Route::get('add-to-cart/{id}', [
    'uses' => 'TransactionController@getAddToCart',
    'as' => 'service.addToCart'
]);

Route::get('shopping-cart', [
    'uses' => 'TransactionController@getCart',
    'as' => 'service.shoppingCart',
    'middleware' => 'role:customer'
]);

Route::get('remove/{id}',[
        'uses'=>'TransactionController@getRemoveItem',
        'as' => 'service.remove'
    ]);

Route::post('checkout',[
        'uses' => 'TransactionController@storeCheckout',
        'as' => 'service.checkout',
        'middleware' =>'role:customer'
    ]);
// Route::get('/search', [
//         'uses' => 'TransactionController@search',
//         'as' => 'service.searchingindex']);


       Route::get('logout',[
       'uses' => 'LoginController@logout',
       'as' => 'user.logout',
       'middleware'=>'auth'
      ]);

         Route::fallback(function () {
           return redirect()->back();
     });

     

  