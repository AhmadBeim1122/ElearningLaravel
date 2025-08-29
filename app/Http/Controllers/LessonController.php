<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Quizz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $courseId = $request->input('checkid');

        $lessons = Lesson::where('course_id', $courseId)->with('course')->paginate(10);
        $course_name = Course::where('id', $courseId)->value('course_name');

    // return $lessons;


    return view('admin.Courses.lesson', compact('lessons', 'courseId','course_name'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        // return dd($id,$name);
        return view('admin.Courses.addlesson', compact('id','name'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
         $validatelesson = Validator::make(
            $request->all(),
            [
                'lesson_name' => 'required',
                'lesson_desc' => 'required|max:500',
                'lesson_link' => 'required|mimes:mp4,mov,ogg|max:102400',
                'question'    => 'required',
                'option_1'    => 'required',
                'option_2'    => 'required',
                'option_3'    => 'required',
                'option_4'    => 'required',
                'correct_answer' => 'required',

        ]);


         if ($validatelesson->fails()) {
        return redirect()->back()
                         ->withErrors($validatelesson)
                         ->withInput(); // <-- keeps old input values
        }

        $video = $request->lesson_link;
        $ext = $video->getClientOriginalExtension();
        $lesson_video = time(). '.' . $ext;
        $video->move(public_path(). '/upload/courses/lessonVideo', $lesson_video);

         $lesson = Lesson::create([
                'lesson_name' => $request->lesson_name,
                'lesson_description' => $request->lesson_desc,
                'lesson_link' => $lesson_video,
                'course_id' => $request->course_id,
        ]);

        
        $correctKey = $request->correct_answer; // option_1, option_2, ...
        $correctAnswer = $request->$correctKey;
 
        $quiz = Quizz::create([
             'question'    => $request->question,
            'option_1'    => $request->option_1,
            'option_2'    => $request->option_2,
            'option_3'    => $request->option_3,
            'option_4'    => $request->option_4,
            'correct_answer'    => $correctAnswer,
            'lesson_id'   => $lesson->id
        ]);

        if ($lesson && $quiz && $request->role == 'admin') {
        return view('successmsg')->with([
                'msg' => 'Lesson Added Successfully',
                'route' => 'lesson.index',
                'course_id' => $request->course_id,
            ]);
    } elseif($lesson && $quiz && $request->role == 'teacher') {
            return redirect()->route('InsCourse.edit',$request->course_id)->with([
                'success' => 'Lesson Added Successfully',
    
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
       return view('admin.Courses.lesson'); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $lesson = Lesson::findOrFail($id);
         $courseId = $lesson->course_id;
         $course_name = Course::where('id', $courseId)->value('course_name');
         $quiz = Quizz::where('lesson_id',$id)->first();

        //  return dd($lesson,$courseId,$course_name);
        return view('admin.Courses.editlesson', compact('lesson','course_name','quiz'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return $request;
         $validatelesson = Validator::make(
            $request->all(),
            [
                'lesson_name' => 'required',
                'lesson_desc' => 'required|max:500',
                'lesson_link' => 'nullable|mimes:mp4,mov,ogg',
                'question'    => 'required',
                'option_1'    => 'required',
                'option_2'    => 'required',
                'option_3'    => 'required',
                'option_4'    => 'required',
                'correct_answer' => 'required',

        ]);


         if ($validatelesson->fails()) {
        return redirect()->back()
                         ->withErrors($validatelesson)
                         ->withInput(); // <-- keeps old input values
        }


        $lesson = Lesson::findOrFail($id);

        if($request->hasFile('lesson_link')){
            
            $path = public_path(). '/upload/courses/lessonVideo/';
            if($lesson->lesson_link != '' && $lesson->lesson_link != NULL){
                $old_path = $path . $lesson->lesson_link;
                if(file_exists($old_path)){
                    unlink($old_path);
                }
            }

            $video = $request->file('lesson_link');
            $ext = $video->getClientOriginalExtension();
            $lesson_link = time(). '.' . $ext;
            $video->move(public_path() . '/upload/courses/lessonVideo/', $lesson_link);
        }else{
            $lesson_link = $lesson->lesson_link;
        }
        // echo $lesson_link;
        

        $lesson->lesson_name = $request->lesson_name;
        $lesson->lesson_description = $request->lesson_desc;
        $lesson->lesson_link = $lesson_link;
        $lesson->course_id = $request->course_id;

        $lesson->save(); 

        $correctKey = $request->correct_answer; // option_1, option_2, ...
        $correctAnswer = $request->$correctKey;
        
        
        $quiz = Quizz::where(['lesson_id' => $id])->update([
            'question'    => $request->question,
            'option_1'    => $request->option_1,
            'option_2'    => $request->option_2,
            'option_3'    => $request->option_3,
            'option_4'    => $request->option_4,
            'correct_answer'    => $correctAnswer,
            'lesson_id'   => $request->lesson_id
        ]);
        
        // if($quiz){
        //     return $request->course_id;
        // }

        if($lesson && $quiz){
            
            if($request->role == 'admin'){
                return view('successmsg')->with([
                    'msg' => 'Lesson Update Successfully',
                    'route' => 'lesson.index',
                    'course_id' => $request->course_id,
                ]);
            }elseif($request->role == 'teacher'){
                return redirect()->route('InsCourse.edit', $request->course_id)
                    ->with('success', 'Lesson Updated Successfully');
            }
        }




    //    if ($lesson && $quiz && $request->role == 'admin') {
    //     return view('successmsg')->with([
    //             'msg' => 'Lesson Update Successfully',
    //             'route' => 'lesson.index',
    //             'course_id' => $request->course_id,
    //         ]);
    //     } elseif($lesson && $quiz && $request->role == 'teacher') {
            
    //         return redirect()->route('InsCourse.edit',$request->course_id)->with([
    //             'success' => 'Lesson Updated Successfully',
    
    //         ]);
    //     }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        $lesson = LESSON::findOrFail($id);


        $path = public_path('upload/courses/lessonVideo/' . $lesson->lesson_link);

        if(file_exists($path)){
            unlink($path);
        }

        $lesson->delete();

        if ($lesson && $request->role == 'admin') {
        return view('successmsg')->with([
                'msg' => 'Lesson Deleted Successfully',
                'route' => 'lesson.index',
                'course_id' => $request->course_id,
            ]);
    }
    elseif($lesson && $request->role == 'teacher') {
            return redirect()->route('InsCourse.edit',$lesson->course_id)->with([
                'success' => 'Lesson Deleted Successfully',
    
            ]);
        }

    }


}



