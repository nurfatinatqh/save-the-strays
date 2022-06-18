<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use App\Models\VolunteerCoverage;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class VolunteerCoverageController extends Controller
{
    public function fetchUpdateCoveragePage($id)
    {
        $coverageArea = VolunteerCoverage::whereVolunteerId($id)->first();
        return view('update-coverage-area-page', compact('coverageArea'));
    }

    public function doUpdate(Request $request, $id) {

        $request->validate([
            'street' => ['required', 'string'],
            'area' => ['required', 'string'],
            'district' => ['required', 'string'],
            'state' => ['required', 'string'],
        ]);
        
        $coverageArea = VolunteerCoverage::findOrFail($id);

        $coverageArea->street = $request->street;
        $coverageArea->area = $request->area;
        $coverageArea->district = $request->district;
        $coverageArea->state = $request->state;

        $coverageArea->save();

        session()->flash('message', 'Successfully Updated The New Coverage Area');
        return redirect()->route('update.coverage.area', $coverageArea->volunteer_id);
    }

    public function fetchRegistrationPage($id)
    {
        return view('volunteer-registration-page');
    }

    public function doRegistration(Request $request, $id) {

        $request->validate([
            'street' => ['required', 'string'],
            'area' => ['required', 'string'],
            'district' => ['required', 'string'],
            'state' => ['required', 'string'],
        ]);

        $user = User::findOrFail($id);
        $user->role = "VOLUNTEER";
        $user->save();

        $user->coverageArea()->save(new VolunteerCoverage([
            'street' => $request['street'],
            'area' => $request['area'],           
            'district' => $request['district'],
            'state' => $request['state'],     
        ]));

        session()->flash('message', 'Successfully Registeer as a New Volunteer');
        return redirect()->route('update.coverage.area', $user['id']);
    }

    public function fetchCoverageAreaPage() {
        $coverageAreas = VolunteerCoverage::all();
        $happy = Pet::whereAdoptionStatus(true)->get();
        $sad = Pet::whereAdoptionStatus(null)->get();
        $coverage_list = $state_count = array();

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

        return view('view-coverage-area-page', compact('happy', 'sad', 'coverage_list', 'state_count'));
    }
}
