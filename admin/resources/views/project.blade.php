@extends('layout.app')
@section('title')
    Admin | Projects
@endsection

@section('content')
    <!-- Display if data loaded successfully-->
    <div id="project-table-main" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5">
                <h4 class="text-center">All Projects</h4>

                <!--Button for add new service -->
                <button id="addNewProjectButton" class="btn btn-primary mb-3 ml-0" >Add New</button>
                <table id="admin-project-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="th-sm">Serial</th>
                            <th class="th-sm">Image</th>
                            <th class="th-sm">Name</th>
                            <th class="th-sm">Description</th>
                            <th class="th-sm">Details</th>
                            <th class="th-sm">Edit</th>
                            <th class="th-sm">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="project-table-body">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
     <!-- Display when data loading -->
    <div id="project-table-loader" class="container">
        <div class="row">
            <div class="col-md-12 p-5 text-center">
                <img class="loading-icon" src="{{asset('images/loader.svg')}}" alt="">
            </div>
        </div>
    </div>
    <!-- Display if data not loaded -->
    <div id="project-table-fail" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5 text-center">
                <h3 class="text-danger">Something went wrong</h3>
            </div>
        </div>
    </div>


    <!-- New Project Add Modal -->
<div class="modal fade" id="addProjectModal" tabindex="-1" aria-labelledby="addProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addProjectModalLabel">Add Project</h5>
          <button type="button" class="btn-close text-danger font-weight-bold" data-dismiss="modal" aria-label="Close">X</button>
        </div>
        <div class="modal-body">
            <div id="projectAddForm" >
                <!-- 2 column grid layout with text inputs for the Title and image -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-outline">
                            <label class="form-label" for="newProjectTitle">Project Name</label>
                            <input type="text" id="newProjectTitle" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-outline">
                          <label class="form-label" for="newProjectImage">Porject Image Link</label>
                          <input type="text" id="newProjectImage" class="form-control" />
                        </div>
                    </div>
                </div><!-- row end-->
                <!-- 2 column grid layout with text inputs for the Project Link and Description -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-outline">
                          <label class="form-label" for="newProjectLink">Project Link</label>
                          <input type="text" id="newProjectLink" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-outline">
                            <label class="form-label" for="newProjectDesc">Project Description</label>
                            <input type="text" id="newProjectDesc" class="form-control" />
                        </div>
                    </div>
                </div><!-- row end-->
            </div><!-- form end-->
            <h5 id='addProjectFail' class="text-danger d-none">Something went wrong</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="addProjectConfirmationButton" type="button" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>    <!-- End Project Add Modal -->

   <!-- Project Edit Modal -->
<div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="editProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProjectModalLabel">Edit Project</h5>
          <button type="button" class="btn-close text-danger font-weight-bold" data-dismiss="modal" aria-label="Close">X</button>
        </div>
        <div class="modal-body">
            <div id="projectEditForm" >
                <!-- 2 column grid layout with text inputs for the Title and image -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="form-outline">
                            <label class="form-label" for="editProjectTitle">Project Name</label>
                            <input type="text" id="editProjectTitle" class="form-control" />
                        </div>
                    </div>
                </div><!-- row end-->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="form-outline">
                          <label class="form-label" for="editProjectImage">Porject Image Link</label>
                          <input type="text" id="editProjectImage" class="form-control" />
                        </div>
                    </div>
                </div><!-- row end-->
                <!-- 2 column grid layout with text inputs for the Project Link and Description -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="form-outline">
                          <label class="form-label" for="editProjectLink">Project Link</label>
                          <input type="text" id="editProjectLink" class="form-control" />
                        </div>
                    </div>
                </div><!-- row end-->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="form-outline">
                            <label class="form-label" for="editProjectDesc">Project Description</label>
                            <input type="text" id="editProjectDesc" class="form-control" />
                        </div>
                    </div>
                </div><!-- row end-->
            </div><!-- form end-->
            <img id='editProjectLoaderIcon' class="loading-icon" src="{{asset('images/loader.svg')}}" alt="Loading">
            <h5 id='editProjectFail' class="text-danger d-none">Something went wrong</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="editProjectConfirmationButton" type="button" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>    <!-- End Project Edit Modal -->


  <!--  Project View Modal -->
