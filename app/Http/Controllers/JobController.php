<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\JobRequest;
use App\Models\Job;

class JobController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Job::where('Available', true);
    
        if ($request->keyword) {
            $query->where('job_name', 'like', '%' . $request->keyword . '%');
        }
    
        $jobs = $query->get();
    
        return $jobs;
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        $job = Job::create($validated);

        return $job;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       return Job::findOrFail($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, string $id)
    {
        $validated = $request->validated();

        $job = Job::findOrFail($id);

        $job->update($validated);
        return $job;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $job = Job::findOrFail($id);

        $job->delete();

        return $job;
    }
}
