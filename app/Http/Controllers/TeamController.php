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
}
