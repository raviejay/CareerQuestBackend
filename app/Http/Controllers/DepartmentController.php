<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DepartmentRequest;
use App\Models\Departments;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Departments::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        $department = Departments::create($validated);

        return $department;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       return Departments::findOrFail($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, string $id)
    {
        $validated = $request->validated();

        $department = Departments::findOrFail($id);

        $department->update($validated);
        return $department;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Departments::findOrFail($id);

        $department->delete();

        return $department;
    }
}
