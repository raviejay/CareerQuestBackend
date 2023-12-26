<?php

namespace App\Http\Controllers;

use App\Http\Requests\App_InfoRequest;
use App\Models\Applicant_Info;
use App\Models\Applicant_Acc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class App_InfoController extends Controller
{
    public function index()
    {
        return Applicant_Info::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(App_InfoRequest $request)
    {
                // Validate the request
            $validated = $request->validated();

            // Retrieve the authenticated user
            $user = Auth::user();

            // Check if user or acc_id is null
            if (!$user || !$user->acc_id) {
                return response()->json(['error' => 'Unable to retrieve user information for the authenticated user'], 500);
            }

            // Check if acc_id already exists
            if (Applicant_Info::where('acc_id', $user->acc_id)->exists()) {
                return response()->json(['error' => 'acc_id already exists'], 422);
            }

            // Add the acc_id to the validated data
            $validated['acc_id'] = $user->acc_id;

            // Create the Applicant_Info record
            $appInfo = Applicant_Info::create($validated);

            return $appInfo;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   
        return Applicant_Info::where('acc_id', $id)->firstOrFail();
    }
}
