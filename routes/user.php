<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\User\BlogController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\CourseController;
use App\Http\Controllers\User\ProfileController;

Route::group( [ 'prefix' => 'user', 'middleware' => 'user' ], function() {
    // User Home
    Route::get('home', [ UserController::class, 'userHome' ])->name('user#home');

    // Profile
    Route::group( [ 'prefix' => 'profile' ], function() {
        // Profile Page
        Route::get('page', [ ProfileController::class, 'page' ])->name('user#profile#page');

        // Profile Edit Page
        Route::get('edit/page', [ ProfileController::class, 'editPage' ])->name('user#profile#edit#page');

        // Profile Edit
        Route::post('edit', [ ProfileController::class, 'edit' ])->name('user#profile#edit');

        // Change Password Page
        Route::get('changePassword/page', [ ProfileController::class, 'changePasswordPage' ])->name('user#profile#changePassword#page');

        // Change Password
        Route::post('changePassword', [ ProfileController::class, 'changePassword' ])->name('user#profile#changePassword');
    } );

    // Lesson Course
    Route::group( [ 'prefix' => 'course' ], function() {
        // Lesson Course List
        Route::get('list', [ CourseController::class, 'list' ])->name('user#course#list');

        // Lesson Course Detail
        Route::get('detail/{id}', [ CourseController::class, 'detail' ])->name('user#course#detail');


    } );

    // Lesson Blog
    Route::group( [ 'prefix' => 'blog' ], function() {
        // Lesson Blog List
        Route::get('list',  [ BlogController::class, 'list' ])->name('user#blog#list');

        // Lesson Blog Detail
        Route::get('detail/{id}', [ BlogController::class, 'detail' ])->name('user#blog#detail');
    } );

    // Cart
    Route::group( [ 'prefix' => 'cart' ], function() {
        // Cart List
        Route::get('list', [ CartController::class, 'list' ])->name('user#cart#list');

        // Save To Cart
        Route::post('/saveToCart/{lesson}', [ CartController::class, 'saveToCart' ])->name('user#blog#saveToCart');

        // Delete From Cart
        Route::delete('/deleteFromCart/{lesson}', [ CartController::class, 'deleteFromCart' ])->name('user#blog#deleteFromCart');
    } );

    // Order
    Route::group( [ 'prefix' => 'order' ], function() {
        // Order Page
        Route::get('order/page/{id}', [ OrderController::class, 'orderPage' ])->name('user#order#page');

        // Order
        Route::post('order', [ OrderController::class, 'order' ])->name('user#order');
    } );

    // Rating
    Route::group( [ 'prefix' => 'rating' ], function() {
        // Rating Create
        Route::post('create', [ RatingController::class, 'create' ])->name('user#rating#create');
    } );

    // Comment
    Route::group( [ 'prefix' => 'comment' ], function() {
        // Comment Create
        Route::post('create', [ CommentController::class, 'create' ])->name('user#comment#create');
        // Comment Reply
        Route::post('reply/{comment}', [ CommentController::class, 'reply' ])->name('user#comment#reply');
        // Comment Update
        Route::put('update/{comment}', [ CommentController::class, 'update' ])->name('user#comment#update');
        // Comment Delete
        Route::delete('delete/{id}', [ CommentController::class, 'delete' ])->name('user#comment#delete');
    } );
} );
