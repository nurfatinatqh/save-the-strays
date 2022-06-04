<?php

use App\Models\Pet;
use App\Models\User;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
    $happy = Pet::whereAdoptionStatus(true)->get();
    $sad = Pet::whereAdoptionStatus(null)->get();
    $adopter = User::whereRole('ADOPTER')->get();
    return view('index', compact('happy', 'sad', 'adopter'));
})->name('home');

Route::get('/pet-care-and-health-tips-page', function () {
    $happy = Pet::whereAdoptionStatus(true)->get();
    $sad = Pet::whereAdoptionStatus(null)->get();
    return view('pet-care-and-health-tips', compact('happy', 'sad'));
})->name('pet.tips');

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/volunteer-coverage-area', 'App\Http\Controllers\VolunteerCoverageController@fetchCoverageAreaPage')->name('view.coverage.area');
Route::get('/hello-pets', 'App\Http\Controllers\PetController@fetchPetProfilePage')->name('pet.profile');
Route::get('/medical-fund', 'App\Http\Controllers\DonationController@fetchMedicalFundPage')->name('all.medical.fund');

Route::middleware('auth')->group(function() {
    Route::get('/hello-pets/update-adoption-status/{id}', 'App\Http\Controllers\PetController@fetchUpdateAdoptionStatusPage')->name('update.adoption.status')->middleware('auth');
    Route::post('/hello-pets/update-adoption-status/{id}', 'App\Http\Controllers\PetController@UpdateAdoptionStatus')->name('store.adoption.status')->middleware('auth');
    Route::get('/user-profile/{id}', 'App\Http\Controllers\UserController@fetchProfilePage')->name('user.profile');
    Route::get('/user-profile/update/{id}', 'App\Http\Controllers\UserController@fetchEditProfileForm')->name('user.profile.update');
    Route::put('/user-profile/update/{id}', 'App\Http\Controllers\UserController@update')->name('user.profile.update');
    Route::get('/create-pet-profile', 'App\Http\Controllers\PetController@fetchCreatePetProfilePage')->name('create.pet.profile');
    Route::post('/create-pet-profile/{id}', 'App\Http\Controllers\PetController@createPet')->name('store.pet.profile');
    Route::get('/follow-up', 'App\Http\Controllers\FollowUpController@fetchFollowUpPage')->name('view.follow.up');
    Route::get('/follow-up/new/{id}', 'App\Http\Controllers\FollowUpController@fetchNewFollowUpPage')->name('new.follow.up');
    Route::put('/follow-up/new/{id}', 'App\Http\Controllers\FollowUpController@submitNewFollowUp')->name('update.follow.up');
    Route::get('/update-coverage-area-page/{id}', 'App\Http\Controllers\VolunteerCoverageController@fetchUpdateCoveragePage')->name('update.coverage.area');
    Route::put('/update-coverage-area-page/{id}', 'App\Http\Controllers\VolunteerCoverageController@doUpdate')->name('submit.coverage.area');
    Route::get('/volunteer-registration-page/{id}', 'App\Http\Controllers\VolunteerCoverageController@fetchRegistrationPage')->name('register.as.volunteer');
    Route::put('/volunteer-registration-page/{id}', 'App\Http\Controllers\VolunteerCoverageController@doRegistration')->name('submit.volunteer.registration');
    Route::get('/start-new-medical-fund-page', 'App\Http\Controllers\DonationController@fetchStartNewMedicalFundPage')->name('start.medical.fund');
    Route::post('/start-new-medical-fund-page/{id}', 'App\Http\Controllers\DonationController@startNewFund')->name('submit.medical.fund');
    Route::get('/medical-fund/{id}/add-donor', 'App\Http\Controllers\DonationController@fetchAddDonorPage')->name('add.donor');
    Route::post('/medical-fund/{id}/add-donor', 'App\Http\Controllers\DonationController@addNewDonor')->name('submit.donor');
    Route::get('/medical-fund/{id}/donor-list', 'App\Http\Controllers\DonationController@fetchViewDonorsPage')->name('view.donors');
    Route::get('/medical-fund/{id}/my-list', 'App\Http\Controllers\DonationController@fetchMyMedicalFundPage')->name('my.medical.fund');
    Route::get('/medical-fund/{id}/my-list/view-details', 'App\Http\Controllers\DonationController@fetchMyMedicalFundDetailsPage')->name('my.medical.fund.details');
});

Route::get('/url', function(Request $request) {
    $path = $request->url;

    $url = Storage::disk('s3')->temporaryUrl(
        $path,
        now()->addMinutes(10)
    );

    return $url;
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/import_excel', 'App\Http\Controllers\ImportExcelController@index');
Route::post('/import_excel/import', 'App\Http\Controllers\ImportExcelController@import');

Route::get('/skills', function() {
    return ['Laravel', 'Javascript', 'CSS'];
});

Route::get('/certificate', function () {

    header('Content-type: image/jpeg');
    $font='C:\Users\nurfa\OneDrive\Documents\GitHub\save-the-strays\public\assets\certificate\arial.ttf';
    $path = 'assets\certificate\format.jpg';
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

require __DIR__.'/auth.php';
