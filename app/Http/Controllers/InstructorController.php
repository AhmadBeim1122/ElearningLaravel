<?php

namespace App\Http\Controllers;

use App\Models\Quizz;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\Lesson;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\QuizResult;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.Instructor.insAddlesson');
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('user.Instructor.insAddcourse',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $courses = Course::where('Ins_id',$id)->get();
        // Sirf specific keys remove karna
        session()->forget(['id', 'name']);
        
        return view('user.Instructor.insCourse',compact('courses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lessons = Lesson::where('course_id', $id)->with('course')->get();

        $course = Course::find($id);

        session([ 
            'id'=> $course->id,
            'name' => $course->course_name
        ]);

    return view('user.Instructor.insLesson', compact('lessons', 'course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
    
    
    public function InsCourseEdit(string $id)
    {
           $course = Course::findOrFail($id);
           $categories = Category::all();

           foreach ($categories as $category) {

               if($category->id == $course->course_category){
                    $cat_name = $category->Category_Name;
                }
            }   
            // return $cat_name;
       return view('user.Instructor.insEditcourse', compact('course','categories','cat_name'));      
    }
    
    public function InsLessonEdit(string $id)
    {
       $lesson = Lesson::findOrFail($id);
       $quiz = Quizz::where('lesson_id',$id)->first();

    //    return $quiz;

       return view('user.Instructor.insEditlesson', compact('lesson','quiz'));      
    }



    public function Insdashboard(string $id){

        $course = Course::where('Ins_id',$id)->get();
        $coursecount = $course->count();
        
        
        $feedback = Feedback::where('user_id',$id)->count();


        $total = Enroll::whereRelation('course', 'Ins_id', $id)->count();

        // return $total;


        
        return view('user.Instructor.dashboard',compact('coursecount','feedback','total'));
    }



    public function ViewEnroll(string $id){
        $courses = Course::where('Ins_id', $id)
            ->withCount('enroll') // har course ke sath enroll ka count add ho jaye ga
            ->get();

        // return $courses;
        
        // Sirf specific keys remove karna
        session()->forget(['id', 'name']);
        
        return view('user.Instructor.viewenrolls',compact('courses')); 
    }


    public function managestudent(string $id){
        $enroll = Enroll::where('course_id',$id)
        ->with(['user','course'])
        ->get();


        $quizresult = QuizResult::where('course_id',$id)->get();


        return view('user.Instructor.managestu',compact('enroll','quizresult'));

    }


    public function enrolldelete(string $id,Request $request){
        $courseid = $request->course_id;
        $enroll = Enroll::where('user_id',$id)
        ->where('course_id',$courseid)
        ->first();

        $quizresult = QuizResult::where('student_id',$id)
        ->where('course_id',$courseid)
        ->get();

        $quizresult->each->delete();
        $enroll->delete();

         return redirect()->route('manage.stu',$courseid)->with([
                'success' => 'User Remove Successfully',
    
            ]);
    }



}
