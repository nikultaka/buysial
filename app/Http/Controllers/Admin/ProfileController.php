<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $user_detail = User::find($user_id);
  
        $data = [];
        $data['name'] = isset($user_detail['name']) ? $user_detail['name'] : "";
        $data['email'] = isset($user_detail['email']) ? $user_detail['email'] : "";
        $data['logo'] = isset($user_detail['logo']) ? $user_detail['logo'] : "";
      
        return view('admin.profile.index', $data); 
    }

    public function updateProfile(Request $request)    
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|min:6',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = Auth::user();
        $logoutRequired = false;

        $updateData = [
            'name' => $request->name,
        ];

        if ($request->email !== $user->email) {
            $updateData['email'] = $request->email;
            $logoutRequired = true;
        }

        if (!empty($request->password)) {
            $updateData['password'] = Hash::make($request->password);
            $logoutRequired = true;
        }

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $uploadPath = 'uploads/users/';

            if (!File::exists(public_path($uploadPath))) {
                File::makeDirectory(public_path($uploadPath), 0755, true);
            }

            if (!empty($user->logo) && File::exists(public_path($user->logo))) {
                File::delete(public_path($user->logo));
            }

            $image->move(public_path($uploadPath), $imageName);
            $updateData['logo'] = $uploadPath . $imageName;
        }

        $updated = User::where('id', $user->id)->update($updateData);

        if ($updated) {
            return response()->json([
                'status' => 'success',
                'message' => 'Profile updated successfully.',
                'logout' => $logoutRequired,
                'user' => [
                    'name' => $updateData['name'],
                    'email' => $updateData['email'] ?? $user->email,
                    'logo' => $updateData['logo'] ?? $user->logo,
                ]
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No changes made or user not found.'
            ], 400);
        }
    }

    public function removeLogo(Request $request)
    {
        $user = Auth::user();
        $logoPath = public_path($request->logo);

        if (!empty($user->logo) && File::exists($logoPath)) {
            File::delete($logoPath);

            User::where('id', $user->id)->update(['logo' => null]);

            return response()->json([
                'status' => 'success',
                'message' => 'Logo removed successfully.',
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Logo not found or already removed.',
        ], 400);
    }

}
