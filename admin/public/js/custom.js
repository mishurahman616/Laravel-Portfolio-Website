// laod course data and dispaly in table to admin panel
getCourseData();

/**
 * It gets course data from the database and displays it in a table.
 */

 function getCourseData() {
     axios.get('/getCourseData')
         .then(function (response) {
             if (response.status == 200) {
                 var courses = response.data;
                 $('#course-table-body').empty();
                 $.each(courses, function (i, course) {
                     $('#course-table-body').append($('<tr>').html(
                         "<td>"+(i+1)+"</td>"+
                         "<td>"+course['course_name']+"</td>"+
                         "<td>"+course['course_fee']+"</td>"+
                         "<td>"+course['course_total_enroll']+"</td>"+
                         "<td>"+course['course_total_class']+"</td>"+
                         "<td><a class='courseDetailsViewButton' data-id='"+course['id']+"'><i class='fas fa-eye'></i> </a></td>"+
                         "<td><a class='courseEditButton' data-id='"+course['id']+"'><i class='fas fa-edit'></i> </a> </td>"+
                         "<td><a class='courseDeleteButton' data-id='"+course['id']+"' data-title='"+course['course_name']+"'><i class='fas fa-trash-alt'></i> </a> </td>"
                     ));
                 });
                 /*If data comes from database, hiding the loader and error message and showing the table. */
                 $('#course-table-main').removeClass('d-none');
                 $('#course-table-loader').addClass('d-none');
                 $('#course-table-fail').addClass('d-none');

                 
             } else {
                 /* If data not loaded then hiding the table and showing the error message. */
                 $('#course-table-main').addClass('d-none');
                 $('#course-table-loader').addClass('d-none');
                 $('#course-table-fail').removeClass('d-none');
             }

         })
         .catch(function (error) {
             /* If error occured then hiding the table and showing the error message. */
             $('#course-table-main').addClass('d-none');
             $('#course-table-loader').addClass('d-none');
             $('#course-table-fail').removeClass('d-none');
         });
 }

//New Course add
 $('#addNewCourseButton').click(function(){
    $('#addCourseModal').modal('show');
 });

 $('#courseAddConfirmation').click(function(){
    var name = $('#newCourseName').val();
    var desc = $('#newCourseDesc').val();
    var fee = $('#newCourseFee').val();
    var totalEnroll = $('#newCourseTotalEnroll').val();
    var totalClass = $('#newCourseTotalClass').val();
    var link = $('#newCourseLink').val();
    var image = $('#newCourseImage').val();
    addCourse(name, desc, fee, totalEnroll, totalClass, link, image);
 });

 function addCourse( name, desc, fee, totalEnroll, totalClass, link, image) {
    if(name.trim().length==0){
        toastr.error("Title should not be empty");
    }else if(desc.trim().length==0){
        toastr.error("Description should not be empty");
    }else if(fee.trim().length ==0){
        toastr.error("Course Fee should not be empty");
    }else if(totalEnroll.trim().length==0){
        toastr.error("Total Enroll should not be empty");
    }else if(totalClass.trim().length ==0){
        toastr.error("Total Class should not be empty");
    }else if(link.trim().length < 10){
        toastr.error("Course Link Error");
    }else if(image.trim().length < 10){
        toastr.error("Course image Error");
    }else{
         //changing the text of Edit button to a loading icon
        $('#courseAddConfirmation').html("<div class='spinner-border text-light' role='status'></div>");
  
        axios.post('/addCourse', {name: name, desc: desc, fee:fee, totalEnroll:totalEnroll, totalClass:totalClass, link:link, image: image }).then(function (response) {
            if(response.status==200){
                if (response.data == 1) {
                    $('#courseAddForm :input').val('');

                    $('#addCourseModal').modal('hide');

                    /* A toastr message. */
                    toastr.success('Course Added Successfully');
                   
                    /* A function that is used to get all the courses from database and show them in the table. */
                    getCourseData();
                } else {
                    $('#addCourseModal').modal('hide');

                    /* A toastr message. */
                    toastr.error('Course Add Fail.');
                    /* A function that is used to get all the courses from database and show them in the table. */
                    getCourseData();
                }
            }else{
                $('#addCourseModal').modal('hide');

                /* A toastr message. */
                toastr.error('Course Add Fail.');
            }
        }).catch(function (error) {
            $('#addCourseModal').modal('hide');

            toastr.error('Something went wrong.');
    
        });

        //changing the loading icon of Edit button to text Save
        $('#courseAddConfirmation').html("Save");
    }
    
}

