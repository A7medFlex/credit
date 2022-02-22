<?php

use App\Models\User;
use App\Http\Controllers\askingHelp;
use App\Http\Controllers\EditProfile;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Managment;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\postComments;
use App\Http\Controllers\PostController;
use App\Http\Controllers\posts\PostsController;
use App\Http\Controllers\profileUser;
use App\Http\Controllers\wholePost;
use App\Models\landingPage;
use App\Models\diseasedPage;
use App\Models\homelessModel;
use App\Models\childrenModel;
use App\Models\storiesPage;
use App\Models\FAQsPage;
use App\Models\aboutPage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    $intro = landingPage::where('sec_title', 'like', 'intro')->first();
    $landing = landingPage::all();
    return view('welcome', compact('intro', 'landing'));
});

Route::get('/diseased', function () {
    $diseased = diseasedPage::all();
    $name = "Diseased";
    $allusers = User::all();
    return view('diseased', compact('diseased', 'name','allusers'));
});
Route::get('/homeless', function () {
    $homeless = homelessModel::all();
    $name = "Homeless";
    $allusers = User::all();
    return view('homeless', compact('homeless', 'name','allusers'));
});
Route::get('/children', function () {
    $children = childrenModel::all();
    $name = "Children";
    $allusers = User::all();
    return view('children', compact('children', 'name','allusers'));
});
Route::get('/stories', function () {
    $stories = storiesPage::all();
    $name = "Stories";
    $allusers = User::all();
    return view('stories', compact('stories', 'name','allusers'));
});
Route::get('/FAQs', function () {
    $faq = FAQsPage::all();
    $name = "FAQs";
    $allusers = User::all();
    return view('faq', compact('faq', 'name','allusers'));
});
Route::get('/about', function () {
    $about = aboutPage::all();
    $name = "About";
    $allusers = User::all();
    return view('about', compact('about', 'name','allusers'));
});
Route::get('/how-to-use', function(){
    return view('comming-soon');
})->name('soon');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'App\Http\Controllers\DashboardController@index')
        ->name('dashboard');
    Route::post('/home', 'App\Http\Controllers\DashboardController@index')
        ->name('dashboard');
    Route::get('/edit-profile/{currId}', [EditProfile::class, 'index'])
        ->name('edit-profile');
    Route::put('profile/update', [EditProfile::class, 'update'])
        ->name('update-profile');
    Route::put('/profile/update-password', [EditProfile::class, 'update_pass'])
        ->name('update-pass');
    // routes to manage asking help posts
    Route::get('/asking-help', [askingHelp::class, 'index'])
    ->name('asking-help');
    Route::get('/profile/{id}', [profileUser::class, 'profile'])->name('user-profile');

    Route::get('/post/{id}', [wholePost::class, 'post'])->name('single-post');

    Route::get('/single-ask/{id}', [askingHelp::class, 'single'])->name('single-ask');
    Route::post('/ask/{id}/comment', [askingHelp::class, 'comment'])->name('ask-comment');
    Route::post('/post/{id}/comment', [postComments::class, 'comment'])->name('post-comment');
    // settings page
    Route::get('/website-settings', [wholePost::class, 'settings'])->name('website-settings');


});
Route::group(['middleware' => ['auth','role:donator']], function () {
    Route::post('posts', [PostController::class, 'store'])->name('store-post');
});
Route::group(['middleware' => ['auth','role:user']], function () {
    // route for asking help putting the data
    Route::post('/ask-help', [askingHelp::class, 'store'])->name('post-asking-help');

});

Route::group(['middleware' => ['auth','role:admin']], function () {
    // managment page
    Route::get('/management', [Managment::class, 'index'])->name('manage');
    Route::post('/managment/landing', [Managment::class, 'landing'])->name('manage-landing');
    Route::post('/managment/diseased', [Managment::class, 'diseased'])->name('manage-diseased');
    Route::post('/managment/homeless', [Managment::class, 'homeless'])->name('manage-homeless');
    Route::post('/managment/children', [Managment::class, 'children'])->name('manage-children');
    Route::post('/managment/stories', [Managment::class, 'stories'])->name('manage-stories');
    Route::post('/managment/FAQs', [Managment::class, 'FAQs'])->name('manage-FAQs');
    Route::post('/managment/about', [Managment::class, 'about'])->name('manage-about');
    Route::post('/managment/theme', [Managment::class, 'theme'])->name('manage-theme');
    // edit pages
    Route::put('/managment/intro/edit', [Managment::class, 'editIntro'])->name('edit-intro');
    Route::put('/managment/landing/edit/{id}', [Managment::class, 'editLanding'])->name('edit-landing');
    Route::put('/managment/diseased/edit/{id}', [Managment::class, 'editDiseased'])->name('edit-diseased');
    Route::put('/managment/homeless/edit/{id}', [Managment::class, 'editHomeless'])->name('edit-homeless');
    Route::put('/managment/children/edit/{id}', [Managment::class, 'editChildren'])->name('edit-children');
    Route::put('/managment/FAQs/edit/{id}', [Managment::class, 'editFAQs'])->name('edit-FAQs');
    Route::put('/managment/stories/edit/{id}', [Managment::class, 'editStories'])->name('edit-stories');
    Route::put('/managment/about/edit/{id}', [Managment::class, 'editAbout'])->name('edit-about');

});


// manage lang
Route::get('lang-switch/{apprev}', [LanguageController::class, 'switch'])->name('switchLang');
// manage paypal
Route::post('/paypal', [PaypalController::class, 'index'])->name('paypal');
Route::get('/paypal/return', [PaypalController::class, 'return'])->name('paypal-return');
Route::get('/paypal/cancel', [PaypalController::class, 'cancel'])->name('paypal-cancel');
Route::get('/donation', function () {
    $allusers = User::all();
    return view('donation',compact('allusers'));
})->name('pay');

require __DIR__ . '/auth.php';
