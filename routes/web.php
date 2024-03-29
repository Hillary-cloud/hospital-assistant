<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\RecordController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Http\Controllers\Admin\ConsultationController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;

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
Route::middleware(['auth'])->group(function(){
    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::get('',[DashboardController::class,'Index']);
    Route::get('notification',[NotificationController::class,'markAsRead'])->name('mark-as-read');
    Route::get('notification-read',[NotificationController::class,'read'])->name('read');
    Route::get('profile',[UserController::class,'profile'])->name('profile');
    Route::post('profile/{user}',[UserController::class,'updateProfile'])->name('profile.update');
    Route::put('profile/update-password/{user}',[UserController::class,'updatePassword'])->name('update-password');
    Route::post('logout',[LogoutController::class,'index'])->name('logout');

    Route::resource('users',UserController::class);
    Route::resource('permissions',PermissionController::class)->only(['index','store','destroy']);
    Route::put('permission',[PermissionController::class,'update'])->name('permissions.update');
    Route::resource('roles',RoleController::class);

    Route::resource('consultations',ConsultationController::class)->except('show');
    Route::get('consultations/{id}',[ConsultationController::class, 'destroy'])->name('consultations.destroy');
    Route::get('consultations/approve/{id}',[ConsultationController::class, 'approve'])->name('consultations.approve');
    Route::get('consultations/{id}',[ConsultationController::class, 'decline'])->name('consultations.decline');
    Route::get('consultations/detail/{id}',[ConsultationController::class, 'viewConsultation'])->name('consultations.viewConsultation');

    Route::get('/payment/{id}', [PaymentController::class, 'showPaymentPage'])->name('payment-page');
    Route::post('/consultation/pay/{id}', [PaymentController::class, 'redirectToGateway'])->name('consultations.pay');
    Route::get('/payment/callback/{id}', [PaymentController::class, 'handleGatewayCallback'])->name('payment.callback');
    Route::get('/payment/success/{id}', function () {
        return view('success');
    })->name('success');
    Route::middleware(['auth', 'can:view-payments'])->group(function () {
        Route::get('/transaction-history', [PaymentController::class, 'showTransactionHistoryPage'])->name('payment-history.all-payments');
        
        Route::middleware(['can:my-payments'])->group(function () {
            Route::get('/my-transaction-history', [PaymentController::class, 'showMyTransactionHistoryPage'])->name('payment-history.my-payments');
        });
    });
    

    Route::get('backup', [BackupController::class,'index'])->name('backup.index');
    Route::put('backup/create', [BackupController::class,'create'])->name('backup.store');
    Route::get('backup/download/{file_name?}', [BackupController::class,'download'])->name('backup.download');
    Route::delete('backup/delete/{file_name?}', [BackupController::class,'destroy'])->where('file_name', '(.*)')->name('backup.destroy');

    Route::get('settings',[SettingController::class,'index'])->name('settings');

    Route::resource('feedbacks',FeedbackController::class);
    
    Route::get('records',[RecordController::class, 'index'])->name('records.index');
    Route::get('records/patient',[RecordController::class, 'getPatient'])->name('records.getPatient');
    Route::get('/records/create',[RecordController::class, 'create'])->name('records.create');
    Route::get('/records/create/patient',[RecordController::class, 'getPatientCreate'])->name('records.getPatientCreate');
    Route::post('/records/store/patient',[RecordController::class, 'store'])->name('records.store');
    Route::get('/records/edit/patient/{id}',[RecordController::class, 'edit'])->name('records.edit');
    Route::put('/records/update/{id}',[RecordController::class, 'update'])->name('records.update');
    Route::get('records/detail/{id}',[RecordController::class, 'viewRecord'])->name('records.viewRecord');
});

Route::middleware(['guest'])->group(function () {
    Route::get('',function(){
        return redirect()->route('dashboard');
    });

    Route::get('login',[LoginController::class,'index'])->name('login');
    Route::post('login',[LoginController::class,'login']);

    Route::get('register',[RegisterController::class,'index'])->name('register');
    Route::post('register',[RegisterController::class,'store']);

    Route::get('forgot-password',[ForgotPasswordController::class,'index'])->name('password.request');
    Route::post('forgot-password',[ForgotPasswordController::class,'requestEmail']);
    Route::get('reset-password/{token}',[ResetPasswordController::class,'index'])->name('password.reset');
    Route::post('reset-password',[ResetPasswordController::class,'resetPassword'])->name('password.update');
});
