<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\AdminController;

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

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/', function () {
//    return redirect()->route('frontend.index');
//});

//Route::get('/main', function (){
//    return view('main');
//});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
//    ->name('home');


//admin routes
Route::get('/admin/create', [App\Http\Controllers\backend\AdminController::class, 'create'])
    ->name('admin.create');
Route::post('/admin', [App\Http\Controllers\backend\AdminController::class, 'store'])
    ->name('admin.store');
Route::get('/admin', [App\Http\Controllers\backend\AdminController::class, 'index'])
    ->name('admin.index');


//category routes
Route::get('/category/create', [App\Http\Controllers\backend\CategoryController::class, 'create'])
    ->name('category.create');
Route::post('/category', [App\Http\Controllers\backend\CategoryController::class, 'store'])
    ->name('category.store');
Route::get('/category/{id}/edit', [App\Http\Controllers\backend\CategoryController::class, 'edit'])
    ->name('category.edit');
Route::put('/category/{id}', [App\Http\Controllers\backend\CategoryController::class, 'update'])
    ->name('category.update');
Route::get('/category', [App\Http\Controllers\backend\CategoryController::class, 'index'])
    ->name('category.index');

//product routes
Route::get('/product/create', [App\Http\Controllers\backend\ProductController::class, 'create'])
    ->name('product.create');
Route::post('/product', [App\Http\Controllers\backend\ProductController::class, 'store'])
    ->name('product.store');
Route::get('/product/{id}/edit', [App\Http\Controllers\backend\ProductController::class, 'edit'])
    ->name('product.edit');
Route::put('/product/{id}/u', [App\Http\Controllers\backend\ProductController::class, 'update'])
    ->name('product.update');
Route::get('/product/{id}/add', [App\Http\Controllers\backend\ProductController::class, 'add'])
    ->name('product.add');
Route::put('/product/{id}/i', [App\Http\Controllers\backend\ProductController::class, 'insert'])
    ->name('product.insert');
Route::get('/{id}/product', [App\Http\Controllers\backend\ProductController::class, 'index'])
    ->name('product.index');

//cart routes
Route::get('/cart', [App\Http\Controllers\frontend\MainController::class, 'view'])
    ->name('cart.view');
Route::post('/add', [App\Http\Controllers\frontend\MainController::class, 'add'])
    ->name('cart.add');
Route::post('/remove', [App\Http\Controllers\frontend\MainController::class, 'remove'])
    ->name('cart.remove');


//stripe
Route::get('stripe', [\App\Http\Controllers\StripePaymentController::class, 'stripe'])
    ->name('stripe');
Route::post('stripeload', [\App\Http\Controllers\StripePaymentController::class, 'stripeload'])
    ->name('stripe.load');
Route::post('stripe', [\App\Http\Controllers\StripePaymentController::class, 'stripePost'])
    ->name('stripe.post');

Route::get('/home', [App\Http\Controllers\frontend\MainController::class, 'redir']);

//frontend routes
Route::get('/{id}', [App\Http\Controllers\frontend\MainController::class, 'index'])
    ->name('frontend.index');

Route::get('/', [App\Http\Controllers\frontend\MainController::class, 'redir']);

