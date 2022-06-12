<?php

use App\Http\Controllers\SocialController;
use Illuminate\Http\Request;
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
    return view('welcome');
});

Route::get('/dashboard', function (Request $request) {
    // dd($request->ip());

    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/login/{social}',[SocialController::class, 'socialLogin'])->where('social','twitter|facebook|linkedin|google|github|bitbucket');

Route::get('/login/{social}/callback', [SocialController::class, 'handleProviderCallback'])->where('social','twitter|facebook|linkedin|google|github|bitbucket');

require __DIR__.'/auth.php';
