<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\SerialNumberController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TrainerController;
 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
});
 
Route::middleware('auth')->group(function (){
    
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/admin/members', [MembersController::class, 'index'])->name('members.index');
    Route::get('/pages/join_us', [MembersController::class, 'join_us'])->name('join_us');

    //Members
    Route::post('/pages/admin/addMember', [MembersController::class, 'addMember'])->name('admin.addMemeber');
    Route::post('/pages/admin/deleteMember', [MembersController::class, 'deleteMember'])->name('admin.deleteMembers'); 
    Route::post('/pages/admin/editMember', [MembersController::class, 'editMember'])->name('admin.editMember');
    Route::get('/get-total-cost',[MembersController::class, 'getTotal']);

    //Attendance
    Route::get('/attendance/index',[AttendanceController::class,'index'])->name('attendance');
    Route::get('/attendance/register',[AttendanceController::class,'register'])->name('attendance.register');
    Route::post('/attendance/register/member', [AttendanceController::class, 'create'])->name('register.memebers');

    //Daily Subscription
    Route::post('/attendance/register/dailySubscription', [FinanceController::class, 'create'])->name('register.dailySubscription');

    //Profile
    Route::get('/member/profile/{id}',[MembersController::class,'show'])->name('profile');

    //Member Subscription
    Route::post('/member/profile/subscription', [MembersController::class, 'AddSubscription'])->name('profile.subscription');

    //finance
    Route::get('/finance', [FinanceController::class, 'index'])->name('finance');

    //expense
    Route::get('/expense', [ExpenseController::class, 'index'])->name('expense');
    Route::post('/expense/create', [ExpenseController::class, 'create'])->name('expense.add');
    Route::post('/expense/update', [ExpenseController::class, 'update'])->name('expense.update');
    Route::post('/expense/delete', [ExpenseController::class, 'destroy'])->name('expense.delete');
  
    //categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::post('/categories/create', [CategoryController::class, 'create'])->name('categories.add');
    Route::post('/categories/assign', [CategoryController::class, 'assignCategory'])->name('categories.assign');
    Route::post('/categories/edit', [CategoryController::class, 'Update'])->name('categories.update');
    Route::post('/categories/delete', [CategoryController::class, 'destroy'])->name('categories.delete');

    //trainers
    Route::get('/trainers', [TrainerController::class, 'index'])->name('trainers');
    Route::post('/trainers/add', [TrainerController::class, 'create'])->name('trainers.add');
    Route::post('/trainers/update', [TrainerController::class, 'update'])->name('trainers.update');
    Route::post('/trainers/delete', [TrainerController::class, 'destroy'])->name('trainers.delete');

    //Profile
    Route::get('/trainer/profile/{id}',[TrainerController::class,'show'])->name('trainer.profile');
    Route::post('/trainers/update', [TrainerController::class, 'update'])->name('trainers.update');
    Route::post('/trainers/assign/member', [TrainerController::class, 'addAssignment'])->name('trainers.member.add');
    Route::post('/trainers/delete/member', [TrainerController::class, 'deleteAssignment'])->name('trainers.member.delete');

});
// //Serial Number
Route::get('/serialNumbers', [SerialNumberController::class, 'index'])->name('firebase.index');
Route::get('/expired', [SerialNumberController::class, 'expired'])->name('expired');


  

