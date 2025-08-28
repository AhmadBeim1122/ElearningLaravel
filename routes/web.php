<?php
 
use App\Http\Controllers\EnrollController;
use App\Http\Controllers\HomeContoller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PasswordResetLinkController;
// use App\Http\Controllers\API\NewPasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GoogleController;



Route::fallback(function () {
    return redirect('/'); // ya phir koi custom view
});

// use Illuminate\Foundation\Auth\EmailVerificationRequest;
// use Illuminate\Http\Request;


// // 4.1 Notice page (must be named verification.notice)
// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');

// // 4.2 The signed verification link handler
// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill(); // marks email as verified + fires Verified event
//     return redirect()->route('users.create')->with('success', 'Your email has been verified!');
// })->middleware(['auth', 'signed'])->name('verification.verify');

// // 4.3 Resend link
// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();
//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');









// Google Login
// Route::get('auth/google', [GoogleController::class, 'redirect'])->name('google.login');
// Route::get('auth/google/callback', [GoogleController::class, 'callback']);




// Forgot password
Route::controller(PasswordResetLinkController::class)->group(function () {
    Route::get('/forgot-password', 'create')->name('password.request'); // show form
    Route::post('/forgot-password', 'store')->name('password.email');  // send link
    Route::get('/reset-password/{email}', 'resetForm')->name('password.reset'); // show reset form
    Route::post('/reset-password', 'newpassword')->name('password.newpass');   // save new password
});



Route::controller(HomeContoller::class)->group(function () {

    Route::get('/','index')->name('home');
    Route::get('/courses','courses')->name('course');
    Route::get('/courses/{id}/coursedetail','coursedetail')->name('coursedetail');
    Route::get('/courses/search','search')->name('search');

    Route::get('/courses/category/{string}','category')->name('category');

});




Route::post('/enroll',[EnrollController::class,'enrollcourse'])->name('enroll.course');


Route::post('userlogin',[AuthController::class,'userlogin'])->name('user.login');

Route::get('logout',[AuthController::class,'userlogout'])->name('user.logout');



Route::middleware('isValidUploader')->group(function () {

    Route::controller(CourseController::class)->group(function (){
        Route::post('course/store','store')->name('course.store');

        Route::put('course/update/{id}','update')->name('course.update');

        Route::delete('course/delete/{id}','destroy')->name('course.destroy');

    });
    
    Route::controller(LessonController::class)->group(function (){
        Route::post('lesson/store','store')->name('lesson.store');

        Route::put('lesson/update/{id}','update')->name('lesson.update');

        Route::delete('lesson/delete/{id}','destroy')->name('lesson.destroy');

    });
    
    
    
    
    
});


Route::middleware('IsvalidAdmin')->group(function (){

    Route::Resource('course',CourseController::class)
    ->except(['store','update','destroy']);


    Route::Resource('lesson',LessonController::class)
    ->except(['store','update','destroy']);
    
    
    
    
    // Route::post('/lesson/upload', [LessonController::class, 'upload'])->name('lesson.upload');
    
});





Route::withoutMiddleware('IsvalidAdmin')->group(function () {

    Route::post('adminlogin',[AuthController::class,'login'])->name('adlogin');
    
    Route::get('admin/', function () {
        return view('admin.login');
    })->name('login');
    
    
});


Route::middleware('IsvalidAdmin')->prefix('admin')->group(function() {


    
    Route::get('logout',[AuthController::class,'logout'])->name('logout');
    Route::Resource('admins',AdminController::class);
        
    Route::controller(CategoryController::class)->group(function (){

        Route::get('/category','index')->name('category.index');

        Route::post('/category/store','store')->name('category.store');

        Route::put('/category/update/{id}', 'update')->name('category.update');

        Route::delete('/category/delete/{id}', 'destroy')->name('category.destroy');


    });

    //add student
    

    Route::controller(AdminController::class)->group(function (){

        Route::get('/dashboard','dashboard')->name('dashboard');
        Route::get('/adduser','adduser')->name('adduser');
        Route::get('/Student','viewstudent')->name('student');
        Route::get('/Instructor','viewInstructor')->name('instructor');

        Route::get('/ViewAllEnrollments','viewAllEnroll')->name('All.Enroll');

        Route::get('/ViewAllEnrollments/manageAllStudentEnroll/{id}','manageAllstudent')->name('manage.AllstuEnroll');

        Route::delete('/ViewAllEnrollments/manageAllStudentEnroll/delete/{id}', [AdminController::class, 'enrollAlldelete'])->name('enrollAll.delete');





        Route::get('/Edit-User/{id}','edituser')->name('user.edit');
        Route::put('/Update-User/{id}','updateuser')->name('user.update');
        
        Route::delete('/Delete-User/{id}','userdestroy')->name('user.destroy');
        


        Route::get('/UserFeedback','userfeedback')->name('userfeedback');
        Route::get('/InstructorFeedback','Insfeedback')->name('Insfeedback');
        Route::delete('/Delete-feddback/{id}','fbdestroy')->name('fbdestroy');

    });
    
    

});






Route::middleware(['isValidUser'])->prefix('user')->group(function () {

    Route::controller(UserController::class)->group(function (){
        Route::get('/mycourses/{id}','mycourses')->name('mycourses');
        Route::get('/mycourses/watchCourse/{id}','watchcourse')->name('watchcourse');
        Route::post('/subitquiz','quizAns')->name('check.quiz');
    });


    route::resource('feedback',FeedbackController::class);


    Route::resource('InsCourse',InstructorController::class);


Route::controller(InstructorController::class)->group(function () {
    Route::get('/course/edit-course/{id}', 'InsCourseEdit')->name('course.insedit');
    Route::get('/course/edit-lesson/{id}', 'InsLessonEdit')->name('lesson.insedit');

    Route::get('/dashboard/{id}', 'Insdashboard')->name('Ins.dashboard');

    Route::get('/view-Enrollments/{id}', 'ViewEnroll')->name('view.enrollments');
    Route::get('/view-Enrollments/manage-student/{id}', 'managestudent')->name('manage.stu');
    Route::delete('/view-Enrollments/manage-student/delte/{id}', 'enrolldelete')->name('enroll.delete');
});


});




// users.create anD sTore  without middleware

Route::withoutMiddleware('isValidUser')->group(function (){
    Route::get('users/create', [UserController::class, 'create'])
        ->name('users.create');
    Route::post('users/store', [UserController::class, 'store'])
        ->name('users.store');

});
// ['isValidUser','auth','verified']
// ✅ saare users.* routes WITH middleware
Route::middleware('isValidUser')->group(function () {
    Route::resource('users', UserController::class)->except(['create','store']);
});


