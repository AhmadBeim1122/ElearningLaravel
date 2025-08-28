<?php

namespace App\Http\Controllers;

use App\Models\feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedback = feedback::all();

        // return view('',compact('feedback'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatefeedback = Validator::make($request->all(),[
            'feedback_description' => 'required|min:20|max:500'
        ]);

        if($validatefeedback->fails()){
            return redirect()->back()
            ->withInput()
            ->withErrors($validatefeedback);
        }

        //checking database entry to avoid duplicasy
        
        $exists = Feedback::where('user_id', $request->userId)
            ->where('f_content', $request->feedback_description)
            ->exists();

        if ($exists) {
            return redirect()
                ->back()
                ->with('error', 'Duplicate feedback is not allowed')
                ->withInput();
        }


        //create Entry in database
        $feedback = Feedback::create([
            'f_content' => $request->feedback_description,
            'user_id' => $request->userId,
        ]);

        if($feedback){
            return redirect()->route('feedback.show',$request->userId)->with('success', 'Feedback Created Successful');
        }else {
            return redirect()
            ->back()
            ->withErrors([
                'feedback_description' => 'Invalid Feedback Content',
                ])
            ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $feedback = feedback::where('user_id', $id)->paginate(7);
        return view('user.feedback', compact('feedback'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatefeedback = Validator::make($request->all(),[
            'feedback_description' => 'required|min:20|max:500'
        ]);

        if($validatefeedback->fails()){
            return redirect()->back()
            ->withInput()
            ->withErrors($validatefeedback);
        }

        //checking database entry to avoid duplicasy
        
        $exists = Feedback::where('user_id', $request->userId)
            ->where('f_content', $request->feedback_description)
            ->exists();

        if ($exists) {
            return redirect()
                ->back()
                ->with('error', 'Duplicate feedback is not allowed')
                ->withInput();
        }


        $feedback = Feedback::where('id',$id)->update([
            'f_content' => $request->feedback_description
        ]);


        if($feedback){
            return redirect()->route('feedback.show',$request->userId)->with('success', 'Feedback Updated Successful');
        }else {
            return redirect()
            ->back()
            ->withErrors([
                'feedback_description' => 'Invalid Feedback Update',
                ])
            ->withInput();
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $feedback = Feedback::findOrFail($id);
        $userid = $feedback->user_id;
        $feedback->delete();

         if($feedback){
            return redirect()->route('feedback.show',$userid)->with('success', 'Feedback Deleted Successful');
        }
        
    }
}
