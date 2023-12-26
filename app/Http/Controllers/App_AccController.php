<?php

namespace App\Http\Controllers;

use App\Http\Requests\App_AccRequest;
use App\Models\Applicant_Acc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class App_AccController extends Controller
{
    public function index()
    {
        return Applicant_Acc::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(App_AccRequest $request)
    {
        $validated = $request->validated();
        
        $validated['password'] = Hash::make($validated['password']);

        $app_acc = Applicant_Acc::create($validated);

        return $app_acc;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Applicant_Acc::findOrFail($id);
    }
}
