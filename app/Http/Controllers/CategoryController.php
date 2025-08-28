<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Catch_;

class CategoryController extends Controller
{
    public function index(){
        $category = Category::paginate(5);
        $i=1;

        return view('admin.category',compact('category','i'));
    }
 


    public function store(Request $request){
    $validate = Validator::make($request->all(),[
        'Category_Name' => 'required'
    ]);

    if($validate->fails()){
        return response()->json([
            'status'  => 'error',
            'message' => $validate->errors()->first()
        ]);
    }


    $already = Category::where('Category_Name',$request->Category_Name)->exists();

    if($already){
        return response()->json([
            'status'  => 'error',
            'message' => 'Category Already Exists!'
        ]);
    }

    

    $category = new Category();
    $category->Category_Name = $request->Category_Name;
    $category->save();

    return response()->json([
        'status'  => 'success',
        'message' => 'Category added successfully!'
    ]);
}





    public function update(Request $request, string $id){
    $validate = Validator::make($request->all(),[
        'Category_Name' => 'required'
    ]);

    if($validate->fails()){
        return response()->json([
            'status'  => 'error',
            'message' => $validate->errors()->first()
        ]);
    }


    $category = Category::where('id',$id)->update([
        'Category_Name' => $request->Category_Name
    ]);

    return response()->json([
        'status'  => 'success',
        'message' => 'Category Updated successfully!'
    ]);
}



public function destroy(string $id){

    $category = Category::findOrFail($id);

    $category->delete();
    if($category){
        return redirect()->back()
        ->with([
            'success' => "Deleted SuccesFully"
        ]);
    }
}





}
