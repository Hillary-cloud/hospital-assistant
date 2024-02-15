<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use App\Models\Consultation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\DeclineNotification;
use App\Notifications\ApprovalNotification;
use App\Notifications\CreateConsultationNotification;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ConsultationController extends Controller
{
    //
    public function index(Request $request)
    {
        $user = auth()->user();
    
        if ($user->hasRole('patient')) {
            // User has the 'patient' role, fetch only their consultations
            $consultations = Consultation::where('user_id', $user->id)->get();
        } else {
            // User does not have the 'patient' role, fetch all consultations
            $consultations = Consultation::all();
        }
    
        return view('admin.consultations.index', compact('consultations'));
    }

    public function create(){
        return view('admin.consultations.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'symptoms'=>'required|string|min:10',
        ]);

        $consultation = new Consultation;
        $consultation->user_id = auth()->user()->id;
        $consultation->consultation_date = $request->consultation_date;
        $consultation->symptoms = $request->symptoms;
        $consultation->status = 'Waiting for approval';
        $consultation->save();
        
        notify(new CreateConsultationNotification($consultation));
       
        return redirect()->route('consultations.index')->with('message', 'Appointment created');
    }

    public function edit(Request $request, Consultation $consultation){
       
        $consultation = Consultation::findOrFail($consultation->id);
        return view('admin.consultations.edit',compact('consultation'));
    }

    public function update(Request $request,Consultation $consultation){
        $this->validate($request,[
            'symptoms'=>'required|string|min:10',
        ]);

        $consultation = Consultation::findOrFail($consultation->id);
        $consultation->consultation_date = $request->consultation_date;
        $consultation->symptoms = $request->symptoms;
        $consultation->status = 'Waiting for approval';
        $consultation->save();

        return redirect()->route('consultations.index')->with('message', 'Appointment re-scheduled');
    }

    public function destroy($id){
       $consultation = Consultation::findOrFail($id);
       $consultation->delete();
        return redirect()->back()->with('message','Appointment cancelled');
    }

    public function approve(Request $request,$id)
    {
        try {
            $consultation = Consultation::findOrFail($id);

            $user = $consultation->user;

            $consultation->status = 'Approved';
            $consultation->save();
            
            $user->notify(new ApprovalNotification($consultation));
            return redirect()->back()->with('message', 'Consultation approved');
        } catch (ModelNotFoundException $e) {
            // Consultation not found, handle the error (e.g., redirect to an error page)
            return redirect()->back()->with('error', 'Consultation not found');
        }
    }

    public function decline(Request $request,$id){
       

        $consultation = Consultation::findOrFail($id);

        $user = $consultation->user;

        $consultation->status = 'Declined';
        $consultation->save();
        $user->notify(new DeclineNotification($consultation));
        return redirect()->back();
    }

    public function viewConsultation($id){
      
        $consultation = Consultation::where('id',$id)->firstOrFail();
        $payment = Payment::where('consultation_id',$id)->first();
        return view('admin.consultations.view-consultation',compact('consultation','payment'));

    }

}
