<?php

namespace App\Http\Controllers;

use App\Http\Requests\Emp_InfoRequest;
use App\Models\Employer_Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Emp_InfoController extends Controller
{
    public function index()
    {
        return Employer_Info::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Emp_InfoRequest $request)
    {
                // Validate the request
            $validated = $request->validated();

            // Retrieve the authenticated user
            $user = Auth::user();

            // Check if user or acc_id is null
            if (!$user || !$user->acce_id) {
                return response()->json(['error' => 'Unable to retrieve user information for the authenticated user'], 500);
            }

            // Check if acc_id already exists
            if (Employer_Info::where('acce_id', $user->acce_id)->exists()) {
                return response()->json(['error' => 'acce_id already exists'], 422);
            }

            // Add the acc_id to the validated data
            $validated['acce_id'] = $user->acce_id;

            // Create the Applicant_Info record
            $empInfo = Employer_Info::create($validated);

            return $empInfo;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Employer_Info::findOrFail($id);
    }
}
