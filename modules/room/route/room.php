<?php
use Illuminate\Support\Facades\Route;
use Modules\Room\Http\Controllers\RoomController;

//Backend routes
Route::controller(RoomController::class)->name('modules.room.')->prefix('dashboard')->group(function (){
    Route::get('rooms','index')->name('index');
});

//Frontend routes

