

$("#stuloginbtn").click(function(){
      // Your login logic here
      console.log("Student login clicked button new one.");
      var stulogemail = $("#email").val();
      var stulogpass = $("#password").val();
      console.log(stulogemail);
      console.log(stulogpass);
    $.ajax({
        url: loginUrl,
        method: "POST",
        data: {
            email:stulogemail,
            password: stulogpass,
            _token: csrfToken
        },
        success: function(response){
            if(response.status === 'success'){
                $("#statusloginmsg").html(`
                    <div class="d-flex align-items-center">
                        <div class="spinner-border text-success mr-2" role="status"></div>
                        <small class="text-success">${response.message}</small>
                    </div>
                `);
                setTimeout(() => window.location.href = "/", 2000);
            } else if(response.status === 'error') {
                $("#statusloginmsg").html(`<small class='alert alert-danger d-block mb-2'>${response.message}</small>`);
            }
        },
        error: function(){
            $("#statusloginmsg").html("<small class='alert alert-danger d-block mb-2'>Something went wrong</small>");
        }
    });
});

    // Jab modal close ho (X button ya backdrop click)
$(document).ready(function () {

    // Modal close hone par form reset + errors clear
    $(document).on('hidden.bs.modal', '#StuLogin', function () {
        // Form reset
        $('#stulogform')[0].reset();

        // Error messages clear
        $("#emailError").text('');
        $("#passwordError").text('');
        $("#statusloginmsg").html('');
    });

});
