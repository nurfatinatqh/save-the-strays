<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\DonorList;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonationController extends Controller
{
    public function fetchStartNewMedicalFundPage() {
        return view('start-new-medical-fun-page');
    }

    public function startNewFund(Request $request, $id) {
        $request->validate([
            'pet_name' => ['required', 'string', 'max:255'],
            'health_condition' => ['required'],
            'contact_info' => ['required', 'string'],
            'phone_number' => ['string'],
            'email' => ['string', 'email'],
            'bank' => ['required', 'string'],
            'bank_no' => ['required', 'string'],
            'bank_owner_name' => ['required', 'string'],
            'expected_amount' => ['required'],
            'current_amount' => ['required'],
            'pet_picture' => ['required', 'image'],
            'vet_analysis' => ['required', 'image'],
        ]);

        $path1 = "storage/image/donation/pet_picture";
        $file1= $request->file('pet_picture');
        $filename1= $file1->getClientOriginalName();
        //$file1-> move(public_path('storage/image/donation/pet_picture'), $filename1);

        $file1->storeAs(
            $path1,
            $filename1,
            's3'
        );

        $path2 = "storage/image/donation/vet_analysis";
        $file2= $request->file('vet_analysis');
        $filename2= $file2->getClientOriginalName();
        //$file2-> move(public_path('storage/image/donation/vet_analysis'), $filename2);

        $file2->storeAs(
            $path2,
            $filename2,
            's3'
        );

        $user = User::findOrFail($id);
        
        $user->volunteer()->save(new Donation([
            'pet_name' => $request['pet_name'],
            'health_condition' => $request['health_condition'],
            'contact_info' => $request['contact_info'],
            'phone_number' => $request['phone_number'],
            'email' => $request['email'],
            'bank' => $request['bank'],
            'bank_no' => $request['bank_no'],
            'bank_owner_name' => $request['bank_owner_name'],
            'expected_amount' => $request['expected_amount'],
            'current_amount' => $request['current_amount'],
            'pet_picture' => $path1."/".$filename1,
            'vet_analysis' => $path2."/".$filename2,
            'status' => "ongoing",
        ]));

        session()->flash('message', 'Successfully Started A New Medical Fund');

        return redirect()->back();
    }

    public function fetchMedicalFundPage() {
        $ongoing_list = Donation::whereStatus('ongoing')->get();
        $complete_list = Donation::whereStatus('complete')->get();
        $happy = Pet::whereAdoptionStatus(true)->get();
        $sad = Pet::whereAdoptionStatus(null)->get();
        return view('medical-fund-page', compact('ongoing_list', 'complete_list', 'happy', 'sad'));
    }

    public function fetchAddDonorPage($id) {
        $donation = Donation::findOrFail($id);
        return view('add-donor-page', compact('donation'));
    }

    public function addNewDonor(Request $request, $id) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'amount_of_donation' => ['required'],
        ]);

        $donation = Donation::findOrFail($id);

        $donation->current_amount = $donation->current_amount + $request['amount_of_donation'];
        if ($donation->current_amount >= $donation->expected_amount) { $donation->status = "complete"; }

        $donation->donors()->save(new DonorList([
            'name' => $request['name'],
            'amount_of_donation' => $request['amount_of_donation'],
        ]));

        $donation->save();

        session()->flash('message', 'Added Successfully');

        return redirect()->back();
    }

    public function fetchViewDonorsPage($id) {
        $donation = Donation::findOrFail($id);
        $happy = Pet::whereAdoptionStatus(true)->get();
        $sad = Pet::whereAdoptionStatus(null)->get();
        return view('view-donors-page', compact('donation', 'sad', 'happy'));
    }

    public function fetchMyMedicalFundPage ($id) {
        $ongoing_list = Donation::whereStatus('ongoing')->whereVolunteerId($id)->get();
        $complete_list = Donation::whereStatus('complete')->whereVolunteerId($id)->get();
        $happy = Pet::whereAdoptionStatus(true)->get();
        $sad = Pet::whereAdoptionStatus(null)->get();
        return view('view-my-fund-list', compact('ongoing_list', 'complete_list', 'happy', 'sad'));
    }

    public function fetchMyMedicalFundDetailsPage($id) {
        $donation = Donation::findOrFail($id);
        $happy = Pet::whereAdoptionStatus(true)->get();
        $sad = Pet::whereAdoptionStatus(null)->get();
        return view('view-my-fund-details', compact('happy', 'sad', 'donation'));
    }

    public function fetchUpdateFundInfoForm($id) {
        $donation = Donation::findOrFail($id);
        return view('update-fund-info', compact('donation'));
    }

    public function updateFundInfo(Request $request, $id) {

        $request->validate([
            'pet_name' => ['required', 'string', 'max:255'],
            'health_condition' => ['required'],
            'contact_info' => ['required', 'string'],
            'phone_number' => ['string'],
            'email' => ['string', 'email'],
            'bank' => ['required', 'string'],
            'bank_no' => ['required', 'string'],
            'bank_owner_name' => ['required', 'string'],
            'expected_amount' => ['required'],
            'current_amount' => ['required'],
        ]);

        $donation = Donation::findOrFail($id);

        if($request->file('pet_picture')){
            Storage::disk('s3')->delete($donation->pet_picture);

            $request->validate([
                'pet_picture' => ['required', 'image'],
            ]);

            $path1 = "storage/image/donation/pet_picture";
            $file1= $request->file('pet_picture');
            $filename1= $file1->getClientOriginalName();
            //$file1-> move(public_path('storage/image/donation/pet_picture'), $filename1);

            $file1->storeAs(
                $path1,
                $filename1,
                's3'
            );
            
            Donation::where('id',$id)->update([
                'pet_picture' => $path1."/".$filename1
            ]);
        }

        if($request->file('vet_analysis')){

            Storage::disk('s3')->delete($donation->vet_analysis);

            $request->validate([
                'vet_analysis' => ['required', 'image'],
            ]);

            $path2 = "storage/image/donation/vet_analysis";
            $file2= $request->file('vet_analysis');
            $filename2= $file2->getClientOriginalName();
            //$file2-> move(public_path('storage/image/donation/vet_analysis'), $filename2);

            $file2->storeAs(
                $path2,
                $filename2,
                's3'
            );
            
            Donation::where('id',$id)->update([
                'vet_analysis' => $path2."/".$filename2
            ]);
        }

        $donation->update([
            'pet_name' => $request['pet_name'],
            'health_condition' => $request['health_condition'],
            'contact_info' => $request['contact_info'],
            'phone_number' => $request['phone_number'],
            'email' => $request['email'],
            'bank' => $request['bank'],
            'bank_no' => $request['bank_no'],
            'bank_owner_name' => $request['bank_owner_name'],
            'expected_amount' => $request['expected_amount'],
            'current_amount' => $request['current_amount'],
        ]);

        session()->flash('message', 'Successfully Update');

        return redirect()->back();
    }

    public function fetchUpdateCaseForm($id) {
        $donation = Donation::findOrFail($id);
        return view('update-fund-case', compact('donation'));
    }

    public function updateCase(Request $request, $id) {

        $request->validate([
            'health_condition' => ['required'],
            'updated_condition' => ['required', 'image'],
            'receipt' => ['required', 'image'],
        ]);

        $donation = Donation::findOrFail($id);

        Storage::disk('s3')->delete($donation->updated_condition);

        $path1 = "storage/image/donation/updated_condition";
        $file1= $request->file('updated_condition');
        $filename1= $file1->getClientOriginalName();
        //$file1-> move(public_path('storage/image/donation/updated_condition'), $filename1);

        $file1->storeAs(
            $path1,
            $filename1,
            's3'
        );

        $path2 = "storage/image/donation/receipt";
        $file2= $request->file('receipt');
        $filename2= $file2->getClientOriginalName();
        //$file2-> move(public_path('storage/image/donation/receipt'), $filename2);

        $file2->storeAs(
            $path2,
            $filename2,
            's3'
        );
            
        Donation::where('id',$id)->update([
            'health_condition' => $request['health_condition'],
            'updated_condition' => $path1."/".$filename1,
            'receipt' => $path2."/".$filename2,

        ]);

        session()->flash('message', 'Successfully Update');

        return redirect()->route('my.medical.fund.details', $donation->id);
        
    }
}
