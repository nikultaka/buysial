<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index() 
    {
        $countries = GlobalHelper::getAllCountries();
        $cities = GlobalHelper::getAllCities();
        $states = GlobalHelper::getAllStates();
    
        return view('admin.user.index', compact('countries', 'cities','states')); 
    }

    public function save(Request $request)
    {
        $post = $request->post();
        $hid = isset($post['hid']) ? intval($post['hid']) : null;
        $response['status'] = 0;
        $response['message'] = "Something went wrong!";

        $fields = [
            'name' => $request->name,
            'role' => $request->role,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => $request->password,
            'address' => $request->address,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'zip' => $request->zip,
            'company' => $request->company,
            'status' => $request->status,
        ];

        // Validation rules
        $rules = [
            'name' => 'required',
            'role' => 'required',
            'dob' => 'required|date',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'company' => 'required',
            'status' => 'required',
        ];
        if (!$hid) {
            $rules['password'] = 'required|min:6';
        }

        $msg = [
            'name.required' => 'Please enter the name',
            'role.required' => 'Please select the role',
            'dob.required' => 'Please enter the date of birth',
            'dob.date' => 'Please enter a valid date',
            'phone.required' => 'Please enter the phone number',
            'email.required' => 'Please enter the email address',
            'email.email' => 'Please enter a valid email address',
            'password.required' => 'Please enter the password',
            'password.min' => 'Password must be at least 6 characters',
            'address.required' => 'Please enter the address',
            'country.required' => 'Please select a country',
            'state.required' => 'Please enter the state',
            'city.required' => 'Please enter the city',
            'company.required' => 'Company Id is required',
            'status.required' => 'Please Select the status',
        ];

        $validator = Validator::make($fields, $rules, $msg);

        if (!$validator->fails()) {
            $existingEmailQuery = User::where('email', $request->email)
                ->where('isdeleted', '!=', 1);

            if ($hid) {
                $existingEmailQuery->where('id', '!=', $hid);
            }

            if ($existingEmailQuery->exists()) {
                return response()->json([
                    'status' => 0,
                    'message' => 'The email address is already in use by another user.',
                ]);
            }

            $user_insert_data = [
                'name' => $post['name'] ?? "",
                'role' => $post['role'] ?? "",
                'date_of_birth' => $post['dob'] ?? "",
                'phone' => $post['phone'] ?? "",
                'email' => $post['email'] ?? "",
                'address' => $post['address'] ?? "",
                'country' => $post['country'] ?? "",
                'state' => $post['state'] ?? "",
                'city' => $post['city'] ?? "",
                'zip' => $post['zip'] ?? "",
                'company_id' => $post['company'] ?? "",
                'is_delete' => $post['status'] ?? "",
            ];

            if (!$hid) {
                $user_insert_data['password'] = isset($post['password']) ? Hash::make($post['password']) : "";
            }

            if ($hid) {
                // Update existing record
                $user = User::where('id', $hid)->first();
                if ($user) {
                    // Avoid re-hashing the password if not changed
                    if (!empty($post['password'])) {
                        $user['password'] = Hash::make($post['password']);
                    }
                    $user->update($user_insert_data);
                    $response['status'] = 1;
                    $response['message'] = "User updated successfully!";
                } else {
                    $response['message'] = "User not found!";
                }
            } else {
                if (User::create($user_insert_data)) {
                    $response['status'] = 1;
                    $response['message'] = "User added successfully!";
                } else {
                    $response['message'] = "Failed to add Staff!";
                }
            }
        } else {
            $response['message'] = $validator->errors()->first();
        }

        return response()->json($response);
        exit;
    }

    public function userList()
    {
        // $users_data = User::select('staff.*','countries.name as country_name', 'states.name as state_name','cities.name as city_name')
        //     ->leftJoin('countries', 'staff.country', '=', 'countries.id')
        //     ->leftJoin('states', 'staff.state', '=', 'states.id')
        //     ->leftJoin('cities', 'staff.city', '=', 'cities.id')
        //     ->where('staff.isdeleted', '!=', 1)
        //     ->groupBy('staff.id') 
        //     ->get();


        // return Datatables::of($users_data)
        //     ->addIndexColumn()
        //     ->addColumn('address', function ($row) {
        //         $address = $row->address ?? 'N/A';
        //         $city = $row->city_name ?? 'N/A';
        //         $state = $row->state_name ?? 'N/A';
        //         $country = $row->country_name ?? 'N/A';
        //         return "$address, $city, $state, $country";
        //     })
        //     ->addColumn('roles', function ($row) {
        //         return $row->role_names;
        //     })

        //     ->addColumn('action', function ($row) {
        //         $action = '<div class="dropdown dropup d-flex justify-content-center">
        //                     <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        //                        <i class="bx bx-dots-vertical-rounded"></i>
        //                      </button>
        //                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
        //                          <a class="teamroleDelete dropdown-item" href="javascript:void(0);" data-id="' . $row->id . '">
        //                              <i class="bx bx-trash me-1"></i> Delete
        //                          </a>
        //                      </div>
        //                    </div>
        //                    <div class="actions text-center">
        //                         <a class="btn btn-sm bg-success-light" data-toggle="modal" href="javascript:void(0);" id="edit_staff" data-id="' . $row->id . '">
        //                            <i class="fe fe-pencil"></i>
        //                        </a>
        //                        <a data-toggle="modal" class="btn btn-sm bg-danger-light" href="javascript:void(0);" id="delete_staff" data-id="' . $row->id . '">
        //                            <i class="fe fe-trash"></i>
        //                        </a>
        //                    </div>';

        //         return $action;
        //     })
        //     ->rawColumns(['address', 'action', 'roles']) // Ensure HTML is not escaped
        //     ->make(true);
    }
}
