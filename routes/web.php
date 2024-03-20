<?php

use App\Http\Controllers\Auctions\AuctionReactionController;
use App\Http\Controllers\Auctions\BidController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Products\CategoryController;
use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\User\Admin\AdminController;
use App\Http\Controllers\User\Bidder\BidderController;
use App\Http\Controllers\User\Owner\OwnerController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auctions\AuctionController;


use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
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

Route::get('/', [HomeController::class, 'welcome'])->name('home');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');


Route::middleware(['auth'])->group(function () {

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('change.password');
    Route::get('/auctions-explore', [AuctionController::class, 'showAuctionsExplore'])->name('auctionsExplore');
    Route::get('/auctions/{id}', [AuctionController::class, 'show'])->name('product.details');
    Route::post('/auctions/{auction}/react', [AuctionReactionController::class, 'toggle'])->name('auctions.react');
    Route::post('/place-bid', [BidController::class, 'store'])->name('bid.place');

    // Admin routes
    Route::middleware(['admin'])->group(function () {
        // Dashboard
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

        // Profile Management
        Route::get('/admin/profile', [AdminController::class, 'profile'])->name('profile');
        Route::get('/admin/profile/edit', [AdminController::class, 'profileEdit'])->name('admin.profile.edit');

        // Search Functionality
        Route::get('/admin/search', [AdminController::class, 'search'])->name('search');

        // Category Management
        Route::get('/admin/categories', [AdminController::class, 'categories'])->name('admin.categories');
        Route::post('/admin/category/create', [CategoryController::class, 'createCategory'])->name('admin.category.create');
        Route::post('/admin/category/edit/{id}', [CategoryController::class, 'editCategory'])->name('admin.category.edit');
        Route::delete('/admin/category/destroy/{id}', [CategoryController::class, 'destroyCategory'])->name('admin.category.destroy');

        // Auction Management
        Route::get('/admin/auctions', [AdminController::class, 'auctions'])->name('admin.auctions');
        Route::post('/admin/auctions/{auction}/accept', [AuctionController::class, 'accept'])->name('admin.auctions.accept');
        Route::post('/admin/auctions/{auction}/reject', [AuctionController::class, 'reject'])->name('admin.auctions.reject');

        // Bid Management
        Route::get('/admin/bids', [AdminController::class, 'bids'])->name('admin.bids');

        // Product Management
        Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products');
        Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create'); // Ensure this controller action exists

        // User Management
        Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/users/store', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update'); // Ensure this is the correct method name
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

        // User Status Management
        Route::post('/admin/users/{user}/ban', [UserController::class, 'ban'])->name('admin.users.ban');
        Route::post('/admin/users/{user}/unban', [UserController::class, 'unban'])->name('admin.users.unban');

    });


// Bidder routes
    Route::middleware(['bidder'])->group(function () {
        Route::get('/bidder-profile', [BidderController::class, 'index'])->name('bidderProfile');
        Route::get('/bidder/profile/edit', [BidderController::class, 'profileEdit'])->name('bidder.profile.edit');
    });

// Owner routes
    Route::middleware(['owner'])->group(function () {
        Route::get('/owner-profile', [OwnerController::class, 'index'])->name('ownerProfile');
        Route::get('/owner/auction/create', [AuctionController::class, 'create'])->name('owner.auction.auctionCreate');
        Route::post('/owner/auction/submit', [OwnerController::class, 'storeAuction'])->name('owner.auction.submit');
        Route::get('/owner/profile/edit', [OwnerController::class, 'profileEdit'])->name('owner.profile.edit');
    });

});
