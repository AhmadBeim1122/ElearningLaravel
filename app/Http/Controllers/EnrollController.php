<?php

namespace App\Http\Controllers;

use App\Models\Enroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EnrollController extends Controller
{
    public function enrollcourse(Request $request){
        // 1. Validation
        $validateuser = Validator::make($request->all(), [
            'userid'    => 'required',
            'courseid' => 'required',
        ]);

        if ($validateuser->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => "please Login First"
            ]); 
        }
        $already = Enroll::where('user_id', $request->userid)
                 ->where('course_id', $request->courseid)
                 ->first();

        if ($already) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are already enrolled in this course!',
            ]);
        }


        $enroll = Enroll::create([
            'user_id' => $request->userid,
            'course_id' => $request->courseid,
        ]);

        if($enroll){
            return response()->json([
                'status'  => 'success',
                'message' => 'Course Can Be Enrolled SuccessFully',
            ]);
        }



    }
}
