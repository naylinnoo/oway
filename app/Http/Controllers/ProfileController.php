<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    //
    public function view()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('edit', compact('user'));
    }

    public function update(Request $request)
    {

        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ])->validate();

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        return redirect()->route('profile.view')->with(['message' => 'User information updated']);
    }

    public function updatePassword(Request $request)
    {

        if (Hash::check($request->old_password, Auth::user()->password)) {

            Validator::make($request->all(), [
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ])->validate();

            $user = Auth::user();
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('profile.view')->with(['message' => 'Password updated']);

        } else {
            return redirect()->back()->withErrors(['message' => "Your old password is incorrect"]);
        }
    }

    public function updatePhoto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:png|max:500|dimensions:ratio=1/1',
        ]);

        if ($validator->fails()) {
            return response()->json("Photo doesn't meet requirement");
        }

        $photo = Image::make($request->file('image'))->resize(400, 400)->encode('png');
        $hash = md5($photo->__toString());
        $path = "photos/{$hash}.jpg";
        $photo = Storage::disk('public')->put($path, $photo->__toString());

        $user = Auth::user();
        if($user->profile_image){
            Storage::disk('public')->delete($user->profile_image);
        }
        $user->profile_image = $path;
        $user->save();

        return response()->json($user->profile_image);
    }

    public function users()
    {
        $user = User::select('name', 'email')->get();
        return $user->toJson(JSON_PRETTY_PRINT);
    }
}
