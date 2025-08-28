<?php

namespace App\Http\Controllers;

use getID3;
use App\Models\Course;
use App\Models\Category;
use App\Models\Enroll;
use App\Models\Feedback;
use Illuminate\Http\Request;

class HomeContoller extends Controller
{
    public function index(){ 
        $first = Course::orderBy('id','desc')
        ->take(3)
        ->get();

        $second = Course::orderBy('id','desc')
        ->skip(3)
        ->take(3)
        ->get();
        
        $feedback = Feedback::with('user')->get();

        $categories = Category::take(4)->get(); 
            
        // return $feedback;

        return view('home',compact('first','second','feedback','categories'));
    }


    public function courses(){
        $courses = Course::paginate(4);
        $categories = Category::all();


        $categ = Category::take(4)->get(); 

        // return $categories;

        return view ('course',compact("courses",'categories','categ'));
    }



    public function coursedetail(string $id){
        $course = Course::with(['lesson','user'])
                        ->findOrFail($id);

                        $i = 0;
        foreach($course->lesson as $cs){
            $i++;
        }                
         $categories = Category::all();
         $counts = Enroll::where('course_id',$id)->count('user_id');

        //  return $counts;
           foreach ($categories as $category) {

               if($category->id == $course->course_category){
                    $cat_name = $category->Category_Name;
                }
            }   

            $categ = Category::take(4)->get(); 

        return view ('coursedetail',compact('course','cat_name','i','counts','categ'));

    
    
    
    
        //         if ($lesson) {
    // $videoPath = public_path('upload/courses/lessonVideo/' . $lesson->lesson_link);

    // if (file_exists($videoPath)) {
    //     $getID3 = new getID3;
    //     $fileInfo = $getID3->analyze($videoPath);

    //     $duration = isset($fileInfo['playtime_seconds'])
    //         ? gmdate("H:i:s", $fileInfo['playtime_seconds'])
    //         : null;

    //     }            
    //     return $duration;
    // }
    
    
}



public function search(Request $request){

    $courses = Course::where('course_name', 'like', "%$request->search%")
    ->orWhere('course_desc', 'like', "%$request->search%")
    ->paginate(4);


    $categories = Category::all();

    $categ = Category::take(4)->get(); 

    return view ('course',compact("courses",'categories','categ'));


}

public function category(string $category){

    $id = Category::where('Category_Name', $category)->value('id'); 
    
    $courses = Course::where('course_category',$id)->paginate(4);

    $categories = Category::all();

    $categ = Category::take(4)->get(); 

    return view ('course',compact("courses",'categories','category','categ'));

}







    
}
