<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Request_AppRequest;
use App\Models\Request_Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Job;
use Illuminate\Support\Facades\Storage;

class RequestController extends Controller
{   


    public function showAllA()
    {
        return Request_Application::where('status', 'approve')->get();
    }
    public function showAllP()
    {
        return Request_Application::where('status', 'processing')->get();
    }
    public function showAllR()
    {
        return Request_Application::where('status', 'reject')->get();
    }
    public function showAlls()
    {
        // Assuming you have a model named Request_Application
        $data = Request_Application::with(['applicantInfo', 'job'])
        ->get();

        $processedData = [];

        foreach ($data as $application) {
            $applicantInfo = $application->applicantInfo;
            $job = $application->job;

            // Accessing the desired information
            $fname = $applicantInfo->Fname;
            $lname = $applicantInfo->Lname;
            $email = $applicantInfo->Email;

            $jobName = $job->job_name;

            // Process the data or use it as needed
            $processedData[] = [
                'fname' => $fname,
                'lname' => $lname,
                'email' => $email,
                'job_name' => $jobName,
            ];
        }

    return $processedData;
    }
    
    
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // Get the authenticated user's acc_id
      // Get the authenticated user's acc_id
      $accId = Auth::user()->acc_id;

      // Retrieve the app_id from the applicant_infos table using the acc_id
      $appId = DB::table('applicant_infos')->where('acc_id', $accId)->value('app_id');

      // Retrieve all data from the request__applications table for the given app_id
      $requestApplication = Request_Application::where('app_id', $appId)->firstOrFail();

      // Retrieve the job_id separately for another purpose
      $jobId = $requestApplication->job_id;

      // Use the job_id to get information from the jobs table
      $jobInformation = Job::findOrFail($jobId);

      // Return all data from the request_application and information of the job
      $response = [
        'JobName' => $jobInformation->job_name,
        'Status' => $requestApplication->status,
        'Document' => $requestApplication->Document,
        // Add more fields as needed
    ];

    // You can also include additional information from the $jobInformation or $requestApplication objects

    // Return the response array
    return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request_AppRequest $request)
    {
 
   // Validate the incoming request
   $validated = $request->validated();

   // Additional logic for the Document field
   if ($request->hasFile('Document')) {
       // Assuming you want to store the file in a public folder named 'documents'
       $validated['Document'] = $request->file('Document')->storePublicly('documents', 'public');
   }

   // Get the authenticated user's acc_id
   $accId = Auth::user()->acc_id;

   // Retrieve the app_id from the applicant_infos table using the acc_id
   $appId = DB::table('applicant_infos')->where('acc_id', $accId)->value('app_id');

   // Add the app_id to the validated data
   $validated['app_id'] = $appId;

   // Create a new record in the request__applications table
   $requestApplication = Request_Application::create($validated);
   $requestApplication->status = 'processing';
   $requestApplication->save();

   // You can add a response or redirect here based on your application logic
   return response()->json(['message' => 'Request Application created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       return Request_Application::findOrFail($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request_AppRequest $request, string $id)
    {   
        $validated = $request->validated();
        $requestApp = Request_Application::find($id);

        if (!$requestApp) {
            return response()->json(['message' => 'Request not found'], 404);
        }

        $requestApp->update($validated);
        return $requestApp;

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rapp = Request_Application::findOrFail($id);

        $rapp->delete();

        return $rapp;
    }
}
