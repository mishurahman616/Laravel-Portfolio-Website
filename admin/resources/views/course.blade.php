@extends('layout.app')

@section('title')
Admin | Courses
@endsection

@section('content')
<h3 class="text-center py-3 bg-light m-3 rounded"> All Courses</h3> 

<!-- Display if courses table data loaded successfully-->
<div id="course-table-main d-none" class="contain ">
    <div class="row">
        <div class="col-md-12 px-5 pt-0">
            <button id="addNewCourseButton" class="btn btn-primary mb-3 ml-0">Add New</button>
            <table id="admin-course-table" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">Serial</th>
                        <th class="th-sm">Course Name</th>
                        <th class="th-sm">Course Fee</th>
                        <th class="th-sm">Total Enroll</th>
                        <th class="th-sm">Total Class</th>
                        <th class="th-sm">Details</th>
                        <th class="th-sm">Edit</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                </thead>
                <tbody id="course-table-body">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>



<!-- Display when courses table data loading -->
<div id="course-table-loader" class="container">
    <div class="row">
        <div class="col-md-12 p-5 text-center">
            <img class="loading-icon" src="{{asset('images/loader.svg')}}" alt="">
        </div>
    </div>
</div>

<!-- Display if courses table data not loaded -->
<div id="course-table-fail" class="container d-none">
    <div class="row">
        <div class="col-md-12 p-5 text-center">
            <h3 class="text-danger">Something went wrong</h3>
        </div>
    </div>
</div>


<!-- Modal for Add New Course -->
<div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCourseModalLabel">Add New Course</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="p-5 text-left">
                <div id="courseAddForm" >
                    <!-- 2 column grid layout with text inputs for the name and image -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-outline">
                                <label class="form-label" for="newCourseName">Course Name</label>
                                <input type="text" id="newCourseName" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-outline">
                                <label class="form-label" for="newCourseImage">Course Image</label>
                                <input type="text" id="newCourseImage" class="form-control" />
                              </div>
                        </div>
                    </div><!-- row end-->
                    <!-- 2 column grid layout with text inputs for the fee and enroll -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-outline">
                                <label class="form-label" for="newCourseFee">Course Fee</label>
                                <input type="text" id="newCourseFee" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-outline">
                                <label class="form-label" for="newCourseTotalEnroll">Total Enroll</label>
                                <input type="text" id="newCourseTotalEnroll" class="form-control" />
                            </div>
                        </div>
                    </div><!-- row end-->
                    <!-- 2 column grid layout with text inputs for the class and link -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-outline">
                              <label class="form-label" for="newCourseTotalClass">Total Class</label>
                              <input type="text" id="newCourseTotalClass" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-outline">
                              <label class="form-label" for="newCourseLink">Course Link</label>
                              <input type="text" id="newCourseLink" class="form-control" />
                            </div>
                        </div>
                    </div><!-- row end-->
                    <!-- 2 column grid layout with text inputs for the class and Description -->
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="newCourseDesc">Course Description</label>
                                <input type="text" id="newCourseDesc" class="form-control" />
                            </div>
                        </div>
                    </div><!-- row end-->
                </div><!-- form end-->
                <h5 id='addCourseeFail' class="text-danger d-none">Something went wrong</h5>
            </div>

            <div class="modal-footer">
                <button  class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button id="courseAddConfirmation"  data-id=""  class="btn btn-danger">Save</button>
            </div>
      </div>
    </div>
</div> <!-- New Course Add  Modal End  -->

