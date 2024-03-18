<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\Products\CategoryController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\User\Admin\AdminController;
use App\Http\Controllers\User\Bidder\BidderController;
use App\Http\Controllers\User\Owner\OwnerController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auctions\AuctionController;

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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');


Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');



Route::middleware(['auth'])->group(function () {
    Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('change.password');



    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/search', [AdminController::class, 'search'])->name('search');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('profile');

    Route::get('/admin/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::get('/admin/auctions', [AdminController::class, 'auctions'])->name('admin.auctions');
    Route::post('/admin/auctions/{auction}/accept', [AuctionController::class, 'accept'])->name('admin.auctions.accept');
    Route::post('/admin/auctions/{auction}/reject', [AuctionController::class, 'reject'])->name('admin.auctions.reject');
    Route::get('/admin/bids', [AdminController::class, 'bids'])->name('admin.bids');
    Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/admin/products/create', 'ProductController@create')->name('admin.products.create');

    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');

    Route::post('/admin/category/edit/{id}', [CategoryController::class, 'editCategory'])->name('admin.category.edit');
    Route::delete('/admin/category/destroy/{id}', [CategoryController::class, 'destroyCategory'])->name('admin.category.destroy');
    Route::post('/admin/category/create', [CategoryController::class, 'createCategory'])->name('admin.category.create');

    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [UserController::class, 'userUpdate'])->name('admin.users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::post('/admin/users/{user}/ban', [UserController::class, 'ban'])->name('admin.users.ban');
    Route::post('/admin/users/{user}/unban', [UserController::class, 'unban'])->name('admin.users.unban');

    Route::get('/admin/profile/edit', [AdminController::class, 'profileEdit'])->name('admin.profile.edit');


    Route::get('/owner-profile', [OwnerController::class, 'index'])->name('ownerProfile');
    Route::get('/owner/auction/create', [AuctionController::class, 'create'])->name('owner.auction.auctionCreate');
    Route::post('/owner/auction/submit', [OwnerController::class, 'storeAuction'])->name('owner.auction.submit');
    Route::get('/owner/profile/edit', [OwnerController::class, 'profileEdit'])->name('owner.profile.edit');



    Route::get('/bidder-profile', [BidderController::class, 'index'])->name('bidderProfile');
    Route::get('/bidder/profile/edit', [BidderController::class, 'profileEdit'])->name('bidder.profile.edit');

});
