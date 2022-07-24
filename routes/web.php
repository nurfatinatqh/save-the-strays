<?php

use App\Models\Donation;
use App\Models\Pet;
use App\Models\User;
use App\Models\VolunteerCoverage;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    $happy = Pet::whereAdoptionStatus(true)->get();
    $sad = Pet::whereAdoptionStatus(null)->get();
    $adopter = User::whereRole('ADOPTER')->get();
    $coverageAreas = VolunteerCoverage::all();
    $coverage_list = $state_count = array();
    $funds = Donation::whereStatus('ongoing')->get();

    foreach($coverageAreas as $temp) {
        if (array_key_exists($temp->district, $coverage_list)) {
            $coverage_list[$temp->district]['total'] += 1;
        }
        else{
            $coverage_list = Arr::add($coverage_list, $temp->district, ['total' => 1, 'state' => $temp->state]);
        }
    }

    array_multisort(array_column($coverage_list, 'state'),  SORT_ASC,);

    foreach($coverageAreas as $coverage) {
        if (array_key_exists($coverage->state, $state_count)) {
            $state_count[$coverage->state]['total'] += 1;
        }
        else{
            if ($coverage->state == "JOHOR") $state_count = Arr::add($state_count, $coverage->state, ['total' => 1, 'lat' => 1.937344, 'lng' => 103.366585]);
            if ($coverage->state == "KEDAH") $state_count = Arr::add($state_count, $coverage->state, ['total' => 1, 'lat' => 6.155672, 'lng' => 100.569649]);
            if ($coverage->state == "KELANTAN") $state_count = Arr::add($state_count, $coverage->state, ['total' => 1, 'lat' => 6.125397, 'lng' => 102.238068]);
            if ($coverage->state == "MELAKA") $state_count = Arr::add($state_count, $coverage->state, ['total' => 1, 'lat' => 2.206414407, 'lng' => 102.2464615]);
            if ($coverage->state == "NEGERI SEMBILAN") $state_count = Arr::add($state_count, $coverage->state, ['total' => 1, 'lat' => 2.731813, 'lng' => 102.252502]);
            if ($coverage->state == "PAHANG") $state_count = Arr::add($state_count, $coverage->state, ['total' => 1, 'lat' => 3.974341, 'lng' => 102.438057]);
            if ($coverage->state == "PULAU PINANG") $state_count = Arr::add($state_count, $coverage->state, ['total' => 1, 'lat' => 5.285153, 'lng' => 100.456238]);
            if ($coverage->state == "PERAK") $state_count = Arr::add($state_count, $coverage->state, ['total' => 1, 'lat' => 4.693950, 'lng' => 101.117577]);
            if ($coverage->state == "PERLIS") $state_count = Arr::add($state_count, $coverage->state, ['total' => 1, 'lat' => 6.443589, 'lng' => 100.216599]);
            if ($coverage->state == "SELANGOR") $state_count = Arr::add($state_count, $coverage->state, ['total' => 1, 'lat' => 3.066695996, 'lng' => 101.5499977]);
            if ($coverage->state == "SABAH") $state_count = Arr::add($state_count, $coverage->state, ['total' => 1, 'lat' => 5.420404, 'lng' => 116.796783]);
            if ($coverage->state == "SARAWAK") $state_count = Arr::add($state_count, $coverage->state, ['total' => 1, 'lat' => 3.16640749, 'lng' => 113.0359838]);
            if ($coverage->state == "TERENGGANU") $state_count = Arr::add($state_count, $coverage->state, ['total' => 1, 'lat' => 4.233241596, 'lng' => 103.4478869]);
            if ($coverage->state == "WILAYAH PERSEKUTUAN MALAYSIA") $state_count = Arr::add($state_count, $coverage->state, ['total' => 1, 'lat' => 3.14309, 'lng' => 101.68653]);
        }
    }

    return view('index', compact('happy', 'sad', 'adopter', 'coverage_list', 'state_count', 'funds'));
})->name('home');

Route::get('/pet-care-and-health-tips-page', 'App\Http\Controllers\PetController@fetchTipsPage')->name('pet.tips');

