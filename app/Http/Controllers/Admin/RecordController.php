<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Record;

class RecordController extends Controller
{
    public function index(Request $request)
    {

        return view('admin.records.index');
    }

    public function getPatient(Request $request)
    {
          // Retrieve the email from the query parameters
    $email = $request->query('email');
    
        // Validate the form data
        $request->validate([
            'email' => 'required|email', // Example validation rules
        ]);

        // Fetch user records based on the provided email
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // If user records are found, retrieve additional information from the records table
            $records = Record::where('user_id', $user->id)->get();
            
            // Pass the user and associated records to the view
            return view('admin.records.index', compact('records','request','email'));
        } else {
            // If user records are not found, redirect back with an error message
            return back()->with('message', 'User records not found for the provided email.');
        }
    }
    public function create()
    {

        return view('admin.records.create');
    }
    public function getPatientCreate(Request $request)
    {
        // Validate the form data
        $request->validate([
            'email' => 'required|email', // Example validation rules
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            # code...
            return view('admin.records.create', compact('user'));
        } else {
            // If user records are not found, redirect back with an error message
            return back()->with('message', 'User records not found for the provided email.');
        }
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            
            'diagnosis' => 'required', // Example validation rules
            'prescription' => 'required',
            'treatment_plan' => 'required',
            'test_result' => 'required',
            
        ]);

        $record = new Record();
        $record->user_id = $request->user_id;
        $record->diagnosis = $request->diagnosis;
        $record->prescription = $request->prescription;
        $record->treatment_plan = $request->treatment_plan;
        $record->test_result = $request->test_result;
        $record->symptoms = $request->symptoms;
        $record->follow_up = $request->follow_up;
        $record->save();

        return redirect()->back()->with('message', 'Patient record added ');
    }

    public function edit($id){
        $record = Record::where('id',$id)->first();
        return view('admin.records.edit',compact('record'));
    }

    public function update(Request $request,$id){
             // Validate the form data
             $request->validate([
            
                'diagnosis' => 'required', // Example validation rules
                'prescription' => 'required',
                'treatment_plan' => 'required',
                'test_result' => 'required',
                
            ]);

            $record = Record::where('id',$id)->first();
            $record->user_id = $request->user_id;
            $record->diagnosis = $request->diagnosis;
            $record->prescription = $request->prescription;
            $record->treatment_plan = $request->treatment_plan;
            $record->test_result = $request->test_result;
            $record->symptoms = $request->symptoms;
            $record->follow_up = $request->follow_up;
            $record->save();
    
            return redirect()->back()->with('message', 'Patient record updated ');
    }

    public function viewRecord($id){
      
        $record = Record::where('id',$id)->first();
        return view('admin.records.view-record',compact('record'));

    }
}
