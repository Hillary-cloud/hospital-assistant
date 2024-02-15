<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index(){
        $feedbacks = Feedback::all();
        return view('admin.feedbacks.index',compact('feedbacks'));
    }

    public function create(){
        return view('admin.feedbacks.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'comment'=>'required|string',
        ]);
        $feedback = new Feedback();
        $feedback->name = $request->name;
        $feedback->comment = $request->comment;
        $feedback->save();

        return redirect()->back()->with('message','message sent');
    }
}
