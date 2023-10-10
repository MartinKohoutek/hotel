<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

class TeamController extends Controller
{
    public function AllTeam() {
        $team = Team::latest()->get();
        return view('backend.team.all_team', compact('team'));
    }

    public function AddTeam() {
        return view('backend.team.add_team');
    }

    public function StoreTeam(Request $request) {
        $image = $request->file('photo');
        $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(550, 670)->save('upload/team/'.$imageName);
        $saveUrl = 'upload/team/'.$imageName;
        
        Team::insert([
            'name' => $request->name,
            'position' => $request->position,
            'photo' => $saveUrl,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'pinterest' => $request->pinterest,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'alert-type' => 'success',
            'message' => 'New Team Member Added Successfully!',
        ];

        return redirect()->route('all.team')->with($notification);
    }

    public function EditTeam($id) {
        $team = Team::findOrFail($id);
        return view('backend.team.edit_team', compact('team'));
    }

    public function UpdateTeam(Request $request) {
        $team = Team::findOrFail($request->id);

        if ($request->file('photo')) {
            $image = $request->file('photo');
            @unlink($team->photo);
            $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(550, 670)->save('upload/team/'.$imageName);
            $saveUrl = 'upload/team/'.$imageName;
            $team->update(['photo' => $saveUrl]);
        }
        
        $team->update([
            'name' => $request->name,
            'position' => $request->position,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'pinterest' => $request->pinterest,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'alert-type' => 'success',
            'message' => 'Team Member Updated Successfully!',
        ];

        return redirect()->route('all.team')->with($notification);
    }

    public function DeleteTeam($id) {
        $team = Team::findOrFail($id);
        @unlink($team->photo);
        $team->delete();

        $notification = [
            'alert-type' => 'success',
            'message' => 'Team Member Deleted Successfully!',
        ];

        return back()->with($notification);
    }
}
