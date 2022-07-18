@extends('layout.app')

@section('title')
Admin | Courses
@endsection

@section('content')
<!-- Display if courses table data loaded successfully-->
<div id="course-table-main d-none" class="contain ">
    <div class="row">
        <div class="col-md-12 p-5">
            <h4 class="text-center">All Courses</h4>
            <button id="addNewCourseButton" class="btn btn-primary mb-3 ml-0">Add New</button>
            <table class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
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


    </script>
@endsection <!-- script section end-->
