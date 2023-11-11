<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\BlogCommentController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\BlogPostController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\GallerySettingController;
use App\Http\Controllers\Backend\NotificationController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\RestaurantController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\RoomController;
use App\Http\Controllers\Backend\RoomListController;
use App\Http\Controllers\Backend\RoomTypeController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Frontend\HomeController;
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


Route::middleware('auth', 'roles:admin')->group(function(){
    Route::controller(AdminController::class)->group(function(){
        Route::get('/admin/dashboard', 'AdminDashboard')->name('admin.dashboard');
        Route::get('/admin/logout', 'AdminLogout')->name('admin.logout');
        Route::get('/admin/profile', 'AdminProfile')->name('admin.profile');
        Route::post('/admin/profile/store', 'AdminProfileStore')->name('admin.profile.store');
        Route::get('/admin/change/password', 'AdminChangePassword')->name('admin.change.password');
        Route::post('/admin/password/update', 'AdminPasswordUpdate')->name('admin.password.update');
    });

    Route::controller(TeamController::class)->group(function(){
        Route::get('/all/team', 'AllTeam')->name('all.team')->middleware('permission:team.all');
        Route::get('/add/team', 'AddTeam')->name('add.team')->middleware('permission:team.add');
        Route::post('/team/store', 'StoreTeam')->name('team.store')->middleware('permission:team.add');
        Route::get('/edit/team/{id}', 'EditTeam')->name('edit.team')->middleware('permission:team.edit');
        Route::post('/team/update', 'UpdateTeam')->name('team.update')->middleware('permission:team.edit');
        Route::get('/delete/team/{id}', 'DeleteTeam')->name('delete.team')->middleware('permission:team.delete');
    });

    Route::controller(AboutUsController::class)->group(function(){
        Route::get('/about/us/update', 'AboutUsUpdate')->name('about.us.update')->middleware('permission:aboutus.update');
        Route::post('/about/us/store', 'AboutUsStore')->name('about.us.store')->middleware('permission:aboutus.update');
    });

    Route::controller(RoomTypeController::class)->group(function(){
        Route::get('/room/type/list', 'RoomTypeList')->name('room.type.list')->middleware('permission:room.type.list');
        Route::get('/add/room/type', 'AddRoomType')->name('add.room.type')->middleware('permission:room.type.add');
        Route::post('/room/type/store', 'RoomTypeStore')->name('room.type.store')->middleware('permission:room.type.add');
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
        Route::get('/download/invoice/{id}', 'DownloadInvoice')->name('download.invoice');
    });

    Route::controller(RoomListController::class)->group(function(){
        Route::get('/room/list/view', 'RoomListView')->name('room.list.view');
        Route::get('/add/room/list', 'AddRoomList')->name('add.room.list');
        Route::post('/store/room/list', 'StoreRoomList')->name('store.room.list');
        Route::get('/delete/booking/{id}', 'DeleteBooking')->name('delete.booking');
    });

    Route::controller(SettingController::class)->group(function(){
        Route::get('/smtp/setting', 'SmtpSetting')->name('smtp.setting');
        Route::post('/smtp/update', 'SmtpUpdate')->name('smtp.update');
        Route::get('/site/setting', 'SiteSetting')->name('site.setting');
        Route::post('/site/update', 'SiteUpdate')->name('site.update');
    });

    Route::controller(TestimonialController::class)->group(function(){
        Route::get('/all/testimonial', 'AllTestimonial')->name('all.testimonial');
        Route::get('/add/testimonial', 'AddTestimonial')->name('add.testimonial');
        Route::post('/store/testimonial', 'StoreTestimonial')->name('testimonial.store');
        Route::get('/edit/testimonial/{id}', 'EditTestimonial')->name('edit.testimonial');
        Route::post('/update/testimonial', 'UpdateTestimonial')->name('testimonial.update');
        Route::get('/delete/testimonial/{id}', 'DeleteTestimonial')->name('delete.testimonial');
    });

    Route::controller(BlogController::class)->group(function(){
        Route::get('/blog/category', 'BlogCategory')->name('blog.category')->middleware('permission:blog.category.list');
        Route::post('/store/blog/category', 'StoreBlogCategory')->name('store.blog.category')->middleware('permission:blog.category.add');
        Route::get('/edit/blog/category/{id}', 'EditBlogCategory')->middleware('permission:blog.category.edit');
        Route::post('/update/blog/category', 'UpdateBlogCategory')->name('update.blog.category')->middleware('permission:blog.category.edit');
        Route::get('/delete/blog/category/{id}', 'DeleteBlogCategory')->name('delete.blog.category')->middleware('permission:blog.category.delete');
    });

    Route::controller(BlogPostController::class)->group(function(){
        Route::get('/all/blog/post', 'AllBlogPost')->name('all.blog.post')->middleware('permission:blog.post.list');
        Route::get('/add/blog/post', 'AddBlogPost')->name('add.blog.post')->middleware('permission:blog.post.add');
        Route::post('/store/blog/post', 'StoreBlogPost')->name('store.blog.post')->middleware('permission:blog.post.add');
        Route::get('/edit/blog/post/{id}', 'EditBlogPost')->name('edit.blog.post')->middleware('permission:blog.post.edit');
        Route::post('/update/blog/post', 'UpdateBlogPost')->name('update.blog.post')->middleware('permission:blog.post.edit');
        Route::get('/delete/blog/post/{id}', 'DeleteBlogPost')->name('delete.blog.post')->middleware('permission:blog.post.delete');
    });

    Route::controller(BlogCommentController::class)->group(function(){
        Route::get('/all/comment', 'AllComment')->name('all.comment')->middleware('permission:blog.comment.list');
        Route::post('update.comment.status', 'UpdateCommentStatus')->name('update.comment.status')->middleware('permission:blog.comment.list');
    });

    Route::controller(ReportController::class)->group(function(){
        Route::get('/booking/report', 'BookingReport')->name('booking.report')->middleware('permission:booking.report.menu');
        Route::post('/search/by/date', 'SearchByDate')->name('search.by.date')->middleware('permission:booking.report.menu');
    });

    Route::controller(GallerySettingController::class)->group(function(){
        Route::get('all/gallery/setting', 'AllGallerySetting')->name('all.gallery.setting')->middleware('permission:setting.gallery.list');
        Route::get('add/gallery/setting', 'AddGallerySetting')->name('add.gallery.setting')->middleware('permission:setting.gallery.add');
        Route::post('store/gallery/setting', 'StoreGallerySetting')->name('store.gallery.setting')->middleware('permission:setting.gallery.add');
        Route::get('edit/gallery/setting/{id}', 'EditGallerySetting')->name('edit.gallery.setting')->middleware('permission:setting.gallery.edit');
        Route::post('update/gallery/setting', 'UpdateGallerySetting')->name('update.gallery.setting')->middleware('permission:setting.gallery.edit');
        Route::get('delete/gallery/setting/{id}', 'DeleteGallerySetting')->name('delete.gallery.setting')->middleware('permission:setting.gallery.delete');
        Route::post('delete/gallery/multiple', 'DeleteGalleryMultiple')->name('delete.gallery.multiple')->middleware('permission:setting.gallery.delete');
    });

    Route::controller(ContactController::class)->group(function(){
        Route::get('all/contact/message', 'AllContactMessage')->name('all.contact.message')->middleware('permission:messages.menu');
    });

    Route::controller(AdminController::class)->group(function(){
        Route::get('/all/admin', 'AllAdmin')->name('all.admin')->middleware('permission:employee.list');
        Route::get('/add/admin', 'AddAdmin')->name('add.admin')->middleware('permission:employee.add');
        Route::post('/store/admin', 'StoreAdmin')->name('store.admin')->middleware('permission:employee.add');
        Route::get('/edit/admin/{id}', 'EditAdmin')->name('edit.admin')->middleware('permission:employee.edit');
        Route::post('/update/admin/{id}', 'UpdateAdmin')->name('update.admin')->middleware('permission:employee.edit');
        Route::get('/delete/admin/{id}', 'DeleteAdmin')->name('delete.admin')->middleware('employee.delete');
    });

    Route::controller(RestaurantController::class)->group(function(){
        Route::get('/all/menu/category', 'AllMenuCategory')->name('all.menu.category');
        Route::post('/store/menu/category', 'StoreMenuCategory')->name('store.menu.category');
        Route::get('/edit/menu/category/{id}', 'EditMenuCategory')->name('edit.menu.category');
        Route::post('/update/menu/category', 'UpdateMenuCategory')->name('update.menu.category');
        Route::get('/delete/menu/category/{id}', 'DeleteMenuCategory')->name('delete.menu.category');

        Route::get('/all/menu/items', 'AllMenuItems')->name('all.menu.items');
        Route::get('/add/menu/item', 'AddMenuItem')->name('add.menu.item');
        Route::post('/store/menu/item', 'StoreMenuItem')->name('store.menu.item');
        Route::get('/edit/menu/item/{id}', 'EditMenuItem')->name('edit.menu.item');
        Route::post('/update/menu/item/{id}', 'UpdateMenuItem')->name('update.menu.item');
        Route::get('/delete/menu/item/{id}', 'DeleteMenuItem')->name('delete.menu.item');

        Route::get('/all/menu/banner', 'AllMenuBanner')->name('all.menu.banner');
        Route::get('/add/menu/banner', 'AddMenuBanner')->name('add.menu.banner');
        Route::post('/store/menu/banner', 'StoreMenuBanner')->name('store.menu.banner');
        Route::get('/edit/menu/banner/{id}', 'EditMenuBanner')->name('edit.menu.banner');
        Route::post('/update/menu/banner/{id}', 'UpdateMenuBanner')->name('update.menu.banner');
        Route::get('/delete/menu/banner/{id}', 'DeleteMenuBanner')->name('delete.menu.banner');
    });
});