<div class="modal fade" id="viewProjectModal" tabindex="-1" aria-labelledby="viewProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewProjectModalLabel">View Project</h5>
          <button type="button" class="btn-close text-danger font-weight-bold" data-dismiss="modal" aria-label="Close">X</button>
        </div>
        <div class="modal-body">
            <div id="projectViewForm" >
                <!-- 2 column grid layout with text inputs for the Title and image -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="form-outline">
                            <label class="form-label" for="viewProjectTitle">Project Name</label>
                            <input type="text" id="viewProjectTitle" class="form-control" disabled />
                        </div>
                    </div>
                </div><!-- row end-->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="form-outline">
                          <label class="form-label" for="viewProjectImage">Porject Image Link</label>
                          <input type="text" id="viewProjectImage" class="form-control" disabled />
                        </div>
                    </div>
                </div><!-- row end-->
                <!-- 2 column grid layout with text inputs for the Project Link and Description -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="form-outline">
                          <label class="form-label" for="viewProjectLink">Project Link</label>
                          <input type="text" id="viewProjectLink" class="form-control" disabled />
                        </div>
                    </div>
                </div><!-- row end-->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="form-outline">
                            <label class="form-label" for="viewProjectDesc">Project Description</label>
                            <input type="text" id="viewProjectDesc" class="form-control" disabled />
                        </div>
                    </div>
                </div><!-- row end-->
            </div><!-- form end-->
            <div>            <img id='viewProjectLoaderIcon' class="loading-icon" src="{{asset('images/loader.svg')}}" alt="Loading">
            </div>
            <h5 id='viewProjectFail' class="text-danger d-none">Something went wrong</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>    <!-- End Project View Modal -->
@endsection

