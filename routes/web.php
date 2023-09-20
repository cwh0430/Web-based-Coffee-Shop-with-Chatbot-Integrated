<?php

use App\Http\Controllers\GuidingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RateReviewController;
use App\Models\ProductCart;
use App\Models\RecipeGuide;
use App\Http\Controllers\Auth\LoginController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BeverageController;
use App\Http\Controllers\MechanicController;
use App\Http\Controllers\EmbeddingController;
use App\Http\Controllers\ProductCartController;
use App\Http\Controllers\BeverageCartController;
use App\Http\Controllers\HomebrewProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('login', [Auth\LoginController::class,'showLoginForm'])->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
Route::get('/', function () {
    return view('homepage');
});

Route::get('/showexample', function () {
    return view('products.showexample');
});

Auth::routes();

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/beveragelist', [BeverageController::class, 'index'])->name('beveragelist');
Route::get('/homebrewproductlist', [HomebrewProductController::class, 'index'])->name('homebrewproductlist');
Route::get('/mechaniclist', [MechanicController::class, 'index'])->name('mechaniclist');

Route::get("/showbeverage/{id}", [BeverageController::class, 'show']);
Route::get("/showhomebrewproduct/{id}", [HomebrewProductController::class, 'show']);
Route::get("/showmechanic/{id}", [MechanicController::class, 'show']);


Route::get("/beveragecart", [BeverageCartController::class, 'getBeverageCart']);
Route::get("/productcart", [ProductCartController::class, 'getProductCart']);

Route::get("/getbeveragecartmodal", [BeverageCartController::class, 'getBeverageCartModal']);
Route::post("/addbeveragecart", [BeverageCartController::class, 'addToBeverageCart']);
Route::post("/updatebeveragecart", [BeverageCartController::class, 'updateBeverageCart']);
Route::post("/deletebeveragecart/{id}", [BeverageCartController::class, 'deleteBeverageCart']);

Route::get('getproductcartmodal', [ProductCartController::class, 'getProductCartModal']);
Route::post("/addproductcart", [ProductCartController::class, 'addProductCart']);
Route::post("/updateproductcart", [ProductCartController::class, 'updateProductCart']);
Route::post("/deleteproductcart/{id}", [ProductCartController::class, 'deleteProductCart']);

//stripe beverage payment

Route::post("/checkout", [PaymentController::class, 'checkout'])->name('checkout');
Route::get("/success", [PaymentController::class, 'success'])->name('checkout.success');
Route::get("/cancel", [PaymentController::class, 'cancel'])->name('checkout.cancel');
//stripe webhook
//Route::post('/webhook/stripe', [PaymentController::class, 'webhook']);

Route::post('/embeddings', [EmbeddingController::class, 'store']);

Route::get('/guide', [GuidingController::class, 'index']);

Route::get('/recipedetail/{id}', [GuidingController::class, 'recipeShow']);
Route::get('/brewdetail/{id}', [GuidingController::class, 'brewShow']);

Route::get('/orders', [OrderController::class, 'index'])->middleware('auth');

Route::post('/review', [RateReviewController::class, 'store'])->name('review.store');