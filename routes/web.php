<?php

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
    return view('index');
});

Route::get('/pet-care-and-health-tips-page', function () {
    return view('pet-care-and-health-tips');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/certificate', function () {

    header('Content-type: image/jpeg');
    $font='C:\Users\nurfa\OneDrive\Documents\Save-The-Strays\storage\app\certificate\arial.ttf';
    $path = 'storage\app\certificate\format.jpg';
    $image=imagecreatefromjpeg($path);
    $color=imagecolorallocate($image, 51, 51, 102);
    $date=date('d F, Y');
    imagettftext($image, 18, 0, 880, 188, $color,$font, $date);
    $name="YOUTUBE";
    imagettftext($image, 48, 0, 120, 520, $color,$font, $name);
    imagejpeg($image,"storage/app/certificate/" . $name . ".jpg");
    //imagejpeg($image);
    imagedestroy($image);
    $temp_path = 'storage/app/certificate/' . $name . '.jpg';
    return response()->download($temp_path);
});

Route::get('/import_excel', 'App\Http\Controllers\ImportExcelController@index');
Route::post('/import_excel/import', 'App\Http\Controllers\ImportExcelController@import');

require __DIR__.'/auth.php';
