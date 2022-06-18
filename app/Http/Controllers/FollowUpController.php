<?php

namespace App\Http\Controllers;

use App\Models\FollowUp;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowUpController extends Controller
{
    public function fetchFollowUpPage($id) {
        $followUps = FollowUp::whereVolunteerId($id)->orWhere(['adopter_id' => $id])->orderBy('id')->get();

        $petAdopted = Pet::whereVolunteerId($id)->orWhere(['adopter_id' => $id])->get();
        return view('view-follow-up', compact('followUps', 'petAdopted'));
    }

    public function fetchNewFollowUpPage($id) {

        $followUp = FollowUp::find($id);
        return view('new-follow-up', compact('followUp'));
    }

    public function submitNewFollowUp(Request $request, $id) {

        $request->validate([
            'health_condition' => ['required', 'string'],
            'picture' => ['required', 'image'],
        ]);

        $path = "storage/image/follow-up";
        $file= $request->file('picture');
        $filename= $file->getClientOriginalName();
        //$file-> move(public_path('storage/image/follow-up'), $filename);

        $file->storeAs(
            $path,
            $filename,
            's3'
        );

        $followUp = FollowUp::find($id);

        $followUp->health_condition = $request->health_condition;
        $followUp->picture =  $path."/".$filename;
        
        $followUp->save();

        session()->flash('message', 'Detail Submitted!');
        return redirect()->route('view.follow.up', Auth::user()->id);
    }
}
