<?php

namespace App\Http\Controllers;

use App\Models\Adopter;
use App\Models\FollowUp;
use App\Models\Pet;
use App\Models\User;
use App\Models\Volunteer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PetController extends Controller
{
    public function fetchCreatePetProfilePage() {
        return view('create-pet-profile');
    }

    public function fetchPetProfilePage() {
        $happy = Pet::whereAdoptionStatus(true)->get();
        $sad = Pet::whereAdoptionStatus(null)->get();
        $pets = Pet::whereAdoptionStatus(null)->get();
        return view('pet-profile', compact('pets', 'happy', 'sad'));
    }

    public function search(Request $request) {
        $happy = Pet::whereAdoptionStatus(true)->get();
        $sad = Pet::whereAdoptionStatus(null)->get();

        if ($request->type == "CAT") $request->type = "Cat";
        if ($request->type == "DOG") $request->type = "Dog";
        if ($request->gender == "MALE") $request->gender = "Male";
        if ($request->gender == "FEMALE") $request->gender = "Female";

        if ($request->gender != null) {
            if ($request->type != null) {
                if ($request->state != null) {
                    if ($request->city != null) {
                        $pets = Pet::whereAdoptionStatus(null)->whereGender($request->gender)->whereType($request->type)->whereState($request->state)->whereCity($request->city)->get();
                    }
                    else {
                        $pets = Pet::whereAdoptionStatus(null)->whereGender($request->gender)->whereType($request->type)->whereState($request->state)->get();
                    }
                }
                else {
                    $pets = Pet::whereAdoptionStatus(null)->whereGender($request->gender)->whereType($request->type)->get();
                }
            }
            else {
                if ($request->state != null) {
                    if ($request->city != null) {
                        $pets = Pet::whereAdoptionStatus(null)->whereGender($request->gender)->whereState($request->state)->whereCity($request->city)->get();
                    }
                    else {
                        $pets = Pet::whereAdoptionStatus(null)->whereGender($request->gender)->whereState($request->state)->get();
                    }
                }
                else {
                    $pets = Pet::whereAdoptionStatus(null)->whereGender($request->gender)->get();
                }
            }
        }
        else {
            if ($request->type != null) {
                if ($request->state != null) {
                    if ($request->city != null) {
                        $pets = Pet::whereAdoptionStatus(null)->whereType($request->type)->whereState($request->state)->whereCity($request->city)->get();
                    }
                    else {
                        $pets = Pet::whereAdoptionStatus(null)->whereType($request->type)->whereState($request->state)->get();
                    }
                }
                else {
                    $pets = Pet::whereAdoptionStatus(null)->whereType($request->type)->get();
                }
            }
            else {
                if ($request->state != null) {
                    if ($request->city != null) {
                        $pets = Pet::whereAdoptionStatus(null)->whereState($request->state)->whereCity($request->city)->get();
                    }
                    else {
                        $pets = Pet::whereAdoptionStatus(null)->whereState($request->state)->get();
                    }
                }
                else {
                    $pets = Pet::whereAdoptionStatus(null)->get();
                }
            }
        }

        return view('pet-profile', compact('pets', 'happy', 'sad'));
    }

    public function createPet(Request $request, $id) {

        $request->validate([
            'name' => ['required', 'string', 'max:20'],
            'type' => ['required', 'string'],
            'gender' => ['required', 'string'],
            'health_condition' => ['required', 'string'],
            'location' => ['required', 'string'],
            'state' => ['required', 'string'],
            'city' => ['required', 'string'],
            'phone_number' => ['required','string', 'max:12'],
            'pet_picture' => ['required', 'image'],
        ]);

        $path = "storage/image/pet";
        $file= $request->file('pet_picture');
        $filename= $file->getClientOriginalName();
        //$file-> move(public_path('storage/image/pet'), $filename);

        $file->storeAs(
            $path,
            $filename,
            's3'
        );

        $user = User::findOrFail($id);
        
        $user->volunteer()->save(new Pet([
            'name' => $request['name'],
            'type' => $request['type'],
            'gender' => $request['gender'],
            'volunteer_id' => $id,
            'health_condition' => $request['health_condition'],
            'location' => $request['location'],
            'state' => $request['state'],
            'city' => $request['city'],
            'phone_number' => $request['phone_number'],
            'pet_picture' => $path."/".$filename,
        ]));

        session()->flash('message', 'Successfully Created  A New Pet Profile For '.$request['name']. '!');

        return redirect()->back();
    }

    public function fetchUpdateAdoptionStatusPage($id) {
        $pet = Pet::findOrFail($id);
        return view('update-adoption-status', compact('pet'));
    }

    public function updateAdoptionStatus(Request $request, $id) {

        // $first = Carbon::parse($request->adoption_date)->startOfMonth()->addMonth(1);
        // $second = Carbon::parse($request->adoption_date)->startOfMonth()->addMonth(2);
        // $third = Carbon::parse($request->adoption_date)->startOfMonth()->addMonth(3);

        // return $first . $second . $third;

        $request->validate([
            'pet_picture' => ['required', 'image'],
        ]);

        $pet = Pet::findOrFail($id);

        $path = "storage/image/pet";
        $file= $request->file('pet_picture');
        $filename= $file->getClientOriginalName();
        //$file-> move(public_path('storage/image/pet'), $filename);

        $file->storeAs(
            $path,
            $filename,
            's3'
        );

        $user = Auth::user();

        $pet->adoption_date = $request->adoption_date;
        $pet->adoption_status = true;
        $pet->pet_picture =  $path."/".$filename;
        
        $user->adopter()->save($pet);

        if (count($pet->followUp) > 0 ) {
            foreach ($pet->followUp as $followUp) {
                $followUp->delete();
            }

            for ($i=0; $i<=2; $i++) { 
                $followUp = $user->adopter_FU()->save(new FollowUp([
                    'follow_up_date' => Carbon::parse($request->adoption_date)->startOfMonth()->addMonth($i)->toDateTimeString(),
                ]));
                $pet->followUp()->save($followUp);
                $volunteer = User::find($pet->volunteer_id);
                $volunteer->volunteer_FU()->save($followUp);
            }
        }
        else {
            for ($i=0; $i<=2; $i++) { 
                $followUp = $user->adopter_FU()->save(new FollowUp([
                    'follow_up_date' => Carbon::parse($request->adoption_date)->startOfMonth()->addMonth($i)->toDateTimeString(),
                ]));
                $pet->followUp()->save($followUp);
                $volunteer = User::find($pet->volunteer_id);
                $volunteer->volunteer_FU()->save($followUp);
            }
        }

        session()->flash('message', 'Successfully Updated The Adoption Status  A For '.$pet->name. '!');
        return redirect()->route('view.follow.up', $user->id);
    }

    public function fetchTipsPage() {
        $happy = Pet::whereAdoptionStatus(true)->get();
        $sad = Pet::whereAdoptionStatus(null)->get();
        return view('pet-care-and-health-tips', compact('happy', 'sad'));
    }
}