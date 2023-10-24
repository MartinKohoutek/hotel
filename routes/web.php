<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\RoomController;
use App\Http\Controllers\Backend\RoomListController;
use App\Http\Controllers\Backend\RoomTypeController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::controller(UserController::class)->group(function(){
    Route::get('/', 'Index');
});

Route::get('/dashboard', function () {
    return view('frontend.dashboard.user_dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::controller(UserController::class)->group(function(){
        Route::get('/profile', 'UserProfile')->name('user.profile');
        Route::post('/profile/store', 'UserProfileStore')->name('user.profile.store');
        Route::get('/user/logout', 'UserLogout')->name('user.logout');
        Route::get('/user/change/password', 'UserChangePassword')->name('user.change.password');
        Route::post('/user/password/update', 'UserPasswordUpdate')->name('user.password.update');
    });
});


Route::middleware('auth', 'role:admin')->group(function(){
    Route::controller(AdminController::class)->group(function(){
        Route::get('/admin/dashboard', 'AdminDashboard')->name('admin.dashboard');
        Route::get('/admin/logout', 'AdminLogout')->name('admin.logout');
        Route::get('/admin/profile', 'AdminProfile')->name('admin.profile');
        Route::post('/admin/profile/store', 'AdminProfileStore')->name('admin.profile.store');
        Route::get('/admin/change/password', 'AdminChangePassword')->name('admin.change.password');
        Route::post('/admin/password/update', 'AdminPasswordUpdate')->name('admin.password.update');
    });

    Route::controller(TeamController::class)->group(function(){
        Route::get('/all/team', 'AllTeam')->name('all.team');
        Route::get('/add/team', 'AddTeam')->name('add.team');
        Route::post('/team/store', 'StoreTeam')->name('team.store');
        Route::get('/edit/team/{id}', 'EditTeam')->name('edit.team');
        Route::post('/team/update', 'UpdateTeam')->name('team.update');
        Route::get('/delete/team/{id}', 'DeleteTeam')->name('delete.team');
    });

    Route::controller(AboutUsController::class)->group(function(){
        Route::get('/about/us/update', 'AboutUsUpdate')->name('about.us.update');
        Route::post('/about/us/store', 'AboutUsStore')->name('about.us.store');
    });

    Route::controller(RoomTypeController::class)->group(function(){
        Route::get('/room/type/list', 'RoomTypeList')->name('room.type.list');
        Route::get('/add/room/type', 'AddRoomType')->name('add.room.type');
        Route::post('/room/type/store', 'RoomTypeStore')->name('room.type.store');
    });

    Route::controller(RoomController::class)->group(function(){
        Route::get('/edit/room/{id}', 'EditRoom')->name('edit.room');
        Route::post('/update/room/{id}', 'UpdateRoom')->name('update.room');
        Route::get('/multi/image/delete/{id}', 'MultiImageDelete')->name('multi.image.delete');
        Route::post('/store/room/number/{id}', 'StoreRoomNumber')->name('store.room.number');
        Route::get('/edit/room/number/{id}', 'EditRoomNumber')->name('edit.room.number');
        Route::post('/update/room/number/{id}', 'UpdateRoomNumber')->name('update.room.number');
        Route::get('/delete/room/number/{id}', 'DeleteRoomNumber')->name('delete.room.number');
        Route::get('/delete/room/{id}', 'DeleteRoom')->name('delete.room');
    });

    Route::controller(BookingController::class)->group(function(){
        Route::get('/booking/list', 'BookingList')->name('booking.list');
        Route::get('/edit/booking/{id}', 'EditBooking')->name('edit_booking');
        Route::post('/update/booking/status/{id}', 'UpdateBookingStatus')->name('update.booking.status');
        Route::post('/update/booking/{id}', 'UpdateBooking')->name('update.booking');
        Route::get('/assign_room/{id}', 'AssignRoom')->name('assign_room');
        Route::get('/assign/room/store/{booking_id}/{room_number_id}', 'AssignRoomStore')->name('assign_room_store');
        Route::get('/assign/room/delete/{id}', 'AssignRoomDelete')->name('assign_room_delete');
    });

    Route::controller(RoomListController::class)->group(function(){
        Route::get('/room/list/view', 'RoomListView')->name('room.list.view');
    });
});

Route::controller(AboutUsController::class)->group(function(){
    Route::get('/aboutus', 'AboutUs')->name('about.us');
});

Route::controller(HomeController::class)->group(function(){
    Route::get('/rooms', 'Rooms')->name('rooms');
    Route::get('/room/details/{id}', 'RoomDetails')->name('room.details');
    Route::get('/booking', 'BookingSearch')->name('booking.search');
    Route::get('/search/room/details/{id}', 'SearchRoomDetails')->name('search.room.details');
    
    Route::get('/check_room_availability/', 'CheckRoomAvailability')->name('check_room_availability');
});


Route::middleware(['auth'])->group(function(){
    Route::controller(BookingController::class)->group(function(){
       Route::get('/checkout', 'Checkout')->name('checkout'); 
       Route::post('/booking/store/', 'BookingStore')->name('user_booking_store');
       Route::post('/checkout/store', 'CheckoutStore')->name('checkout.store');
       Route::match(['get', 'post'],'/stripe_pay', 'stripe_pay')->name('stripe_pay');
    });
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

require __DIR__.'/auth.php';
