<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
      
        return view('admin.profile.index', $data); 
    }

    public function updateProfile(Request $request)    
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|min:6',
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

        $updated = User::where('id', $user->id)->update($updateData);

        if ($updated) {
            return response()->json([
                'status' => 'success',
                'message' => 'Profile updated successfully.',
                'user' => [
                    'name' => $request->name,
                    'email' => $request->email,
                ],
                'logout' => $logoutRequired
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No changes made or user not found.'
            ], 400);
        }
    }

}