<!-- Modal for Edit Course -->
<div class="modal fade" id="editCourseModal" tabindex="-1" aria-labelledby="editCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCourseModalLabel">Add New Course</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="p-5 text-left">
                <div id="courseEditForm" >
                    <!-- 2 column grid layout with text inputs for the name and image -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-outline">
                                <label class="form-label" for="editCourseName">Course Name</label>
                                <input type="text" id="editCourseName" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-outline">
                                <label class="form-label" for="editCourseImage">Course Image</label>
                                <input type="text" id="editCourseImage" class="form-control" />
                              </div>
                        </div>
                    </div><!-- row end-->
                    <!-- 2 column grid layout with text inputs for the fee and enroll -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-outline">
                                <label class="form-label" for="editCourseFee">Course Fee</label>
                                <input type="text" id="editCourseFee" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-outline">
                                <label class="form-label" for="editCourseTotalEnroll">Total Enroll</label>
                                <input type="text" id="editCourseTotalEnroll" class="form-control" />
                            </div>
                        </div>
                    </div><!-- row end-->
                    <!-- 2 column grid layout with text inputs for the class and link -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-outline">
                              <label class="form-label" for="editCourseTotalClass">Total Class</label>
                              <input type="text" id="editCourseTotalClass" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-outline">
                              <label class="form-label" for="editCourseLink">Course Link</label>
                              <input type="text" id="editCourseLink" class="form-control" />
                            </div>
                        </div>
                    </div><!-- row end-->
                    <!-- 2 column grid layout with text inputs for the class and Description -->
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="editCourseDesc">Course Description</label>
                                <input type="text" id="editCourseDesc" class="form-control" />
                            </div>
                        </div>
                    </div><!-- row end-->
                </div><!-- form end-->
                <img id='editCourseLoaderIcon' class="loading-icon" src="{{asset('images/loader.svg')}}" alt="Loading">
                <h5 id='editCourseFail' class="text-danger d-none">Something went wrong</h5>
            </div>

            <div class="modal-footer">
                <button  class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button id="courseEditConfirmation"  data-id=""  class="btn btn-danger">Save</button>
            </div>
      </div>
    </div>
</div> <!-- Course Edit  Modal End  -->


<!-- Modal for View single Course -->
<div class="modal fade" id="viewCourseModal" tabindex="-1" aria-labelledby="viCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewCourseModalLabel">Add New Course</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="p-5 text-left">
                <div id="courseViewForm" >
                    <fieldset disabled>
                    <!-- 2 column grid layout with text inputs for the name and image -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-outline">
                                <label class="form-label" for="viewCourseName">Course Name</label>
                                <input type="text" id="viewCourseName" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-outline">
                                <label class="form-label" for="viewCourseImage">Course Image</label>
                                <input type="text" id="viewCourseImage" class="form-control" />
                              </div>
                        </div>
                    </div><!-- row end-->
                    <!-- 2 column grid layout with text inputs for the fee and enroll -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-outline">
                                <label class="form-label" for="viewCourseFee">Course Fee</label>
                                <input type="text" id="viewCourseFee" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-outline">
                                <label class="form-label" for="viewCourseTotalEnroll">Total Enroll</label>
                                <input type="text" id="viewCourseTotalEnroll" class="form-control" />
                            </div>
                        </div>
                    </div><!-- row end-->
                    <!-- 2 column grid layout with text inputs for the class and link -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-outline">
                              <label class="form-label" for="viewCourseTotalClass">Total Class</label>
                              <input type="text" id="viewCourseTotalClass" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-outline">
                              <label class="form-label" for="viewCourseLink">Course Link</label>
                              <input type="text" id="viewCourseLink" class="form-control" />
                            </div>
                        </div>
                    </div><!-- row end-->
                    <!-- 2 column grid layout with text inputs for the class and Description -->
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="viewCourseDesc">Course Description</label>
                                <input type="text" id="viewCourseDesc" class="form-control" />
                            </div>
                        </div>
                    </div><!-- row end-->
                </fieldset>
                </div><!-- form end-->
                <h5 id='viewCourseFail' class="text-danger d-none">Something went wrong</h5>
            </div>

      </div>
    </div>
</div> <!-- Course View  Modal End  -->


<!-- Modal for delete Course -->
<div class="modal fade" id="courseDeleteModal" tabindex="-1" aria-labelledby="courseDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="courseDeleteModalLabel">Are you sure to delete?</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
            </div>
            <h6 class="text-left ml-3 pt-2" id="courseDeleteTitle"></h6>
            <div class="modal-footer">
                <button  class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button id="courseDeleteConfirmation"   data-id=""  class="btn btn-danger">Delete</button>
            </div>
      </div>
    </div>
</div> <!-- Delete Course  Modal End  -->
@endsection 
<!-- Content section end-->

