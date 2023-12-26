<?php

namespace App\Http\Controllers;

use App\Http\Requests\Emp_AccRequest;
use App\Models\Employer_Acc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Emp_AccController extends Controller
{
    public function index()
    {
        return Employer_Acc::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Emp_AccRequest $request)
    {
        $validated = $request->validated();
        
        $validated['password'] = Hash::make($validated['password']);

        $emp_acc = Employer_Acc::create($validated);

        return $emp_acc;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Employer_Acc::findOrFail($id);
    }
}
