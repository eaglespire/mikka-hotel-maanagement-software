<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventsController;
use App\Http\Controllers\Admin\ManagePageController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\WebHookController;
use App\Http\Controllers\SettingsController;
use App\Http\Livewire\Dashboard\PermissionsComponent;
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







//Route::controller(DashboardControllerOld::class)->group(function (){
//    Route::get('/','indexPage')->name('dashboard');
//    Route::get('staff','staffListPage')->name('staff-list-page');
//    Route::get('staff/create','createStaffPage')->name('create-staff')->middleware('can:add-new-staff');
//    Route::post('staff/create','storeStaff')->name('store-staff');
//    Route::get('staff/{id}/edit','editStaffPage')->name('edit-staff-page');
//    Route::put('staff/{id}/update','updateStaff')->name('update-staff');
//    Route::prefix('settings')->group(function (){
//        Route::get('theme','themeSettingsPage')->name('theme-settings-page');
//        Route::get('roles','roleSettingsPage')->name('role-settings-page');
//    });
//});
//Route::get('roles/{role:name}/permissions', PermissionsComponent::class)->name('permissions-component');
//Route::get('room',[RoomController::class,'index'])->name('room.index');
//Route::get('room/create',[RoomController::class,'createRoom'])->name('room.create');
//Route::post('room/store',[RoomController::class,'storeRoom'])->name('room.store');
//Route::get('room/{room:slug}', [RoomController::class,'manageRoom'])->name('room.manage-room');
//Route::get('features', [ RoomController::class,'allFeatures' ])->name('feature.index');
//Route::get('features/create', [ RoomController::class,'newFeature' ])->name('feature.create') ;
//Route::post('features', [ RoomController::class,'storeFeature' ])->name('feature.store') ;