//Course Edit
$(document).on('click', '.courseEditButton', function(){
    $('#editCourseModal').modal('show');
    var id = $(this).data('id');
    $('#courseEditConfirmation').attr('data-id', id);

    getCourseDataById(id);
})

/**
 * It gets the course data from the database and shows it in the form.
 * 
 * @param id - The id of the course.
 */
function getCourseDataById(id) {
    /* Hiding the form and showing the loader icon before loading the data. */
        $('#editCourseLoaderIcon').removeClass('d-none');
        $('#courseEditForm').addClass('d-none');
        $('#editCourseFail').addClass('d-none');
        axios.post('getCourseDataById', { id: id }).then(function (response) {
            if (response.status == 200) {
                $course= response.data;
               $('#editCourseName').val($course['course_name']);
               $('#editCourseFee').val($course['course_fee']);
               $('#editCourseTotalEnroll').val($course['course_total_enroll']);
               $('#editCourseTotalClass').val($course['course_total_class']);
               $('#editCourseLink').val($course['course_link']);
               $('#editCourseDesc').val($course['course_desc']);
               $('#editCourseImage').val($course['course_image']);
               
               
            /* Hiding the loader icon and showing the form after loading the data. */
               $('#courseEditForm').removeClass('d-none');
               $('#editCourseLoaderIcon').addClass('d-none');
               $('#editCourseFail').addClass('d-none');
                
            
            } else {
                /* A toastr error message. */
                toastr.error('Something went wrong.');
                
                /* Hiding the loader icon and showing the error message if data not loaded. */
                $('#editCourseFail').removeClass('d-none');
                $('#courseEditForm').addClass('d-none');
                $('#editCourseLoaderIcon').addClass('d-none');
    
            }
        }).catch(function (error) {
            /* A toastr error message. */
            toastr.error(error.message);
    
            /* Hiding the loader icon and showing the error message if data not loaded. */
            $('#editCourseFail').removeClass('d-none');
            $('#courseEditForm').addClass('d-none');
            $('#editCourseLoaderIcon').addClass('d-none');
    
        });
    }


    $(document).on('click', '#courseEditConfirmation', function(){
        var id = $('#courseEditConfirmation').attr('data-id');
        var name = $('#editCourseName').val();
        var fee = $('#editCourseFee').val();
        var totalEnroll = $('#editCourseTotalEnroll').val();
        var totalClass = $('#editCourseTotalClass').val();
        var link = $('#editCourseLink').val();
        var desc = $('#editCourseDesc').val();
        var image = $('#editCourseImage').val();
        updateCourse(id, name, desc, fee, totalEnroll, totalClass, link, image);
    })


    /**
 * It updates the service in the database.
 * @param id - id of the service,
 * @param name - The title of the service.
 * @param desc - The description of the service,
 * @param fee - The fee of the service,
 * @param totalEnroll - The total Enroll of the service,
 * @param totalClass - The total class of the service,
 * @param link - The link of the service,
 * @param image - The image link of the of the service
 */
function updateCourse(id, name, desc, fee, totalEnroll, totalClass, link, image) {

    if(name.trim().length==0){
        toastr.error("Title should not be empty");
    }else if(desc.trim().length==0){
        toastr.error("Description should not be empty");
    }else if(fee.trim().length < 10){
        toastr.error("Course Fee should not be empty");
    }else if(totalEnroll.trim().length==0){
        toastr.error("Total Enroll should not be empty");
    }else if(totalClass.trim().length ==0){
        toastr.error("Total Class should not be empty");
    }else if(link.trim().length< 10){
        toastr.error("Course Link Error");
    }else if(image.trim().length < 10){
        toastr.error("Course image Error");
    }else{
          //changing the text of Edit button to a loading icon
        $('#courseEditConfirmation').html("<div class='spinner-border text-light' role='status'></div>");
  
        axios.post('/updateCourse', {id:id, name: name, desc: desc, fee:fee, totalEnroll:totalEnroll, totalClass:totalClass, link:link, image: image }).then(function (response) {
            if(response.status==200){
                if (response.data == 1) {
                    $('#editCourseModal').modal('hide');

                    /* A toastr message. */
                    toastr.success('Course Edited Successfully');
                   
                    /* A function that is used to get all the courses from database and show them in the table. */
                    getCourseData();
                } else {
                    $('#editCourseModal').modal('hide');
                    console.log(response.data);

                    /* A toastr message. */
                    toastr.error('Course Edit Fail.');
                    /* A function that is used to get all the courses from database and show them in the table. */
                    getCourseData();
                }
            }else{
                $('#editCourseModal').modal('hide');
                /* A toastr message. */
                toastr.error('Course Edit Fail.');
            }
           //changing the loading icon of Edit button to text Save
           $('#courseEditConfirmation').html("Save");
        }).catch(function (error) {
            $('#editCourseModal').modal('hide');

            toastr.error('Something went wrong.');
            console.log(error.message.data);
            //changing the loading icon of Edit button to text Save
            $('#courseEditConfirmation').html("Save");
        });



    
    }
}


