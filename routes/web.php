
<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your applicatio;;n. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (){
    return view('auth.login');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Users Route //
Route::group(['as'=>'users.','prefix'=>'users', 'namespace'=>'Backend', 'middleware'=>'checkvalidUsers'], function(){
	Route::get('/view', 'usersController@view')->name('view');
	Route::get('/add', 'usersController@add')->name('add');
	Route::post('/store', 'usersController@store')->name('store');
	Route::get('/edit/{id}', 'usersController@edit')->name('edit');
	Route::post('/update/{id}', 'usersController@update')->name('update');
	Route::get('/delete/{id}', 'usersController@delete')->name('delete');
	// password Update
	Route::get('/password/view', 'usersController@passwordView')->name('password.view');
	Route::post('/password/update', 'usersController@passwordUpdate')->name('password.update');
});
// Supplier Route //
Route::group(['as'=>'supplier.', 'prefix'=>'supplier','namespace'=>'Backend','middleware'=>'checkvalidUsers'], function(){
   Route::get('/view','supplierController@view')->name('view');
   Route::get('/add','supplierController@add')->name('add');	
   Route::post('/store','supplierController@store')->name('store');
   Route::get('/edit/{id}','supplierController@edit')->name('edit');
   Route::post('/update/{id}','supplierController@update')->name('update');
   Route::get('/delete/{id}','supplierController@delete')->name('delete');
});
// Customers Route //
Route::group(['as'=>'customer.', 'prefix'=>'customer','namespace'=>'Backend','middleware'=>'checkvalidUsers'], function(){
   Route::get('/view','customerController@view')->name('view');
   Route::get('/add','customerController@add')->name('add');	
   Route::post('/store','customerController@store')->name('store');
   Route::get('/edit/{id}','customerController@edit')->name('edit');
   Route::post('/update/{id}','customerController@update')->name('update');
   Route::get('/delete/{id}','customerController@delete')->name('delete');
   Route::get('/credit','customerController@customerCredit')->name('credit');
   Route::get('/credit/pdf','customerController@customerCreditPdf')->name('credit.pdf');
   Route::get('/credit/edit/{invoice_id}', 'customerController@customerCreditEdit')->name('credit.edit');
   Route::post('/credit/update/{invoice_id}', 'customerController@customerCreditUpdate')->name('credit.update');
   Route::get('/credit/summery/pdf/{invoice_id}', 'customerController@customerCreditSummery')->name('credit.summery');
   Route::get('/paid/list','customerController@customerPaidList')->name('paid.list');
   Route::get('/paid/list/pdf','customerController@customerPaidListPdf')->name('paid.list.pdf');
   Route::get('/wais/report','customerController@customerWaisReport')->name('wais.report');
   Route::get('/credit/wais/pdf','customerController@customerCreditWaisPdf')->name('credit.wais.pdf');
   Route::get('/paid/wais/pdf','customerController@customerPaidWaisPdf')->name('paid.wais.pdf');
});
// Unit Route //
Route::group(['as'=>'unit.', 'prefix'=>'unit','namespace'=>'Backend','middleware'=>'checkvalidUsers'], function(){
   Route::get('/view','unitController@view')->name('view');
   Route::get('/add','unitController@add')->name('add');	
   Route::post('/store','unitController@store')->name('store');
   Route::get('/edit/{id}','unitController@edit')->name('edit');
   Route::put('/update/{id}','unitController@update')->name('update');
   Route::get('/delete/{id}','unitController@delete')->name('delete');
});
// Category Route //
Route::group(['as'=>'category.', 'prefix'=>'category','namespace'=>'Backend','middleware'=>'checkvalidUsers'], function(){
   Route::get('/view','categoryController@view')->name('view');
   Route::get('/add','categoryController@add')->name('add');	
   Route::post('/store','categoryController@store')->name('store');
   Route::get('/edit/{id}','categoryController@edit')->name('edit');
   Route::post('/update/{id}','categoryController@update')->name('update');
   Route::get('/delete/{id}','categoryController@delete')->name('delete');
   Route::get('/single/{id}','categoryController@single')->name('single');
});
// Products Route //
Route::group(['as'=>'products.', 'prefix'=>'products','namespace'=>'Backend','middleware'=>'checkvalidUsers'], function(){
   Route::get('/view','productController@view')->name('view');
   Route::get('/add','productController@add')->name('add');	
   Route::post('/store','productController@store')->name('store');
   Route::get('/edit/{id}','productController@edit')->name('edit');
   Route::post('/update/{id}','productController@update')->name('update');
   Route::get('/delete/{id}','productController@delete')->name('delete');
});
// Purchase Route //
Route::group(['as'=>'purchase.', 'prefix'=>'purchase','namespace'=>'Backend','middleware'=>'checkvalidUsers'], function(){
   Route::get('/view','purchaseController@view')->name('view');
   Route::get('/add','purchaseController@add')->name('add'); 
   Route::post('/store','purchaseController@store')->name('store');
   Route::get('/pending','purchaseController@pendingList')->name('pending.list');
   Route::get('/approve/{id}','purchaseController@approve')->name('approve');
   Route::get('/delete/{id}','purchaseController@delete')->name('delete');
   Route::get('/report','purchaseController@purchaseReport')->name('report');
   Route::get('/report/pdf','purchaseController@purchaseReportpdf')->name('report.pdf');
});
// Default Route //
Route::get('/getcategory', 'Backend\DefaultController@getCategory')->name('get.category');
Route::get('/getproduct', 'Backend\DefaultController@getProduct')->name('get.product');
Route::get('/getInvoiceCategory', 'Backend\DefaultController@getInvoiceCategory')->name('get.invoice.category');
Route::get('/get/Product/Quantity', 'Backend\DefaultController@getProductQuantity')->name('get.product.quantity');
Route::get('/get/productwais/stock', 'Backend\DefaultController@getProductWaisReport')->name('get.product.wais.report');
// Invocie Route //
Route::group(['as'=>'invoice.', 'prefix'=>'invoice','namespace'=>'Backend','middleware'=>'checkvalidUsers'], function(){
   Route::get('/view','invoiceController@view')->name('view');
   Route::get('/add','invoiceController@add')->name('add'); 
   Route::post('/store','invoiceController@store')->name('store');
   Route::get('/pending','invoiceController@pendingList')->name('pending.list');
   Route::get('/approve/{id}','invoiceController@approve')->name('approve');
   Route::get('/delete/{id}','invoiceController@delete')->name('delete');
   Route::post('/approve/process/{id}','invoiceController@approveprocesses')->name('approve.process');
   Route::get('/print/list', 'invoiceController@printList')->name('print.list');
   Route::get('/print/{id}', 'invoiceController@print')->name('print');
   Route::get('/daily', 'invoiceController@DailyInvoice')->name('daily');
   Route::get('/daily/print', 'invoiceController@DailyInvoicePrint')->name('daily.print');
});
// Stock Route //
Route::group(['as'=>'stock.', 'prefix'=>'stock','namespace'=>'Backend','middleware'=>'checkvalidUsers'], function(){
   Route::get('/report','stockController@stockReport')->name('report');
   Route::get('/report/pdf','stockController@stockReportPdf')->name('report.pdf');
   Route::get('/supplier/product/wais','stockController@supplierProductWais')->name('supplier.product.report');  
   Route::get('/supplier/wais/pdf','stockController@supplierProductWaisPdf')->name('supplier.product.report.pdf');
   Route::get('/product/wais/pdf', 'stockController@productWaisPdf')->name('product.wais.pdf');  
});
