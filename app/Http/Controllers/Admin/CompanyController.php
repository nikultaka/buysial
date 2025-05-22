<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;


class CompanyController extends Controller
{
    public function index()
    {
        return view('admin.company.index');
    }

    public function save(Request $request)
    {
        $post = $request->post();
        $hid = isset($post['hid']) ? intval($post['hid']) : null;

        $response = [
            'status' => 0,
            'message' => 'Something went wrong!',
        ];

        $fields = [
            'company_name' => $request->company_name,
            'company_code' => $request->company_code,
            'company_email' => $request->company_email,
            'company_phone' => $request->company_phone,
            'company_address' => $request->company_address,
            'company_city' => $request->company_city,
            'company_state' => $request->company_state,
            'company_zip' => $request->company_zip,
            'company_country' => $request->company_country,
            'company_website' => $request->company_website,
            'status' => $request->status ?? 0,
        ];

        $rules = [
            'company_name' => 'required',
            'company_code' => 'required|unique:companies,company_code' . ($hid ? ',' . $hid : ''),
            'company_email' => 'required|email|unique:companies,company_email' . ($hid ? ',' . $hid : ''),
            'company_phone' => 'required|unique:companies,company_phone' . ($hid ? ',' . $hid : ''),
            'company_address' => 'required',
            'company_city' => 'required',
            'company_state' => 'required',
            'company_zip' => 'required',
            'company_country' => 'required',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB max
        ];

        $validator = Validator::make($fields, $rules);

        if ($validator->fails()) {
            $response['message'] = $validator->errors()->first();
            return response()->json($response);
        }

        // Handle image upload
        if ($request->hasFile('company_logo')) {
            $logo = $request->file('company_logo');
            $logoName = time() . '_' . uniqid() . '.' . $logo->getClientOriginalExtension();
            
            // Create directory if it doesn't exist
            $uploadPath = public_path('uploads/companies');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            
            $logo->move($uploadPath, $logoName);
            $fields['company_logo'] = $logoName;

            // Delete old image if exists
            if ($hid) {
                $oldCompany = Company::find($hid);
                if ($oldCompany && $oldCompany->company_logo) {
                    $oldImagePath = $uploadPath . '/' . $oldCompany->company_logo;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            }
        }

        if ($hid) {
            $company = Company::find($hid);
            if ($company) {
                $company->update($fields);
                $response['status'] = 1;
                $response['message'] = 'Company updated successfully!';
            } else {
                $response['message'] = 'Company not found!';
            }
        } else {
            $created = Company::create($fields);
            if ($created) {
                $response['status'] = 1;
                $response['message'] = 'Company added successfully!';
            }
        }

        return response()->json($response);
    }

    public function list()
    {
        $companydata = DB::table('companies')
            ->select('companies.*')
            ->where('companies.isdeleted', 0)
            ->get();

        return Datatables::of($companydata)
            ->addIndexColumn()
            ->addColumn('status', function ($company) {
                return $company->status == 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('action', function ($row) {
                $action = '<div class="dropdown dropup d-flex justify-content-center">
                    <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <i class="bx bx-dots-vertical-rounded"></i>
                     </button>
                     <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3" style="">
                     <a class="dropdown-item" href="javascript:void(0);" data-id="' . $row->id . '" id="companyEdit"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                     <a class="dropdown-item" href="javascript:void(0);" data-id="' . $row->id . '" id="companyDelete"><i class="bx bx-trash me-1"></i> Delete</a>
                     </div>
                   </div>';
                return $action;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
        exit;
    }

    public function delete(Request $request)
    {
        $post = $request->post();
        $id = isset($post['id']) ? $post['id'] : "";
        $response['status']  = 0;
        $response['message']  = "Somthing Goes Wrong!";

        if (is_numeric($id)) {
            $delete_company = Company::where('id', $id)->update(['isdeleted' => 1]);
            if ($delete_company) {
                $response['status'] = 1;
                $response['message'] = 'Company deleted successfully.';
            } else {
                $response['message'] = 'something went wrong company not deleted.';
            }
        }
        echo json_encode($response);
        exit;
    }

    public function edit(Request $request)
    {
        $id = $request->query('id');
        // Initialize response
        $response = [
            'status' => 0,
            'message' => 'Something went wrong!'
        ];

        // Check if ID is valid
        if (is_numeric($id)) {
            $companydata = Company::where('id', $id)->first();
            if ($companydata) {
                $response = [
                    'status' => 1,
                    'companydata' => $companydata
                ];
            }
        }

        return response()->json($response);
        exit; // Proper JSON response
    }
}
