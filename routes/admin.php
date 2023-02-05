<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventsController;
use App\Http\Controllers\Admin\ManagePageController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

Route::controller(DashboardController::class)
    ->group(function (){
    Route::get('/','index')->name('dashboard.index');
    Route::get('analytics','analytics')->name('analytics');
    Route::get('profile','profile')->name('profile');
    Route::put('profile','UpdateProfile')->name('update-profile');
    Route::put('profile/photo','ProfileImageUpload')->name('profile-image-upload');
    Route::get('roles','Roles')->name('roles');
    Route::get('roles/{role:name}','role')->name('role');
    Route::post('roles','AddRole')->name('add-role');
    Route::put('roles/{id}','UpdateRole')->name('update-role');
    Route::delete('role','DeleteRole')->name('delete-role');
    Route::post('roles/{role:name}/permissions','AssignPermission')->name('assign-permission');
    Route::post('roles/{role:name}/permissions/revoke','RevokePermission')->name('revoke-permission');
    Route::get('features','RoomFeatures')->name('room-features');
    Route::get('features/create','AddFeature')->name('add-feature');
    Route::post('features','StoreFeature')->name('store-feature');
    Route::put('features/{id}/update','UpdateRoomFeature')->name('update-room-feature');
    Route::delete('features/{id}','DeleteRoomFeature')->name('delete-room-feature');
    Route::get('rooms','Rooms')->name('rooms');
    Route::get('rooms/create','AddRoom')->name('add-room');
    Route::post('rooms','StoreRoom')->name('store-room');
    Route::get('rooms/{room:slug}','Room')->name('room');
    Route::get('rooms/{room:slug}/edit','EditRoom')->name('edit-room');
    Route::put('rooms/{room:slug}/update','UpdateRoom')->name('update-room');
    Route::delete('rooms/{id}/destroy','DeleteRoom')->name('delete-room');
    Route::get('faq','Faq')->name('faq');
    Route::get('pricing','Pricing')->name('pricing');
    Route::get('posts','Posts')->name('posts');
    Route::get('category','PostCategory')->name('post-category');
    Route::get('post/{post:slug}','Post')->name('post');
    Route::get('employees','Employee')->name('employee');
});
Route::controller(EventsController::class)
    ->prefix('event')
    ->name('event.')
    ->group(function (){
    Route::get('/','index')->name('index');
    Route::post('/','store')->name('store');
});

Route::controller(SettingsController::class)->prefix('settings')->group(function (){
    Route::get('/','index')->name('settings.index');
});

Route::controller(ManagePageController::class)->group(function (){
    Route::get('about','AboutPage')->name('about-page');
});