Route::middleware('auth', 'roles:admin', 'permission:role.permission.menu')->group(function(){
    Route::controller(RoleController::class)->group(function(){
        Route::get('/all/permission', 'AllPermission')->name('all.permission');
        Route::get('/add/permission', 'AddPermission')->name('add.permission');
        Route::post('/store/permission', 'StorePermission')->name('store.permission');
        Route::get('/edit/permission/{id}', 'EditPermission')->name('edit.permission');
        Route::post('/update/permission', 'UpdatePermission')->name('update.permission');
        Route::get('/delete/permission/{id}', 'DeletePermission')->name('delete.permission');

        Route::get('/import/permission', 'ImportPermission')->name('import.permission');
        Route::get('/export', 'Export')->name('export');
        Route::post('/import', 'Import')->name('import');

        Route::get('/all/roles', 'AllRoles')->name('all.roles');
        Route::get('/add/roles', 'AddRoles')->name('add.roles');
        Route::post('/store/roles', 'StoreRoles')->name('store.roles');
        Route::get('/edit/roles/{id}', 'EditRoles')->name('edit.roles');
        Route::post('/update/roles', 'UpdateRoles')->name('update.roles');
        Route::get('/delete/roles/{id}', 'DeleteRoles')->name('delete.roles');

        Route::get('/export/roles', 'ExportRoles')->name('export.roles');
        Route::get('/import/roles/view', 'ImportRolesView')->name('import.roles.view');
        Route::post('/import/roles/store', 'ImportRolesStore')->name('import.roles.store');

        Route::get('/add/roles/permission', 'AddRolesPermission')->name('add.roles.permission');
        Route::post('/role/permission/store', 'RolePermissionStore')->name('role.permission.store');
        Route::get('/all/roles/permission', 'AllRolesPermission')->name('all.roles.permission');
        Route::get('/edit/roles/permission/{id}', 'EditRolesPermission')->name('edit.roles.permission');
        Route::post('/update/roles/permission/{id}', 'UpdateRolesPermission')->name('update.roles.permission');
        Route::get('/delete/roles/permission/{id}', 'DeleteRolesPermission')->name('delete.roles.permission');
    });
});