//Course View
$(document).on('click', '.courseDetailsViewButton', function(){
    $('#viewCourseModal').modal('show');
    var id = $(this).data('id');
    viewCorseDataToModal(id);
})

/**
 * It gets the course data from the database and shows it in the form.
 * 
 * @param id - The id of the course.
 */
function viewCorseDataToModal(id) {
    /* Hiding the form and showing the loader icon before loading the data. */
        $('#viewCourseLoaderIcon').removeClass('d-none');
        $('#courseViewForm').addClass('d-none');
        $('#viewCourseFail').addClass('d-none');
        axios.post('/getCourseDataById', { id: id }).then(function (response) {
            if (response.status == 200) {
                $course= response.data;
               $('#viewCourseName').val($course['course_name']);
               $('#viewCourseFee').val($course['course_fee']);
               $('#viewCourseTotalEnroll').val($course['course_total_enroll']);
               $('#viewCourseTotalClass').val($course['course_total_class']);
               $('#viewCourseLink').val($course['course_link']);
               $('#viewCourseDesc').val($course['course_desc']);
               $('#viewCourseImage').val($course['course_image']);
               
               
            /* Hiding the loader icon and showing the form after loading the data. */
               $('#courseViewForm').removeClass('d-none');
               $('#viewCourseLoaderIcon').addClass('d-none');
               $('#viewCourseFail').addClass('d-none');
                
            
            } else {
                /* A toastr error message. */
                toastr.error('Something went wrong.');
                
                /* Hiding the loader icon and showing the error message if data not loaded. */
                $('#viewCourseFail').removeClass('d-none');
                $('#courseViewForm').addClass('d-none');
                $('#viewCourseLoaderIcon').addClass('d-none');
    
            }
        }).catch(function (error) {
            /* A toastr error message. */
            toastr.error(error.message);
    
            /* Hiding the loader icon and showing the error message if data not loaded. */
            $('#viewCourseFail').removeClass('d-none');
            $('#courseViewForm').addClass('d-none');
            $('#viewCourseLoaderIcon').addClass('d-none');
    
        });
    }



  /* A jQuery function that is used to delete a course using modal. When click on
deleteCourse class, confirmation dialogue is open. */
$(document).on('click', '.courseDeleteButton', function () {
    var id = $(this).data('id');
    var title = $(this).data('title');
    $('#courseDeleteTitle').html(title);
    $('#courseDeleteConfirmation').attr('data-id', id);
    $('#courseDeleteModal').modal('show');
});


/* A jQuery function that is used to delete a service using modal. When click
serviceDeleteConfirmation Id, Request sends to database using axios. */
$(document).on('click', '#courseDeleteConfirmation', function () {
    var id = $('#courseDeleteConfirmation').attr('data-id');
    
    //calling the api with id
    deletCourse(id);
});




/**
 * It's a function that takes an id as a parameter, and then it makes an axios post request to the
 * server, and then delete the course with the id.
 * @param id - id
 */
function deletCourse(id) {
    //changing the text of delete button to a loading icon
    $('#courseDeleteConfirmation').html("<div class='spinner-border text-light' role='status'></div>");
   
    axios.post('/deleteCourse', { id: id }).then(function (response) {
        if(response.status==200){
            if (response.data == 1) {
            $('#courseDeleteModal').modal('hide');
            toastr.success('Successfully deleted');
            getCourseData();
            } else {
                $('#courseDeleteModal').modal('hide');
                toastr.error('Cannot delete.');
                getCourseData();
            }
        }else{
            $('#courseDeleteModal').modal('hide');
            toastr.error('Something went wrong. '+response.status);
        }
    //changing the loading icon of delete button to text Delete
    $('#courseDeleteConfirmation').html("Delete");
    }).catch(function (error) {
        $('#courseDeleteModal').modal('hide');
        toastr.error(error.message);
    //changing the loading icon of delete button to text Delete
    $('#courseDeleteConfirmation').html("Delete");
    });
    


}