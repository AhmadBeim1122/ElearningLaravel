<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Quizz;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\Lesson;
use App\Models\Category;
use App\Models\QuizResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd('index route with middleware');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // dd('create route accessed without middleware');
        $categ = Category::take(4)->get(); 
        return view('signup',compact('categ'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validuser = Validator::make(
            $request->all(),
            [
                'name' => 'required',
               'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    'regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/', // sirf gmail.com allow
                    'unique:users'
                ], 
                            // 'email' => 'required|email|unique:users,email',
                'password' => 'required|',
                'phone' => 'required',
                'address' => 'required',
                'qualification' => 'required',
                'role' => 'required',
                'bio' => 'required|max:500',
                'dob' => 'required',
                'gender' => 'required',
                'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        if($validuser->fails()){
            return redirect()
            ->back()
            ->withErrors($validuser)
            ->withInput();
        }

        // if($request->role == "teacher"){
        //     $status = 'Pending';
        // }elseif($request->role == "student"){
            $status = 'approved';
        // }

        // Image upload
    
    if ($request->hasFile('profile_image')) {
        $img = $request->file('profile_image');
        $ext = $img->getClientOriginalExtension();
        $profileImagePath = time() . '.' . $ext;
        $img->move(public_path('/upload/Users/profilePhoto'), $profileImagePath);
    }else{
        $profileImagePath = null;
    }

        $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'phone' => $request->phone,
                'address' => $request->address,
                'qualification' => $request->qualification,
                'role' => $request->role,
                'bio' => $request->bio,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'profile_image' => $profileImagePath,
                'status' => $status,
        ]);


        if($status == 'Pending'){
            // return view()->with('name', $request->name);
        }
        
        elseif($status == 'approved'){
            return redirect()->back()->with('success', 'Registered Successful');
        }

        // working
    //     Auth::login($user);
    // event(new Registered($user));

    // return view('auth.verify-email')
    //     ->with('success', 'Registered successfully! Please check your email to verify.');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $users = User::findOrFail($id);
        return view('user.profile',compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::findOrFail($id);
        return view('user.InfoChange',compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateuser = Validator::make($request->all(),[
            'user_name' => 'required',
            'user_bio' => 'required|max:500',
            'user_qualification' => 'required',
            'password' => 'confirmed',
            'User_image' => 'image|mimes:jpeg,png,jpg'
 
        ],
        [
                'password.confirmed' => 'Password Confirmation do not match.',
            ]
    );

    if($validateuser->fails()){
        return redirect()
        ->back()
        ->withErrors($validateuser)
        ->withInput();
    }

    $user = User::findOrFail($id);

    if($request->hasFile('User_image')){
        $path = public_path('upload/Users/profilePhoto');

        if($user->profile_image != '' && $user->profile_image != NULL){
            $old_path = $path . $user->profile_image;

            if(file_exists($old_path)){
                unlink($old_path);
            }
        }

        $img = $request->file('User_image');
        $ext = $img->getClientOriginalExtension();
        $profileImagePath = time(). '.' . $ext;
        $img->move(public_path('/upload/Users/profilePhoto'),$profileImagePath);


    }else{
        $profileImagePath = $user->profile_image;
    }


    if ($request->filled('password')) {
        // User entered a new password → hash it
        $password = bcrypt($request->password);
    } else {
        // Keep old password as it is (already hashed)
        $password = $user->password;
    }


    $users = User::where('id',$id)
    ->where('email',$request->userEmail)
    ->update([
        'name' => $request->user_name,
        'qualification' => $request->user_qualification,
        'bio' => $request->user_bio,
        'password' => $password,
        'profile_image' => $profileImagePath,
    ]);

    if($users){
        return redirect()->route('users.show',$user->id)
        ->with([
            'success' => 'User Data Update Successfully'
        ]);
    }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }







    public function mycourses(string $id){
        $enroll = Enroll::where('user_id',$id)->with('course')->get();
        
        return view('user.student.myCourses',compact('enroll'));
    }


    public function watchcourse(string $id){
        $lesson = Lesson::where('course_id',$id)->with('quiz')->get();
        // return $lesson;
        $auth = Auth::user()->id;
        $enroll = Enroll::where('course_id', $id)
                      ->where('user_id', $auth)
                      ->exists();

        
            if($enroll){
                // return $enroll;
                return view('user.student.watchcourse',compact('lesson'));
                
            }
            else{
                return redirect()->route('users.show',$auth);
            }
        

    }




public function quizAns(Request $request)
{
    $quiz = Quizz::find($request->quizId);

    if(!$quiz){
        return response()->json([
            'status' => 'error',
            'message' => 'Quiz not found!'
        ]);
    }
    $already = QuizResult::where('quiz_id', $request->quizId)
    ->where('student_id', $request->userid)
    ->first();

        if ($already) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are already Submit Quiz!',
            ]);
    }



    $selectedKey = $request->selected;  // e.g. option_1
    $selectedAnswer = $quiz->$selectedKey; // e.g. "London"

    $isCorrect = $quiz->correct_answer == $selectedAnswer;

    if($isCorrect){
        QuizResult::create([
            'quiz_id'     => $request->quizId,
            'student_id'  => $request->userid,
            'quiz_result' => true,
            'course_id'   => $request->courseid
        ]);

        return response()->json([
            'status' => 'success',
            'message' => '✅ Correct Answer!'
        ]);
    }else{
        QuizResult::create([
            'quiz_id'     => $request->quizId,
            'student_id'  => $request->userid,
            'quiz_result' => false,
            'course_id'   => $request->courseid
        ]);

        return response()->json([
            'status' => 'error',
            'message' => '❌ Wrong Answer! Correct option is: '.$quiz->correct_answer
        ]);
    }
}





}
