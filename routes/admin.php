<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventsController;
use App\Http\Controllers\Admin\ManagePageController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\PaymentController;
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
    Route::get('faq','Faq')->name('faq');
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

Route::prefix('features')->group(function (){
    Route::get('/', [RoomController::class,'Features'])->name('room-features');
    Route::get('new', [RoomController::class,'CreateFeature' ])->name('add-feature');
    Route::post('new', [RoomController::class,'StoreFeature' ])->name('store-feature');
    Route::put('{id}/update', [ RoomController::class,'UpdateFeature' ])->name('update-room-feature');
    Route::delete('{id}', [ RoomController::class,'DeleteFeature' ])->name('delete-room-feature');
});
Route::prefix('rooms')->group(function (){
    Route::get('/', [ RoomController::class,'Rooms' ])->name('rooms');
    Route::get('new/room',[ RoomController::class,'AddRoom' ])->name('add-room');
    Route::post('new/room',[ RoomController::class,'StoreRoom' ])->name('store-room');
    Route::get('categories',[ RoomController::class,'RoomCategory' ])->name('room-categories');
    Route::get('{room:slug}', [ RoomController::class,'Room' ])->name('room');
    Route::get('rooms/{room:slug}/edit',[ RoomController::class,'EditRoom' ])->name('edit-room');
    Route::put('rooms/{room:slug}',[ RoomController::class,'UpdateRoom' ])->name('update-room');
    Route::delete('rooms/{id}',[ RoomController::class, 'DeleteRoom' ])->name('delete-room');
});

Route::controller(SettingsController::class)->prefix('settings')->group(function (){
    Route::get('/','index')->name('settings.index');
    Route::get('contact','ContactSettings')->name('contact-settings');
    Route::get('social-media','SocialMediaSettings')->name('social-media-settings');
    Route::get('uploads','UploadSettings')->name('upload-settings');
    Route::get('salary','SalarySettings')->name('salary-settings');
});

Route::controller(ManagePageController::class)->group(function (){
    Route::get('about','AboutPage')->name('about-page');
});

Route::get('payroll', [ PaymentController::class,'StaffSalaries' ])->name('payment.salaries-staff');


