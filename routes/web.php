<?php

use App\Http\Controllers\admin\DashController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
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

Route::get('/', [PostController::class, 'index']);
Route::resource('post', PostController::class);
Route::post('search', [PostController::class, 'search'])->name('search');
Route::get('/category/{id}/{slug}', [PostController::class, 'getByCategory'])->name('category');

Route::resource('/comment', CommentController::class);
Route::post('/reply/store', [CommentController::class, 'replyStore'])->name('reply.add');

Route::post('/notification', [NotificationController::class, 'index'])->name('notification');
Route::get('/notification', [NotificationController::class, 'allNotification'])->name('all.Notification');

Route::get('/user/{id}', [UserController::class, 'getPostsByUser'])->name('profile')->middleware('auth');
Route::get('user/{id}/comments', [UserController::class, 'getCommentsByUser'])->name('user_comments');

Route::group(['prefix' => 'admin',  'middleware' => 'Admin'], function () {
    Route::get('/dashboard', [DashController::class, 'index'])->name('admin.dashboard');
    Route::resource('/category', CategoryController::class);
    Route::get('user/{id}/comments', [UserController::class, 'getCommentsByUser'])->name('user_comments');
    Route::resource('/posts', 'App\Http\Controllers\admin\PostController');
    Route::resource('/role', RoleController::class);
    Route::get('/permission', [PermissionController::class, 'index'])->name('permissions');
    Route::post('/permission', [PermissionController::class, 'store'])->name('permissions');
    Route::resource('/user', UserController::class);
    Route::resource('/page', PageController::class);
});

Route::get('/page/{slug}', [PageController::class, 'show'])->name('page.show');
Route::get('permission/byRole', [RoleController::class, 'getByRole'])->name('permission_byRole')->middleware('Admin');


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/', [PostController::class, 'index']);
// });

require_once __DIR__ . '/fortify.php';
