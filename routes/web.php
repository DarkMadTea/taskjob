<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
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

//Route::get('/', function () {
//    return view('index');
//})->name('home');

Route::get('/', function () {
    $files = DB::table('fileuploads')->get();
    return view('index', ['files' => $files]);
})->name('home');

Route::resource('fileupload', Controllers\FileuploadController::class);

Route::get('/download/{file}', [Controllers\FileuploadController::class, 'download']);

//Route::get('file', [Controllers\UploadController::class, 'show']);
//Route::post('file', [Controllers\UploadController::class, 'upload'])->name('file.upload');