Route::controller(AboutUsController::class)->group(function(){
    Route::get('/aboutus', 'AboutUs')->name('about.us');
});

Route::controller(RestaurantController::class)->group(function(){
    Route::get('/show.restaurant', 'ShowRestaurant')->name('show.restaurant');
});

Route::controller(HomeController::class)->group(function(){
    Route::get('/rooms', 'Rooms')->name('rooms');
    Route::get('/room/details/{id}', 'RoomDetails')->name('room.details');
    Route::get('/booking', 'BookingSearch')->name('booking.search');
    Route::get('/search/room/details/{id}', 'SearchRoomDetails')->name('search.room.details');
    
    Route::get('/check_room_availability/', 'CheckRoomAvailability')->name('check_room_availability');
});

Route::controller(BlogController::class)->group(function(){
    Route::get('/blog/details/{slug}', 'BlogDetails');
    Route::get('/blog/category/list/{id}', 'BlogCategoryList');
    Route::get('/blog/list', 'BlogList')->name('blog.list');
});

Route::controller(GallerySettingController::class)->group(function(){
    Route::get('/show/gallery', 'ShowGallery')->name('show.gallery');
});

Route::controller(ContactController::class)->group(function(){
    Route::get('/contact/hotel', 'ContactUs')->name('contact.us');
    Route::post('/contact/store', 'ContactStore')->name('contact.store');
});

Route::middleware(['auth'])->group(function(){
    Route::controller(BookingController::class)->group(function(){
       Route::get('/checkout', 'Checkout')->name('checkout'); 
       Route::post('/booking/store/', 'BookingStore')->name('user_booking_store');
       Route::post('/checkout/store', 'CheckoutStore')->name('checkout.store');
       Route::match(['get', 'post'],'/stripe_pay', 'stripe_pay')->name('stripe_pay');
       Route::get('/user/booking', 'UserBooking')->name('user.booking');
       Route::get('/user/invoice/{id}', 'UserInvoice')->name('user.invoice');
    });

    Route::controller(BlogCommentController::class)->group(function(){
        Route::post('/store/blog/comment', 'StoreBlogComment')->name('store.blog.comment');
    });
});

Route::controller(NotificationController::class)->group(function(){
    Route::post('/mark-notification-as-read/{notification}', 'MarkAsRead');
    Route::get('/mark-all-as-read', 'MarkAllAsRead')->name('mark-all-as-read');
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

require __DIR__.'/auth.php';
