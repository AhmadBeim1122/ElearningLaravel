<?php

namespace App\Http\Controllers;

use id;
use App\Models\User;
use App\Models\Admin;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\Feedback;
use App\Models\QuizResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::paginate(7);
        return view('admin.Admin.All',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Admin.addadmin');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validateUser = Validator::make(
            $request->all(),
            [
                'ad_name' => 'required',
                'ad_email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed',
            ],
            [
                'password.confirmed' => 'Password and confirmation do not match.',
            ]);
        if ($validateUser->fails()) {
        return redirect()->back()
                         ->withErrors($validateUser)
                         ->withInput(); // <-- keeps old input values
        }

        $admin = Admin::create([
            'name'  => $request->ad_name,
            'email' => $request->ad_email,
            'password' => bcrypt($request->password)
         ]);

         if ($admin) {
            return view('successmsg')->with([
                'msg' => 'Admin Added Successfully',
                'route' => 'admins.index'
            ]);
    }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = Admin::find($id);
        return view('admin.Admin.editadmin',compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateUser = Validator::make(
            $request->all(),
            [
                'ad_name' => 'required',
                'ad_email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed',
            ],
            [
                'password.confirmed' => 'Password and confirmation do not match.',
            ]);
        if ($validateUser->fails()) {
        return redirect()->back()
                         ->withErrors($validateUser)
                         ->withInput(); // <-- keeps old input values
        }

        $admin = Admin::where('id',$id)->update([
            'name'  => $request->ad_name,
            'email' => $request->ad_email,
            'password' => bcrypt($request->password)
         ]);

         if ($admin) {
            return view('successmsg')->with([
                'msg' => 'Admin Updated Successfully',
                'route' => 'admins.index'
            ]);
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = Admin::find($id);

        $admin->delete();
        if ($admin) {
            return view('successmsg')->with([
                'msg' => 'Admin Deleted Successfully',
                'route' => 'admins.index'
            ]);
    }


    }





    Public function adduser(){
        return view('admin.User.adduser');
    }
    
    public function viewstudent(){
        $users = User::where('role','student')->paginate(7);
        $role = 'student'; 
        return view('admin.User.user',compact('users','role'));
    }
    
    public function viewInstructor(){
        $users = User::where('role','teacher')->paginate(7);
        $role = 'teacher'; 
        return view('admin.User.user',compact('users','role'));

    }

    public function edituser(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.User.edituser',compact('user'));
    }






    public function updateuser(Request $request,string $id){
        
        
        $validuser = Validator::make(
            $request->all(),
            [
                'phone' => 'required',
                'address' => 'required',
                'qualification' => 'required',
                'role' => 'required',
                'bio' => 'required',
                'dob' => 'required',
                'gender' => 'required',
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        if($validuser->fails()){
            return redirect()
            ->back()
            ->withErrors($validuser)
            ->withInput();
        }

         $user = User::findOrFail($id);

        // if($request->role == "teacher"){
        //     $status = 'Pending';
        // }elseif($request->role == "student"){
            $status = 'approved';
        // }

        // Image upload

        if($request->hasFile('profile_image')){
        $path = public_path('upload/Users/profilePhoto');

        if($user->profile_image != '' && $user->profile_image != NULL){
            $old_path = $path . $user->profile_image;

            if(file_exists($old_path)){
                unlink($old_path);
            }
        }

        $img = $request->file('profile_image');
        $ext = $img->getClientOriginalExtension();
        $profileImagePath = time(). '.' . $ext;
        $img->move(public_path('/upload/Users/profilePhoto'),$profileImagePath);


    }else{
        $profileImagePath = $user->profile_image;
    }
    
    $users = User::where('id',$id)
    ->update([
        'name' => $request->name,
        'email' => $request->email,
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

        if($users){
            return redirect()->back()->with('success', 'Updated Successful');
        }
        
        
        
    }




    
    public function userdestroy(string $id)
    {
        $user = User::find($id);
        $path = public_path('/upload/Users/profilePhoto/' . $user->profile_image);
        
        if($user->profile_image && file_exists($path)){
            unlink($path);
        }
        
        $user->delete();
        
        if($user){
            return redirect()->back()->with('success', 'Deleted Successful');
        }

        
    }






    public function userfeedback(){

        $feedback = Feedback::with('user')
            ->whereHas('user', function($q){
                $q->where('role', 'student');
            })
            ->paginate(10);

        return view('admin.feedback', compact('feedback'));


    
    }
    
    
    
    public function Insfeedback(){

        $feedback = Feedback::with('user')
            ->whereHas('user', function($q){
                $q->where('role', 'teacher');
            })
            ->paginate(10);

        return view('admin.feedback', compact('feedback'));


    }




    public function fbdestroy(string $id){
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();


        if($feedback){
            return redirect()->back()->with('success', 'Deleted Successful');
        }

    }



    public function dashboard(){

        $user = User::count('id');

        $course = Course::count();

        $enrolls = Enroll::count();
        

        return view('admin.dashboard',compact('user','course','enrolls'));

    }


    public function viewAllEnroll(){
        $courses = Course::withCount('enroll')
            ->paginate(10);

        // return $courses;
        
        
        return view('admin.ViewAllEnroll',compact('courses')); 
    }


    public function manageAllstudent(string $id){
        $enroll = Enroll::where('course_id',$id)
        ->with(['user','course'])
        ->paginate(10);


        $quizresult = QuizResult::where('course_id',$id)->get();


        return view('admin.manageAllstu',compact('enroll','quizresult'));

    }



    public function enrollAlldelete(string $id,Request $request){
        $courseid = $request->course_id;
        $enroll = Enroll::where('user_id',$id)
        ->where('course_id',$courseid)
        ->first();

        $quizresult = QuizResult::where('student_id',$id)
        ->where('course_id',$courseid)
        ->get();

        $quizresult->each->delete();
        $enroll->delete();

         return redirect()->route('manage.AllstuEnroll',$courseid)->with([
                'success' => 'User Enroll Remove Successfully',
    
            ]);
    }


}