@section('script')
    <script type="text/javascript">
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
                $('#admin-course-table').DataTable().destroy();
                $('#course-table-body').empty();
                $.each(courses, function (i, course) {
                    $('#course-table-body').append($('<tr>').html(
                        "<td>" + (i + 1) + "</td>" +
                        "<td>" + course['course_name'] + "</td>" +
                        "<td>" + course['course_fee'] + "</td>" +
                        "<td>" + course['course_total_enroll'] + "</td>" +
                        "<td>" + course['course_total_class'] + "</td>" +
                        "<td><a class='courseDetailsViewButton' data-id='" + course['id'] + "'><i class='fas fa-eye'></i> </a></td>" +
                        "<td><a class='courseEditButton' data-id='" + course['id'] + "'><i class='fas fa-edit'></i> </a> </td>" +
                        "<td><a class='courseDeleteButton' data-id='" + course['id'] + "' data-title='" + course['course_name'] + "'><i class='fas fa-trash-alt'></i> </a> </td>"
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
            $(document).ready( function () {
                $('#admin-course-table').DataTable({"order":false});
                $('.dataTables_length').addClass('bs-select');
            } );

        })
        .catch(function (error) {
            /* If error occured then hiding the table and showing the error message. */
            $('#course-table-main').addClass('d-none');
            $('#course-table-loader').addClass('d-none');
            $('#course-table-fail').removeClass('d-none');
        });
}

//New Course add
$('#addNewCourseButton').click(function () {
    $('#addCourseModal').modal('show');
});

$('#courseAddConfirmation').click(function () {
    var name = $('#newCourseName').val();
    var desc = $('#newCourseDesc').val();
    var fee = $('#newCourseFee').val();
    var totalEnroll = $('#newCourseTotalEnroll').val();
    var totalClass = $('#newCourseTotalClass').val();
    var link = $('#newCourseLink').val();
    var image = $('#newCourseImage').val();
    addCourse(name, desc, fee, totalEnroll, totalClass, link, image);
});

function addCourse(name, desc, fee, totalEnroll, totalClass, link, image) {
    if (name.trim().length == 0) {
        toastr.error("Title should not be empty");
    } else if (desc.trim().length == 0) {
        toastr.error("Description should not be empty");
    } else if (fee.trim().length == 0) {
        toastr.error("Course Fee should not be empty");
    } else if (totalEnroll.trim().length == 0) {
        toastr.error("Total Enroll should not be empty");
    } else if (totalClass.trim().length == 0) {
        toastr.error("Total Class should not be empty");
    } else if (link.trim().length < 10) {
        toastr.error("Course Link Error");
    } else if (image.trim().length < 10) {
        toastr.error("Course image Error");
    } else {
        //changing the text of Save button to a loading icon
        $('#courseAddConfirmation').html("<div class='spinner-border text-light' role='status'></div>");

        axios.post('/addCourse', { name: name, desc: desc, fee: fee, totalEnroll: totalEnroll, totalClass: totalClass, link: link, image: image }).then(function (response) {
            if (response.status == 200) {
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
            } else {
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
$(document).on('click', '.courseEditButton', function () {
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
            $course = response.data;
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


$(document).on('click', '#courseEditConfirmation', function () {
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

    if (name.trim().length == 0) {
        toastr.error("Title should not be empty");
    } else if (desc.trim().length == 0) {
        toastr.error("Description should not be empty");
    } else if (fee.trim().length < 10) {
        toastr.error("Course Fee should not be empty");
    } else if (totalEnroll.trim().length == 0) {
        toastr.error("Total Enroll should not be empty");
    } else if (totalClass.trim().length == 0) {
        toastr.error("Total Class should not be empty");
    } else if (link.trim().length < 10) {
        toastr.error("Course Link Error");
    } else if (image.trim().length < 10) {
        toastr.error("Course image Error");
    } else {
        //changing the text of Edit button to a loading icon
        $('#courseEditConfirmation').html("<div class='spinner-border text-light' role='status'></div>");

        axios.post('/updateCourse', { id: id, name: name, desc: desc, fee: fee, totalEnroll: totalEnroll, totalClass: totalClass, link: link, image: image }).then(function (response) {
            if (response.status == 200) {
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
            } else {
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
$(document).on('click', '.courseDetailsViewButton', function () {
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
            $course = response.data;
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
        if (response.status == 200) {
            if (response.data == 1) {
                $('#courseDeleteModal').modal('hide');
                toastr.success('Successfully deleted');
                getCourseData();
            } else {
                $('#courseDeleteModal').modal('hide');
                toastr.error('Cannot delete.');
                getCourseData();
            }
        } else {
            $('#courseDeleteModal').modal('hide');
            toastr.error('Something went wrong. ' + response.status);
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

    </script>
@endsection <!-- script section end-->
