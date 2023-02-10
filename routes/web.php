<?php

use App\Events\SuccessAlertNotification;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\WebHookController;
use App\Http\Controllers\FrontendController;
use App\Mail\EmailOtp;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(FrontendController::class)->group(function (){
    Route::get('/','index');
});
Route::controller(DashboardController::class)->group(function (){
    Route::get('lock-screen','lockScreen')->name('lock-screen');
    Route::post('lock-screen','unlockScreen')->name('unlock-screen');
    Route::post('back-to-login','BackToLogin')->name('back-to-login');
});


Route::get('/test', function (){
    $role1 = \App\Models\Role::find(1);
    $role2 = \App\Models\Role::find(2);
    $user = \App\Models\User::find(2);
   //$res = $user->roles()->sync([1,3]);
 $res = $user->roles->first();
    dd($res);
});
Route::get('/test2', function (){
    $user = \App\Models\User::find(1);
    //dd($user->removeRole(3));
    //dd($user->assignPermission(1,2,5));
    dd($user->hasPermission('access_blog','create_blog'));
});

Route::get('/test3', function (){
    $role = \App\Models\Role::find(1);
    dd($role->countPermissions());
});
Route::get('/listen', function (){
    alert('success','Success');
    return view('listen');
});

Auth::routes(['register' => false]);

Route::get('/rayu', function (){
    //Mail::to('test@mail.com')->send(new EmailOtp());
   // dd(md5(microtime()));
   $user =  \App\Models\UpdateAdminPassword::latest()
        ->where('email','moderator@site.test')
        ->first();
   $otp = $user->created_at->addMinutes(5);
   if (now()->gt($otp)){
       dd('Yes',now(), $otp);
   }
    dd('No', now(), $otp);

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*
 * WebHooks End Points
 */
Route::post('/webhooks/cloudinary', [ WebHookController::class,'GetResponseFromCloudinary' ])->name('get-response-from-cloudinary');
