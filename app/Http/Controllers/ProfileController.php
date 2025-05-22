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

        $userId = Auth::id();

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if (!empty($request->password)) {
            $updateData['password'] = Hash::make($request->password);
        }

        $updated = User::where('id', $userId)->update($updateData);

        if ($updated) {
            return response()->json([
                'status' => 'success',
                'message' => 'Profile updated successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No changes made or user not found.'
            ], 400);
        }
    }
}
