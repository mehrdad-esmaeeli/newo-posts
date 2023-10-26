<?php

use App\Http\Controllers\AboutController as FrontendAboutController;
use App\Http\Controllers\backend\AboutController;
use App\Http\Controllers\backend\PostController;
use App\Http\Controllers\backend\SettingController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Middleware\SettingMiddleware;
use App\Models\Post;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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



Route::resource('users',UserController::class);

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/posts/{slug}', [HomeController::class, 'show'])->name('home.show');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('send');


Route::get('/test',function(){

    // return Post::find(2)->profile->user;

    // return Profile::find(3)->posts;

 $post= DB::table('posts')->join('profiles','posts.profile_id','profiles.id')
 ->join('users','profiles.user_id','users.id')->select('posts.*','profiles.profile_pic as picture','users.name as username')
 ->get();

 dd($post);


});



Route::get('/about', [FrontendAboutController::class, 'index'])->name('about');

Route::get('/locale/{locale}',function($locale){

    app()->setlocale($locale);
//   app()->setLocale($locale);
  Session::put('locale',$locale);

  return redirect()->back();
})->name('locale');



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('backend.dashbord.index');
    })->name('dashboard');

    Route::resource('post', PostController::class);
    Route::get('trash', [PostController::class, 'trash'])->name('trash');
    Route::delete('force-delete/{id}', [PostController::class, 'delete'])->name('post.force-delete');
    Route::get('restore/{id}', [PostController::class, 'restore'])->name('post.restore');
    Route::get('admin/about', [AboutController::class, 'index'])->name('backend.about.index');
    Route::post('admin/about', [AboutController::class, 'store'])->name('backend.about.store');

    Route::get('setting', [SettingController::class, 'index'])->name('setting.index');
    Route::post('setting/store', [SettingController::class, 'store'])->name('setting.store');

    Route::resource('Role',RoleController::class);







    // Route::get('users',[UserController::class,'index'])->name('users.index');
    // Route::get('users/create',[UserController::class,'create'])->name('users.create');
    // Route::get('users/edite/{user}',[UserController::class,'create'])->name('users.create');


});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

require __DIR__ . '/auth.php';
