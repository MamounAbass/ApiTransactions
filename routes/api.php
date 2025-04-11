<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\Buyer\BuyerCategoryController;
use App\Http\Controllers\Buyer\BuyerProductController;
use App\Http\Controllers\Buyer\BuyerSellerController;
use App\Http\Controllers\Buyer\BuyerTransactionController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Seller\SellerCategoryController;
use App\Http\Controllers\Seller\SellerTransactionController;
use App\Http\Controllers\Seller\SellerBuyerController;
use App\Http\Controllers\Seller\SellerProductController;
use App\Http\Controllers\Transaction\TransactionController;
use App\Http\Controllers\Transaction\TransactionCategoryController;
use App\Http\Controllers\Transaction\TransactionSellerController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\ProductBuyerController;
use App\Http\Controllers\Product\ProductCategoryController;
use App\Http\Controllers\Product\ProductTransactionController;
use App\Http\Controllers\Product\ProductBuyerTransactionController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Category\CategoryProductController;
use App\Http\Controllers\Category\CategorySellerController;
use App\Http\Controllers\Category\CategoryTransactionController;
use App\Http\Controllers\Category\CategoryBuyerController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


/*
* users Resorces 
*/
Route::resource('Users',UserController::class ,['except'=>['create','edit']]);
/*
* Buyers Resorces 
*/
Route::resource('Buyers',BuyerController::class ,['only'=>['index','show']]);
Route::resource('Buyers.Sellers',BuyerSellerController::class ,['only'=>['index']]);
Route::resource('Buyers.Products',BuyerProductController::class ,['only'=>['index']]);
Route::resource('Buyers.Categories',BuyerCategoryController::class ,['only'=>['index']]);
Route::resource('Buyers.Transactions',BuyerTransactionController::class ,['only'=>['index']]);


/*
* Sellers Resorces 
*/
Route::resource('Sellers',SellerController::class ,['only'=>['index','show']]);
Route::resource('Sellers.Buyers',SellerBuyerController::class ,['only'=>['index']]);
Route::resource('Sellers.Products',SellerProductController::class ,['except'=>['show','create','edit']]);
Route::resource('Sellers.Categories',SellerCategoryController::class ,['only'=>['index']]);
Route::resource('Sellers.Transactions',SellerTransactionController::class ,['only'=>['index']]);

/*
* Transations Resorces 
*/
Route::resource('Transactions',TransactionController::class ,['only'=>['index','show']]);
Route::resource('Transactions.Sellers',TransactionSellerController::class ,['only'=>['index']]);
Route::resource('Transactions.Categories',TransactionCategoryController::class ,['only'=>['index']]);

/*
* Product Resorces 
*/
Route::resource('Products',ProductController::class ,['only'=>['index','show']]);
Route::resource('Products.Buyer',ProductBuyerController::class ,['only'=>['index']]);
Route::resource('Products.Transactions',ProductTransactionController::class ,['only'=>['index']]);
Route::resource('Products.Categories',ProductCategoryController::class ,['only'=>['index','update','destroy']]);
Route::resource('Products.Buyer.Transaction',ProductBuyerTransactionController::class ,['only'=>['store']]);
/*
* Categories Resorces 
*/
Route::resource('Categories',CategoryController::class ,['except'=>['create','edit']]);
Route::resource('Categories.Buyers',CategoryBuyerController::class ,['only'=>['index']]);
Route::resource('Categories.Sellers',CategorySellerController::class ,['only'=>['index']]);
Route::resource('Categories.Products',CategoryProductController::class ,['only'=>['index']]);
Route::resource('Categories.Transactions',CategoryTransactionController::class ,['only'=>['index']]);



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
