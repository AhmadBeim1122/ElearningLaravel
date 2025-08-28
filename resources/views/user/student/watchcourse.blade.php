<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Watch Course</title>
 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
 <style>
   #playlist li.active {
      background-color: #198754;
      color: #fff;
      font-weight: bold;
   }
 </style>
</head>
<body class="bg-light">

<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="{{ route('home') }}">📚 E-Learning</a>
    <a class="btn btn-outline-light" href="{{ route('mycourses',Auth::user()->id) }}">My Courses</a>
  </div>
</nav>

<div class="container-fluid mt-4">
 <div class="row">
  
  <!-- Sidebar -->
  <div class="col-sm-2 border-end">
    <h4 class="text-success mb-3">Lessons</h4>
    <ul id="playlist" class="list-group">
      @foreach ($lesson as $ls)
      <li class="list-group-item list-group-item-action" 
          data-id="{{ $ls->id }}" 
          data-answer="{{ $ls->quiz->correct_answer }}"
          style="cursor:pointer;">
          🎬 {{ $ls->lesson_name }}
      </li>
      @endforeach
    </ul>
  </div>
  
  <!-- Main Content -->
  <div class="col-sm-7">
      @foreach ($lesson as $ls)
      <!-- Lesson Block -->
      <div class="lesson-block d-none" id="lesson-{{ $ls->id }}">
        <div class="card shadow-sm mb-4">
          <div class="card-body text-center">
            <video src="{{ asset('upload/courses/lessonVideo/'.$ls->lesson_link) }}" 
                   class="w-75 rounded border" controls></video>
          </div>
        </div>

        <div class="card shadow-sm">
          <div class="card-header bg-success text-white">
            <h5 class="mb-0">📖 Quiz</h5>
          </div>
          <div class="card-body">

            <h6 class="mb-3">{{ $ls->quiz->question }}</h6>
            
            <form class="quiz-form" data-lesson="{{ $ls->id }}">

               <input type="hidden" value="{{ $ls->quiz->id }}" id="quizid">
               <input type="hidden" value="{{ $ls->course_id }}" id="course_id" name="course_id">

               <div class="form-check">
                  <input type="radio" class="form-check-input" name="ans-{{ $ls->id }}" id="q1" value="option_1">
                  <label for="q1" class="form-check-label">{{ $ls->quiz->option_1 }}</label>
               </div>

               <div class="form-check">
                  <input type="radio" class="form-check-input" name="ans-{{ $ls->id }}" id="q2" value="option_2">
                  <label for="q2" class="form-check-label">{{ $ls->quiz->option_2 }}</label>
               </div>

               <div class="form-check">
                  <input type="radio" class="form-check-input" name="ans-{{ $ls->id }}" id="q3" value="option_3">
                  <label for="q3" class="form-check-label">{{ $ls->quiz->option_3 }}</label>
               </div>

               <div class="form-check">
                  <input type="radio" class="form-check-input" name="ans-{{ $ls->id }}" id="q4" value="option_4">
                  <label for="q4" class="form-check-label">{{ $ls->quiz->option_4 }}</label>
               </div>

               <div class="mt-3" id="quiz-msg-{{ $ls->id }}"></div>
               <div class="form-group mt-2">
                 <button type="submit" class="btn btn-danger btn1">Submit</button>
                 <button type="submit" class="btn btn-danger d-none btn2">Next</button>
               </div>

            </form>
          </div>
        </div>
      </div>
      @endforeach
  </div>

  <!-- Description -->
  <div class="col-sm-3">
      @foreach ($lesson as $ls)
      <div class="lesson-block d-none" id="desc-{{ $ls->id }}">
         <div class="card shadow-sm">
           <div class="card-header bg-secondary text-white">
             <h6>Description</h6>
           </div>
           <div class="card-body">
             <p>{{ $ls->lesson_description }}</p>
           </div>
         </div>
      </div>
      @endforeach
  </div>

 </div>
</div>


<!-- JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<script>
   $(document).ready(function(){

   let isLoggedIn = @json(Auth::check());  
   let userid = isLoggedIn ? @json(Auth::id()) : null;  

   // Sidebar click event
   $("#playlist li").click(function(){
      var lessonId = $(this).data("id");

      // sidebar style
      $("#playlist li").removeClass("active");
      $(this).addClass("active");

      // sab hide
      $(".lesson-block").addClass("d-none");

      // sirf clicked wala show
      $("#lesson-" + lessonId).removeClass("d-none");
      $("#desc-" + lessonId).removeClass("d-none");
   });

   // Jab radio option select ho
   $(".btn1").click(function(e){   // <- e yahan lena zaroori hai
    e.preventDefault();  

      let form = $(this).closest(".quiz-form");
      let lessonId = form.data("lesson");
      let quizId = form.find("#quizid").val();
      let courseid = form.find("#course_id").val();
      let selected = form.find("input[type=radio]:checked").val(); // sirf selected option

      if(!selected){
         $("#quiz-msg-"+lessonId).html('<div class="alert alert-warning">⚠️ Please select an answer first!</div>');
         return;
      }
      $.ajax({
         url : "{{ route('check.quiz') }}",
         type : "POST",
         data : {
            quizId : quizId,
            selected : selected,
            userid: userid,
            courseid:courseid,
            _token: "{{ csrf_token()}}"
         },
         success: function(response){
            if(response.status === "success"){
               $("#quiz-msg-"+lessonId).html('<div class="alert alert-success">'+ response.message +'</div>');
               form.find(".btn1").addClass("d-none"); // hide Next button
               form.find(".btn2").removeClass("d-none"); // show Next button
            }else{
               $("#quiz-msg-"+lessonId).html('<div class="alert alert-danger">'+ response.message +'</div>');
               form.find(".btn1").addClass("d-none"); // hide Next button
               form.find(".btn2").removeClass("d-none"); // show Next button
            }
         }
      });
   });

   // Next button click → next lesson pe jao
   $(".btn2").click(function(e){
      e.preventDefault();
      let lessonId = $(this).closest(".quiz-form").data("lesson");

      // find current lesson index
      let currentLi = $("#playlist li[data-id='"+lessonId+"']");
      let nextLi = currentLi.next();

      if(nextLi.length){
         nextLi.trigger("click"); // next lesson open
      }
   });

   // default: pehla lesson show
   $("#playlist li:first").trigger("click");
});

</script>

</body>
</html>