Route::get('/volunteer-coverage-area', 'App\Http\Controllers\VolunteerCoverageController@fetchCoverageAreaPage')->name('view.coverage.area');
Route::get('/hello-pets', 'App\Http\Controllers\PetController@fetchPetProfilePage')->name('pet.profile');
Route::get('/hello-pets/search', 'App\Http\Controllers\PetController@search')->name('pet.search');
Route::get('/medical-fund', 'App\Http\Controllers\DonationController@fetchMedicalFundPage')->name('all.medical.fund');
Route::get('/medical-fund/{id}/donor-list', 'App\Http\Controllers\DonationController@fetchViewDonorsPage')->name('view.donors');

Route::middleware('auth')->group(function() {
    Route::get('/hello-pets/update-adoption-status/{id}', 'App\Http\Controllers\PetController@fetchUpdateAdoptionStatusPage')->name('update.adoption.status')->middleware('auth');
    Route::post('/hello-pets/update-adoption-status/{id}', 'App\Http\Controllers\PetController@updateAdoptionStatus')->name('store.adoption.status')->middleware('auth');
    Route::get('/user-profile/{id}', 'App\Http\Controllers\UserController@fetchProfilePage')->name('user.profile');
    Route::get('/user-profile/update/{id}', 'App\Http\Controllers\UserController@fetchEditProfileForm')->name('user.profile.update');
    Route::put('/user-profile/update/{id}', 'App\Http\Controllers\UserController@update')->name('user.profile.update');
    Route::get('/create-pet-profile', 'App\Http\Controllers\PetController@fetchCreatePetProfilePage')->name('create.pet.profile');
    Route::post('/create-pet-profile/{id}', 'App\Http\Controllers\PetController@createPet')->name('store.pet.profile');
    Route::get('/follow-up/{id}', 'App\Http\Controllers\FollowUpController@fetchFollowUpPage')->name('view.follow.up');
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
    Route::get('/medical-fund/{id}/my-list', 'App\Http\Controllers\DonationController@fetchMyMedicalFundPage')->name('my.medical.fund');
    Route::get('/medical-fund/{id}/my-list/view-details', 'App\Http\Controllers\DonationController@fetchMyMedicalFundDetailsPage')->name('my.medical.fund.details');
    Route::get('/medical-fund/{id}/my-list/view-details/get-update-form', 'App\Http\Controllers\DonationController@fetchUpdateFundInfoForm')->name('get.update.form');
    Route::put('/medical-fund/{id}/my-list/view-details/update-info', 'App\Http\Controllers\DonationController@updateFundInfo')->name('update.fund.info');
    Route::get('/medical-fund/{id}/my-list/view-details/get-update-case-form', 'App\Http\Controllers\DonationController@fetchUpdateCaseForm')->name('get.update.case.form');
    Route::put('/medical-fund/{id}/my-list/view-details/update-case', 'App\Http\Controllers\DonationController@updateCase')->name('update.fund.case');
});

// Route::get('/import_excel', 'App\Http\Controllers\ImportExcelController@index');
// Route::post('/import_excel/import', 'App\Http\Controllers\ImportExcelController@import');

// Route::get('/skills', function() {
//     return ['Laravel', 'Javascript', 'CSS'];
// });

// Route::get('/certificate', function () {

//     header('Content-type: image/jpeg');
//     $font='C:\Users\nurfa\OneDrive\Documents\GitHub\save-the-strays\public\assets\certificate\arial.ttf';
//     $path = 'assets\certificate\format.jpg';
//     $image=imagecreatefromjpeg($path);
//     $color=imagecolorallocate($image, 51, 51, 102);
//     $date=date('d F, Y');
//     imagettftext($image, 18, 0, 880, 188, $color,$font, $date);
//     $name="YOUTUBE";
//     imagettftext($image, 48, 0, 120, 520, $color,$font, $name);
//     imagejpeg($image,"storage/app/certificate/" . $name . ".jpg");
//     //imagejpeg($image);
//     imagedestroy($image);
//     $temp_path = 'storage/app/certificate/' . $name . '.jpg';
//     return response()->download($temp_path);
// });

require __DIR__.'/auth.php';
