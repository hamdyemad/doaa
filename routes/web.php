<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEnd\HomeController;
use App\Http\Controllers\FrontEnd\VoiceController;
use App\Http\Controllers\FrontEnd\VideoController;
use App\Http\Controllers\FrontEnd\UploadController;
use App\Http\Controllers\FrontEnd\CategoryController;

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


// Example Routes
// Route::view('/', 'landing');
// Route::match(['get', 'post'], '/dashboard', function(){
//     return view('dashboard');
// });
// Route::view('/pages/slick', 'pages.slick');
// Route::view('/pages/datatables', 'pages.datatables');
// Route::view('/pages/blank', 'pages.blank');

Auth::routes();

Route::get('/maintaince', function() {
    if(get_setting('boolean-under_maintenance')) {
        return view('maintaince');
    } else {
        return redirect(route('frontend.home'));
    }
})->name('maintaince');

Route::group(['as' => 'frontend.', 'middleware' => 'maintaince'], function() {
    Route::get('/', [HomeController::class, 'home_page'])->name('home');
    Route::get('/search', [HomeController::class, 'search'])->name('search');
    Route::get('/send_notes/{id}', [HomeController::class, 'send_notes_page'])->name('send_notes_page');
    Route::post('/send_notes', [HomeController::class, 'send_notes'])->name('send_notes');
    Route::get('/categories/{category}', [CategoryController::class, 'category'])->name('category');
    Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');


  //Baik Edit
    Route::get('/contact' ,[HomeController::class,'contact'])->name('contact');
    Route::post('/contact' , [HomeController::class,'send_contact'])->name('send_contact');

    //voices
    Route::get('/audios', [VoiceController::class, 'index'])->name('audios');
    Route::get('/videos', [VideoController::class, 'index'])->name('videos');
  	Route::get('/videos/{id}', [VideoController::class, 'show'])->name('videos.show');

  //End Baik Edit

});

Route::post('upload', [UploadController::class,'store']);

