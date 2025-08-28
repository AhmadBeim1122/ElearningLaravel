// $('#savebtn').click(function(e){

//     e.preventDefault();
//     var storeUrl = $('#categoryStoreUrl').val();
//     var indexUrl = $('#categoryIndexUrl').val();
//     var Category_Name = $('#Category_Name').val();
//     console.log(Category_Name);
//     console.log(storeUrl);
//     console.log(indexUrl);


//     $.ajax({
//     url: storeUrl,   // ✅ Correct way
//     method : 'POST',
//     data : {
//         Category_Name : Category_Name,
//          _token: $('meta[name="csrf-token"]').attr('content')
//     },
//     success: function(response){
//         console.log('hello');
//         if(response.status == 'success'){
//             $("#message").html(`
//                 <div class="d-flex align-items-center">
//                     <div class="spinner-border text-success mr-2" role="status"></div>
//                     <small class="text-success">${response.message}</small>
//                 </div>
//             `);
//             setTimeout(function () {
//                 window.location.href = indexUrl;
//             }, 2000);
//         }
//         else if(response.status === 'error') {
//                 $("#message").html(`<small class='alert alert-danger d-block mb-2'>${response.message}</small>`);
//             }
//     },
//     error: function(){
//          $("#message").html("<small class='alert alert-danger d-block mb-2'>Something went wrong</small>");
//     }
// });


// });



// $('#updatebtn').click(function(e){
//     e.preventDefault();
    
//     let modal = $(this).closest('.modal'); // jo modal open hai usi se value lo
//     let id = modal.find('#ct_id').val();
//     let Category_Name = modal.find('#Category_Name').val();
//     let storeUrl = modal.find('#categoryUpdUrl').val();
//     let indexUrl = modal.find('#categoryIndexUrl').val();


//     console.log(id);
//     console.log(Category_Name);
//     console.log(storeUrl);
//     console.log(indexUrl);


//     $.ajax({
//     url: storeUrl,   // ✅ Correct way
//     method : 'PUT',
//     data : {
//         id:id,
//         Category_Name : Category_Name,
//          _token: $('meta[name="csrf-token"]').attr('content')
//     },
//     success: function(response){
//         if(response.status == 'success'){
//             $("#message").html(`
//                 <div class="d-flex align-items-center">
//                     <div class="spinner-border text-success mr-2" role="status"></div>
//                     <small class="text-success">${response.message}</small>
//                 </div>
//             `);
//             setTimeout(function () {
//                 window.location.href = indexUrl;
//             }, 2000);
//         }
//         else if(response.status === 'error') {
//                 $("#message").html(`<small class='alert alert-danger d-block mb-2'>${response.message}</small>`);
//             }
//     },
//     error: function(xhr){
//         console.log(xhr.responseText);
//     }
// });


// });










// 🟢 Add Category


$('#addCategoryForm').on('submit', function(e){
    e.preventDefault();
    var storeUrl = $('#categoryStoreUrl').val();
    var indexUrl = $('#categoryIndexUrl').val();
    var Category_Name = $(this).find('input[name="Category_Name"]').val();

    $.ajax({
        url: storeUrl,
        method : 'POST',
        data : {
            Category_Name : Category_Name,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        success: function(response){
            console.log("Add Response:", response);
            if(response.status === 'success'){
                $("#message").html(`<small class="text-success">${response.message}</small>`);
                setTimeout(() => { window.location.href = indexUrl; }, 1500);
            } else {
                $("#message").html(`<small class="alert alert-danger d-block mb-2">${response.message}</small>`);
            }
        },
        error: function(xhr){
            console.log("Add Error:", xhr.responseText);
        }
    });
});


// 🟠 Update Category (bind to all forms)
$('form[id^="updateCategoryForm"]').on('submit', function(e){
    e.preventDefault();

    var formId = $(this).attr('id'); // e.g. updateCategoryForm5
    var catId = formId.replace('updateCategoryForm','');
    var updateUrl = $('#categoryUpdUrl'+catId).val();
    var indexUrl  = $('#categoryIndexUrl').val();

    // ✅ Unique ID ke basis par value lo
    var Category_Name = $('#Category_Name'+catId).val();
    console.log("Fetched Name:", Category_Name);

    $.ajax({
        url: updateUrl,
        method : 'PUT',
        data : {
            Category_Name : Category_Name,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        success: function(response){
            console.log("Update Response:", response);
            if(response.status === 'success'){
                $("#message"+catId).html(`<small class="text-success">${response.message}</small>`);
                setTimeout(() => { window.location.href = indexUrl; }, 1500);
            } else {
                $("#message"+catId).html(`<small class="alert alert-danger d-block mb-2">${response.message}</small>`);
            }
        },
        error: function(xhr){
            console.log("Update Error:", xhr.responseText);
        }
    });
});

