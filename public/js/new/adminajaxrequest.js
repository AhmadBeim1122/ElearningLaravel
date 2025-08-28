function checkAdminlogin() {
    // Your login logic here
    console.log("Admin login clicked button.");
    var email = $("#email").val();
    var password = $("#password").val();
    console.log(email);
    console.log(password);


      $.ajax({
          url:"api/adminlogin",
          method:"POST",
          data:{
          email : email,
          password :password,
          },
          
          success: function(response) {
            console.log("Server response:", response);
            if (response.status === true) {
                $("#statusAdminloginmsg").html(
                    "<small class='text-success'>Login Successful. Redirecting...</small>"
                );
                setTimeout(function () {
                    window.location.href = "/admin/dashboard";
                }, 2000);
            } else {
                $("#statusAdminloginmsg").html(
                    "<small class='text-danger'>Login Failed: " + response.message + "</small>"
                );
            }
        },
        
         error: function(xhr) {
            let res = xhr.responseJSON;
            if (res && res.errors) {
                $("#statusAdminloginmsg").html(
                    "<small class='text-danger'>" + res.errors[0] + "</small>"
                );
            } else {
                $("#statusAdminloginmsg").html(
                    "<small class='text-danger'>Something went wrong.</small>"
                );
            }
        }

      })
  }



  // Empty all login slide
  function clearAdminloginField(){
      $("#Adminlogform")[0].reset();
    $("#statusAdminloginmsg").html("");

  }

