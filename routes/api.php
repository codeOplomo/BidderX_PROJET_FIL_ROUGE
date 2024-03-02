<?php


use App\Http\Controllers\AuctionController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\GeoLocation\AddressController;
use App\Http\Controllers\Messaging\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Products\CommentController;
use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\Products\ProductRatingController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



// User Authentication
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

    //Geo location
    Route::get('/geo/countries', [AddressController::class, 'getCountries']);
    Route::get('/geo/cities/{countryCode}', [AddressController::class, 'getCities']);
// Protected routes
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    // User profile
    Route::get('/user/profile', [UserController::class, 'profile']);


    // Auctions
    Route::apiResource('/auctions', AuctionController::class);
    Route::post('/auctions/{auction}/bids', [BidController::class, 'store']);

    // Products
    Route::apiResource('/products', ProductController::class);
    Route::post('/products/{product}/ratings', [ProductRatingController::class, 'store']);
    Route::apiResource('/products/{product}/comments', CommentController::class);

    // Messages
    Route::apiResource('/messages', MessageController::class);

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index']);
});
