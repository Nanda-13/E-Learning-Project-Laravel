<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LessonBlogController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\LessonVideoController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\Admin\ProfileController;

// Admin
Route::group( [ 'prefix' => 'admin', 'middleware' => 'admin' ], function() {

    // Admin Home
    Route::get('home', [ AdminController::class, 'adminHome' ])->name('admin#home');

    // Profile
    Route::group( ['prefix' => 'profile'], function() {
        // Profile Page
        Route::get('page', [ ProfileController::class, 'profilePage' ])->name('admin#profile#page');

        // Profile Edit Page
        Route::get('edit/page', [ ProfileController::class, 'editPage' ])->name('admin#profile#edit#page');

        // Profile Edit
        Route::post('edit', [ ProfileController::class, 'edit' ])->name('admin#profile#edit');

        // Change Password Page
        Route::get('changePassword/page', [ ProfileController::class, 'changePasswordPage' ])->name('admin#profile#changePassword#page');

        // Change Password
        Route::post('changePassword', [ ProfileController::class, 'changePassword' ])->name('admin#profile#changePassword');

    } );

    // Category
    Route::group( ['prefix' => 'category'], function() {
        // Category Create Page
        Route::get('create/page', [ CategoryController::class, 'createPage' ])->name('admin#category#create#page');

        // Category Create
        Route::post('create', [ CategoryController::class, 'create' ])->name('admin#category#create');

        // Category List
        Route::get('list', [ CategoryController::class, 'list' ])->name('admin#category#list');

        // Category Edit Page
        Route::get('edit/page/{id}', [ CategoryController::class, 'editPage' ])->name('admin#category#edit#page');

        // Category Edit
        Route::post('edit', [ CategoryController::class, 'edit' ])->name('admin#category#edit');

        // Category Delete
        Route::delete('delete/{id}', [ CategoryController::class, 'delete' ])->name('admin#category#delete');
    } );

    // Sub Category
    Route::group( [ 'prefix' => 'subCategory' ], function() {
        // Sub Category Page
        Route::get('create/page', [ SubCategoryController::class, 'createPage' ])->name('admin#subCategory#create#page');

        // Sub Category
        Route::post('create', [ SubCategoryController::class, 'create' ])->name('admin#subCategory#create');

        // Sub Category List
        Route::get('list', [ SubCategoryController::class, 'list' ])->name('admin#subCategory#list');

        // Sub Category Edit Page
        Route::get('edit/page/{id}', [ SubCategoryController::class, 'editPage' ])->name('admin#subCategory#edit#page');

        // Sub Category Edit
        Route::post('edit', [ SubCategoryController::class, 'edit' ])->name('admin#subCategory#edit');

        // Sub Category Delete
        Route::delete('delete/{id}', [ SubCategoryController::class, 'delete' ])->name('admin#subCategory#delete');
    } );

    // Lesson
    Route::group( [ 'prefix' => 'lesson' ], function() {
        // Lesson Create Page
        Route::get('create/page', [ LessonController::class, 'createPage' ])->name('admin#lesson#create#page');

        // Filter Sub Category By Category Id
        Route::get('getSubcategories/{categoryId}',  [ CategoryController::class, 'getSubcategories' ]);

        // Lesson Create
        Route::post('create', [ LessonController::class, 'create' ])->name('admin#lesson#create');

        // Lesson List
        Route::get('list', [ LessonController::class, 'list' ])->name('admin#lesson#list');

        // Lesson Detail
        Route::get('detail/{id}', [ LessonController::class, 'detail' ])->name('admin#lesson#detail');

        // Lesson Edit Page
        Route::get('edit/page/{id}', [ LessonController::class, 'editPage' ])->name('admin#lesson#edit#page');

        // Lesson Edit
        Route::post('edit', [ LessonController::class, 'edit' ])->name('admin#lesson#edit');

        // Lesson Delete
        Route::delete('delete/{id}', [ LessonController::class, 'delete' ])->name('admin#lesson#delete');

        // Lesson Course
        Route::group( [ 'prefix' => 'course' ], function() {
            // Lesson Course Create Page
            Route::get('create/page', [ LessonVideoController::class, 'createPage' ])->name('admin#lesson#course#create#page');

            // Filter Lesson By SubCategory Id
            Route::get('getLesson/{subCategoryId}',  [ SubCategoryController::class, 'getLesson' ]);

            // Filter Lesson Chapter By Lesson Id
            Route::get('getLessonChapter/{lessonId}',  [ LessonController::class, 'getLessonCapter' ]);

            // Lesson Course Create
            Route::post('create', [ LessonVideoController::class, 'create' ])->name('admin#lesson#course#create');

            // Lesson Course List
            Route::get('list', [ LessonVideoController::class, 'list' ])->name('admin#lesson#course#list');

            // Lesson Change Status
            Route::get('changeStatus', [ LessonVideoController::class, 'changeStatus' ]);

            // Lesson Course Detail
            Route::get('detail/{id}', [ LessonVideoController::class, 'detail' ])->name('admin#lesson#course#detail');

            // Lesson Course Edit Page
            Route::get('edit/page/{id}', [ LessonVideoController::class, 'editPage' ])->name('admin#lesson#course#edit#page');

            // Lesson Course Edit
            Route::post('edit', [ LessonVideoController::class, 'edit' ])->name('admin#lesson#course#edit');

            // Lesson Course Delete
            Route::delete('delete/{id}', [ LessonVideoController::class, 'delete' ])->name('admin#lesson#course#delete');
        } );

        // Lesson BLog
        Route::group( [ 'prefix' => 'blog' ], function() {
            // Lesson Blog Create Page
            Route::get('create/page', [ LessonBlogController::class, 'createPage' ])->name('admin#lesson#blog#create#page');

            // Filter Lesson By SubCategory Id
            Route::get('getLesson/{subCategoryId}',  [ SubCategoryController::class, 'getLesson' ]);

            // Lesson Blog Create
            Route::post('create', [ LessonBlogController::class, 'create' ])->name('admin#lesson#blog#create');

            // Lesson Blog List
            Route::get('list', [ LessonBlogController::class, 'list' ])->name('admin#lesson#blog#list');

            // Lesson Blog Detail
            Route::get('detail/{id}', [ LessonBlogController::class, 'detail' ])->name('admin#lesson#blog#detail');

            // Lesson Blog Edit Page
            Route::get('edit/page/{id}', [ LessonBlogController::class, 'editPage' ])->name('admin#lesson#blog#edit#page');

            // Lesson Blog Edit
            Route::post('edit', [ LessonBlogController::class, 'edit' ])->name('admin#lesson#blog#edit');

            // Lesson Blog Delete
            Route::delete('delete/{id}', [ LessonBlogController::class, 'delete' ])->name('admin#lesson#blog#delete');
        } );
    } );

    // Payment
    Route::group( [ 'prefix' => 'payment' ], function() {
        // Payment Create Page
        Route::get('create/page', [ PaymentController::class, 'createPage' ])->name('admin#payment#create#page');

        // Payment Create
        Route::post('create', [ PaymentController::class, 'create' ])->name('admin#payment#create');

        // Payment List
        Route::get('list', [ PaymentController::class, 'list' ])->name('admin#payment#list');

        // Payment Edit Page
        Route::get('edit/page/{id}', [ PaymentController::class, 'editPage' ])->name('admin#payment#edit#page');

        // Payment Edit
        Route::post('edit', [ PaymentController::class, 'edit' ])->name('admin#payment#edit');

        // Payment Delete
        Route::delete('delete/{id}', [ PaymentController::class, 'delete' ])->name('admin#payment#delete');

    } );

    // Order
    Route::group( [ 'prefix' => 'order' ], function() {
        // Order List
        Route::get('list', [ OrderController::class, 'list' ])->name('admin#order#list');

        // Order Change Status
        Route::get('changeStatus', [ OrderController::class, 'changeStatus' ]);

        // Order Detail
        Route::get('detail/{order_code}', [ OrderController::class, 'detail' ])->name('admin#order#detail');

        // Order Confirm
        Route::post('confirm', [ OrderController::class, 'confirm' ])->name('admin$order#confirm');

        // Order Cancel
        Route::post('cancel', [ OrderController::class, 'cancel' ])->name('admin$order#cancel');
    } );

} );
