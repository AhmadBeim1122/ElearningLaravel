<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all()->sortDesc();

        return view('admin.Courses.course',compact('courses'));
    }

    public function create()
{
    $category = Category::all();
    return view('admin.Courses.addcourse',compact('category'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validateUser = Validator::make(
            $request->all(),
            [
                'ins_id'               => 'required',
                'course_name'          => 'required',
                'course_category'      => 'required',
                'course_level'         => 'required',
                'course_language'      => 'required',
                'course_description'   => 'required|max:500',
                'course_author'        => 'required',
                'course_duration'      => 'required',
                'course_image'         => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                // 'course_original_price' => 'integer',
                // 'course_price' => 'integer',

        ]);


         if ($validateUser->fails()) {
        return redirect()->back()
                         ->withErrors($validateUser)
                         ->withInput(); // <-- keeps old input values
        }

        $img = $request->course_image;
        $ext = $img->getClientOriginalExtension();
        $course_image = time(). '.' . $ext;
        $img->move(public_path(). '/upload/courses/image', $course_image);


        // if($request->course_original_price && $request->course_price){
        //     $org = $request->course_original_price;
        //     $price = $request->course_price;
        // }
        // else{
        //     $org = null;
        //     $price = null;
        // }


        $course = Course::create([
            'course_name' => $request->course_name,
            'course_category' => $request->course_category,
            'course_level' => $request->course_level,
            'course_language' => $request->course_language,
            'course_desc' => $request->course_description,
            'course_author' => $request->course_author,
            'course_duration' => $request->course_duration,
            // 'course_org_price' => $org,
            // 'course_price' => $price,
            'course_img' => $course_image,
            'Ins_id' => $request->ins_id
        ]);

        if ($course && $request->role == 'admin') {
        return view('successmsg')->with([
                'msg' => 'Course Added Successfully',
                'route' => 'course.index'
            ]);
        } elseif($course && $request->role == 'teacher') {
            return redirect()->route('InsCourse.show',$request->ins_id)->with([
                'success' => 'Course Added Successfully',
    
            ]);
        }else{
            return "Error Ocurred";
        }

}
        
        /**
         * Display the specified resource.
        */
        public function show(string $id)
        {
             $course = Course::findOrFail($id);
             $categories = Category::all();

           foreach ($categories as $category) {

               if($category->id == $course->course_category){
                    $cat_name = $category->Category_Name;
                }
            }   

            return view('admin.Courses.editcourse', compact('course','categories','cat_name'));

            }

    /**
     * Update the specified resource in storage.
    */
    public function update(Request $request, string $id)
    {
        // return dd($request->all(), $id); 

        $validateUser = Validator::make(
           $request->all(),
           [
                'ins_id'               => 'required',
               'course_name'           => 'required',
               'course_category'       => 'required',
               'course_level'          => 'required',
                'course_language'      => 'required',
               'course_description'    => 'required|max:500',
               'course_author'         => 'required',
               'course_duration'       => 'required',
               'course_image'          => 'image|mimes:jpeg,png,jpg'
            //    'course_original_price' => 'integer',
            //    'course_price' => 'integer',
    
       ]);
    
       if ($validateUser->fails()) {
        return redirect()->back()
                         ->withErrors($validateUser)
                         ->withInput(); // <-- keeps old input values
        }




    //    $course = Course::select('id','course_img')
    //    ->where('id', $id)
    //    ->get();
       



        $course = Course::findOrFail($id);
       //checking database for image exists
       if($request->course_image != ''){
        $path = public_path('upload/courses/image/');

        if($course->course_img != '' && $course->course_img != null){
            $old_path = $path . $course->course_img;
            if(file_exists($old_path)){
                unlink($old_path);
            }
        }
        
           $img = $request->course_image;
           $ext = $img->getClientOriginalExtension();
           $course_img = time(). '.' . $ext;
           $img->move(public_path('upload/courses/image/'), $course_img);
       }else{
            $course_img = $course->course_img;
       }


    //    if($request->course_original_price && $request->course_price){
    //         $org = $request->course_original_price;
    //         $price = $request->course_price;
    //     }
    //     else{
    //         $org = null;
    //         $price = null;
    //     }


       $course = Course::where(['id' => $id])->update([
           'course_name' => $request->course_name,
           'course_category' => $request->course_category,
            'course_level' => $request->course_level,
            'course_language' => $request->course_language,
           'course_desc' => $request->course_description,
           'course_author' => $request->course_author,
           'course_duration' => $request->course_duration,
        //    'course_org_price' => $org,
        //    'course_price' => $price,
           'course_img' => $course_img,
           'Ins_id' => $request->ins_id
       ]);

   

       if ($course && $request->role == 'admin') {
        return view('successmsg')->with([
                'msg' => 'Course Updated Successfully',
                'route' => 'course.index'
            ]);
        } elseif($course && $request->role == 'teacher') {
            return redirect()->route('InsCourse.show',$request->ins_id)->with([
                                    'success' => 'Course Updated Successfully',
                        
                                ]);
        }
    
       
}
        
        /**
         * Remove the specified resource from storage.
        */
        public function destroy(Request $request,string $id)
        {
            $course = Course::findOrFail($id);
            $filepath = public_path('upload/courses/image/' . $course->course_img);

            if ($course->course_img && file_exists($filepath)) {
                unlink($filepath);
            }
            $course->delete();
            
            if ($course && $request->role == 'admin') {
        return view('successmsg')->with([
                'msg' => 'Course Delted Successfully',
                'route' => 'course.index'
            ]);
        } elseif($course && $request->role == 'teacher') {
            return redirect()->route('InsCourse.show',$request->ins_id)->with([
                                    'success' => 'Course Deleted Successfully',
                        
                                ]);
        }
            
    }
}