@section('script')
    <script type="text/javascript">
        // laod project data and dispaly in table to admin panel
        getProjectData();

        /**
         * It gets project data from the database and displays it in a table.
         */
        function getProjectData() {
            axios.get('/getProjectData')
                .then(function (response) {
                    if (response.status == 200) {
                        var projects = response.data;
                        $('#admin-project-table').DataTable().destroy();
                        $('#project-table-body').empty();
                        $.each(projects, function (i, item) {
                            $('#project-table-body').append($('<tr>').html(
                                "<td>" + (i+1)+ "</td>" +
                                "<td><img class='table_img' src=" + projects[i].project_image + " width='100px' height='100px'></td>" +
                                "<td>" + item.project_title + "</td>" +
                                "<td>" + item.project_desc + "</td>" +
                                "<td><a data-id=" + item.id + " data-title='" + item.project_title + "' class='viewProject'><i class='fas fa-eye'></i></a></td>" +
                                "<td><a data-id=" + item.id + " data-title='" + item.project_title + "' class='editProject'><i class='fas fa-edit'></i></a></td>" +
                                "<td><a data-id=" + item.id + " data-title='" + item.project_title + "' class='deleteProject'><i class='fas fa-trash-alt'></i></a></td>"
                            ));
                        });
                        /*If data comes from database, hiding the loader and error message and showing the table. */
                        $('#project-table-main').removeClass('d-none');
                        $('#project-table-loader').addClass('d-none');
                        $('#project-table-fail').addClass('d-none');

                        
                    } else {
                        /* If data not loaded then hiding the table and showing the error message. */
                        $('#project-table-main').addClass('d-none');
                        $('#project-table-loader').addClass('d-none');
                        $('#project-table-fail').removeClass('d-none');
                    }

                    //Jquery datatable for service table
                    $(document).ready( function () {
                        $('#admin-project-table').DataTable({"order":false});
                        $('.dataTables_length').addClass('bs-select');
                    } );
                })
                .catch(function (error) {
                    /* If error occured then hiding the table and showing the error message. */
                    $('#project-table-main').addClass('d-none');
                    $('#project-table-loader').addClass('d-none');
                    $('#project-table-fail').removeClass('d-none');
                });
        }

        $('#addNewProjectButton').click(function () {
            $('#addProjectModal').modal('show');
            $('#addProjectFail').addClass('d-none');

        });
        
        $('#addProjectConfirmationButton').click(function () {
            $('#addProjectFail').addClass('d-none');
            var title=$('#newProjectTitle').val();
            var image=$('#newProjectImage').val();
            var link=$('#newProjectLink').val();
            var desc=$('#newProjectDesc').val();
           addProject(title, image, link, desc);
        });

        function addProject(title, image, link, desc){
            if(title.trim().length==0){
                toastr.error("Title should not be empty");
            }else if(image.trim().length==0){
                toastr.error("Image should not be empty");
            }else if(link.trim().length==0){
                toastr.error("Link should not be empty");
            }else if(desc.trim().length==0){
                toastr.error("Description should not be empty");
            }else{
                //changing the save button text to loading spinner before calling api
                $('#addProjectConfirmationButton').html("<div class='spinner-border text-light' role='status'></div>");

                axios.post('/addProject', {title:title, desc:desc, link:link, image:image}).then(function(response){
                    if(response.status==200){
                        if(response.data==1){
                            toastr.success('Project Added Successfully');
                            //After saving the project data clear the form
                            $('#projectAddForm :input').val('');
                            $('#addProjectModal').modal('hide');
                            getProjectData();

                        }else{
                            toastr.error('Porject save failed');
                            $('#addProjectFail').removeClass('d-none');

                        }

                    }else{
                        toastr.error("Project Save Failed");
                        $('#addProjectFail').removeClass('d-none');
                        setTimeout(() => {
                            $('#addProjectFail').addClass('d-none');
                        }, 5000);
                    }
                   
                    //changing the loading icon of save button to text Save
                    $('#addProjectConfirmationButton').html("Save");

                }).catch(function(error){
                    toastr.error(error.message);
                    //changing the loading icon of save button to text Save
                    $('#addProjectConfirmationButton').html("Save");
                    $('#addProjectFail').removeClass('d-none');
                    setTimeout(() => {
                            $('#addProjectFail').addClass('d-none');
                        }, 5000);

                    })
            }
        }

        
        // View Project By ID
        $(document).on('click', '.viewProject', function(){
            $('#viewProjectModal').modal('show');
            let id = $(this).data('id');
            $('#viewProjectConfimationButton').attr('data-id', id);
            $('#projectViewForm').addClass('d-none');
            $('#viewProjectLoaderIcon').removeClass('d-none');
            $('#viewProjectFail').addClass('d-none');
            getProjectDataById(id);
        });
        function getProjectDataById(id){
            axios.post('/getProjectDataById', {id:id}).then(function(response){
                if(response.status==200){
                    project=response.data;
                    $('#viewProjectTitle').val(project['project_title']);
                    $('#viewProjectDesc').val(project['project_desc']);
                    $('#viewProjectLink').val(project['project_link']);
                    $('#viewProjectImage').val(project['project_image']);
                    $('#projectViewForm').removeClass('d-none');
                    $('#viewProjectLoaderIcon').addClass('d-none');
                    $('#viewProjectFail').addClass('d-none');
                }else{
                    $('#projectViewForm').addClass('d-none');
                    $('#viewProjectLoaderIcon').addClass('d-none');
                    $('#viewProjectFail').removeClass('d-none');
                    toastr.error("Something went wrong");
                }
            }).catch(function(error){
                    $('#projectViewForm').addClass('d-none');
                    $('#viewProjectLoaderIcon').addClass('d-none');
                    $('#viewProjectFail').removeClass('d-none');
                    toastr.error("Something went wrong");

            });
        }

        //Edit Project
        $(document).on('click', '.editProject', function(){
            var id= $(this).data('id');
            $('#editProjectConfirmationButton').attr('data-id', id);
            $('#editProjectModal').modal('show');
           //Show loading Icon when project data loading and remove the edit form
            $('#projectEditForm').addClass('d-none');
            $('#editProjectLoaderIcon').removeClass('d-none');
            $('#editProjectFail').addClass('d-none');
            projectDataEdit(id);

        })
        function projectDataEdit(id){
            axios.post('/getProjectDataById', {id:id}).then(function(response){
                if(response.status==200){
                    $project=response.data;
                    $('#editProjectTitle').val($project['project_title']);
                    $('#editProjectDesc').val($project['project_desc']);
                    $('#editProjectImage').val($project['project_image']);
                    $('#editProjectLink').val($project['project_link']);

                   //Remove the loadig icon and show the form when data loaded
                    $('#projectEditForm').removeClass('d-none');
                    $('#editProjectLoaderIcon').addClass('d-none');
                    $('#editProjectFail').addClass('d-none');
                }else{
                    $('#projectEditForm').addClass('d-none');
                    $('#editProjectLoaderIcon').addClass('d-none');
                    $('#editProjectFail').removeClass('d-none');
                    toastr.error("Something went wrong");

                }
            }).catch(function(error){
                $('#projectEditForm').addClass('d-none');
                $('#editProjectLoaderIcon').addClass('d-none');
                $('#editProjectFail').removeClass('d-none');
                toastr.error(error.message);
            })
        }

        $(document).on('click', '#editProjectConfirmationButton', function(){
            let id=$('#editProjectConfirmationButton').attr('data-id');
            let title=$('#editProjectTitle').val();
            let image=$('#editProjectImage').val();
            let link=$('#editProjectLink').val();
            let desc=$('#editProjectDesc').val();

            // Change the button text to loading icon
            $('#editProjectConfirmationButton').html("<div class='spinner-border text-light' role='status'></div>");
            //Call the API to update project
            updateProject(id, title, desc, image, link);
        });
        function updateProject(id, title, desc, image, link){
            if(id<0){
                toastr.error('Invalid project');
            }else if(title.trim().length==0){
                toastr.error('Title should not be empty');
            }else if(image.trim().length==0){
                toastr.error('Image can not be empty');
            }else if(link.trim().length==0){
                toastr.error('Link can not be empty');
            }else{
                    axios.post('/updateProject', {id:id, title:title, desc:desc, image:image, link:link}).then(function(response){
                    if(response.status==200){
                        if(response.data==1){
                            $('#editProjectModal').modal('hide');
                            toastr.success("Updated Successfuly");
                            getProjectData();
                        }else{
                            toastr.error('Error happend');
                        }
                        $('#editProjectConfirmationButton').html('Save');
                    }else{
                        toastr.error("Error");
                        $('#editProjectConfirmationButton').html('Save');

                    }
                })
            }
        }
    </script>
@endsection