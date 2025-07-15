<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProductCategoryController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ThemeController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// kode baru diubah menjadi seperti ini
Route::get('/', [HomepageController::class, 'index'])->name('home');
Route::get('products', [HomepageController::class, 'products']);
Route::get('product/{slug}', [HomepageController::class, 'product'])->name('product.show');
Route::get('categories', [HomepageController::class, 'categories']);
Route::get('category/{slug}', [HomepageController::class, 'category']);

Route::get('cart', [HomepageController::class, 'cart'])->name('cart.index');
Route::get('checkout', [HomepageController::class, 'checkout'])->name('checkout.index');

Route::group(['middleware' => ['is_customer_login']], function () {
    Route::controller(CartController::class)->group(function () {
        Route::post('cart/add', 'add')->name('cart.add');
        Route::delete('cart/remove/{id}', 'remove')->name('cart.remove');
        Route::patch('cart/update/{id}', 'update')->name('cart.update');
    });
});

Route::group(['prefix' => 'customer'], function () {
    Route::controller(CustomerAuthController::class)->group(function () {
        Route::group(['middleware' => 'check_customer_login'], function () {
            // tampilkan halaman login
            Route::get('login', 'login')->name('customer.login');

            // aksi login
            Route::post('login', 'store_login')->name('customer.store_login');

            // tampilkan halaman register
            Route::get('register', 'register')->name('customer.register');

            // aksi register
            Route::post('register', 'store_register')->name('customer.store_register');
        });

        // aksi logout
        Route::post('logout', 'logout')->name('customer.logout');

    });
});

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', ProductCategoryController::class);
    Route::patch('categories/{category}/toggle', [ProductCategoryController::class, 'toggle'])->name('categories.toggle');
    Route::get('categories/{category}/toggle', function () {
        return redirect()->route('categories.index');
    });
    Route::resource('products', ProductController::class);
    Route::patch('products/{product}/toggle', [ProductController::class, 'toggle'])->name('products.toggle');
    Route::get('products/{product}/toggle', function () {
        return redirect()->route('products.index');
    });
    Route::resource('themes', ThemeController::class);
    Route::post('products/sync/{id}', [ProductController::class, 'sync'])->name('products.sync');
    Route::post('category/sync/{id}', [ProductCategoryController::class, 'sync'])->name('category.sync');

});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::patch('/products/{product}/toggle-all', [ProductController::class, 'toggleAll'])->name('products.toggleAll');

require __DIR__.'/auth.php';
