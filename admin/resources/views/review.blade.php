@extends('layout.app')
@section('title')
    Admin | Reviews
@endsection

@section('content')
    <!-- Display if data loaded successfully-->
    <div id="review-table-main" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5">
                <h4 class="text-center">All Reviews</h4>

                <!--Button for add new service -->
                <button id="addNewReviewButton" class="btn btn-primary mb-3 ml-0" >Add New</button>
                <table id="admin-review-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
                    <tbody id="review-table-body">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
     <!-- Display when data loading -->
    <div id="review-table-loader" class="container">
        <div class="row">
            <div class="col-md-12 p-5 text-center">
                <img class="loading-icon" src="{{asset('images/loader.svg')}}" alt="">
            </div>
        </div>
    </div>
    <!-- Display if data not loaded -->
    <div id="review-table-fail" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5 text-center">
                <h3 class="text-danger">Something went wrong</h3>
            </div>
        </div>
    </div>


    <!-- New Review Add Modal -->
<div class="modal fade" id="addReviewModal" tabindex="-1" aria-labelledby="addReviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addReviewModalLabel">Add Review</h5>
          <button type="button" class="btn-close text-danger font-weight-bold" data-dismiss="modal" aria-label="Close">X</button>
        </div>
        <div class="modal-body">
            <div id="reviewAddForm" >
                <!-- 2 column grid layout with text inputs for the Title and image -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-outline">
                            <label class="form-label" for="newReviewName">Review Name</label>
                            <input type="text" id="newReviewName" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-outline">
                          <label class="form-label" for="newReviewImage">Porject Image Link</label>
                          <input type="text" id="newReviewImage" class="form-control" />
                        </div>
                    </div>
                </div><!-- row end-->
                <!-- 2 column grid layout with text inputs for the Review Link and Description -->
                <div class="row mb-4">
                    <div class="col-sm-12">
                        <div class="form-outline">
                            <label class="form-label" for="newReviewDesc">Review Description</label>
                            <input type="text" id="newReviewDesc" class="form-control" />
                        </div>
                    </div>
                </div><!-- row end-->
            </div><!-- form end-->
            <h5 id='addReviewFail' class="text-danger d-none">Something went wrong</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="addReviewConfirmationButton" type="button" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>    <!-- End Review Add Modal -->

   <!-- Review Edit Modal -->
<div class="modal fade" id="editReviewModal" tabindex="-1" aria-labelledby="editReviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editReviewModalLabel">Edit Review</h5>
          <button type="button" class="btn-close text-danger font-weight-bold" data-dismiss="modal" aria-label="Close">X</button>
        </div>
        <div class="modal-body">
            <div id="reviewEditForm" >
                <!-- 2 column grid layout with text inputs for the Title and image -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="form-outline">
                            <label class="form-label" for="editReviewName">Review Name</label>
                            <input type="text" id="editReviewName" class="form-control" />
                        </div>
                    </div>
                </div><!-- row end-->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="form-outline">
                          <label class="form-label" for="editReviewImage">Review Image Link</label>
                          <input type="text" id="editReviewImage" class="form-control" />
                        </div>
                    </div>
                </div><!-- row end-->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="form-outline">
                            <label class="form-label" for="editReviewDesc">Review Description</label>
                            <input type="text" id="editReviewDesc" class="form-control" />
                        </div>
                    </div>
                </div><!-- row end-->
            </div><!-- form end-->
            <img id='editReviewLoaderIcon' class="loading-icon" src="{{asset('images/loader.svg')}}" alt="Loading">
            <h5 id='editReviewFail' class="text-danger d-none">Something went wrong</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="editReviewConfirmationButton" type="button" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>    <!-- End Review Edit Modal -->


  <!--  Review View Modal -->
<div class="modal fade" id="viewReviewModal" tabindex="-1" aria-labelledby="viewReviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewReviewModalLabel">View Review</h5>
          <button type="button" class="btn-close text-danger font-weight-bold" data-dismiss="modal" aria-label="Close">X</button>
        </div>
        <div class="modal-body">
            <div id="reviewViewForm" >
                <!-- 2 column grid layout with text inputs for the Title and image -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="form-outline">
                            <label class="form-label" for="viewReviewName">Review Name</label>
                            <input type="text" id="viewReviewName" class="form-control" disabled />
                        </div>
                    </div>
                </div><!-- row end-->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="form-outline">
                          <label class="form-label" for="viewReviewImage">Review Image Link</label>
                          <input type="text" id="viewReviewImage" class="form-control" disabled />
                        </div>
                    </div>
                </div><!-- row end-->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="form-outline">
                            <label class="form-label" for="viewReviewDesc">Review Description</label>
                            <input type="text" id="viewReviewDesc" class="form-control" disabled />
                        </div>
                    </div>
                </div><!-- row end-->
            </div><!-- form end-->
            <div>            <img id='viewReviewLoaderIcon' class="loading-icon" src="{{asset('images/loader.svg')}}" alt="Loading">
            </div>
            <h5 id='viewReviewFail' class="text-danger d-none">Something went wrong</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>    <!-- End Review View Modal -->

  <!-- Modal for delete Review -->
<div class="modal fade" id="reviewDeleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewDeleteModalLabel">Are you sure to delete?</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
            </div>
            <h6 class="text-left ml-3 pt-2" id="reviewDeleteTitle"></h6>
            <div class="modal-footer">
                <button  class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button id="reviewDeleteConfirmation"  data-id=""  class="btn btn-danger">Delete</button>
            </div>
      </div>
    </div>
</div> <!-- Delete Review  Modal End  -->
@endsection

@section('script')
    <script type="text/javascript">
        // laod review data and dispaly in table to admin panel
        getReviewData();

        /**
         * It gets review data from the database and displays it in a table.
         */
        function getReviewData() {
            axios.get('/getReviewData')
                .then(function (response) {
                    if (response.status == 200) {
                        var reviews = response.data;
                        $('#admin-review-table').DataTable().destroy();
                        $('#review-table-body').empty();
                        $.each(reviews, function (i, item) {
                            $('#review-table-body').append($('<tr>').html(
                                "<td>" + (i+1)+ "</td>" +
                                "<td><img class='table_img' src=" + reviews[i].image + " width='100px' height='100px'></td>" +
                                "<td>" + item.name + "</td>" +
                                "<td>" + item.desc + "</td>" +
                                "<td><a data-id=" + item.id + " class='viewReview'><i class='fas fa-eye'></i></a></td>" +
                                "<td><a data-id=" + item.id + " class='editReview'><i class='fas fa-edit'></i></a></td>" +
                                "<td><a data-id=" + item.id + " data-title='" + item.name + "' class='deleteReview'><i class='fas fa-trash-alt'></i></a></td>"
                            ));
                        });
                        /*If data comes from database, hiding the loader and error message and showing the table. */
                        $('#review-table-main').removeClass('d-none');
                        $('#review-table-loader').addClass('d-none');
                        $('#review-table-fail').addClass('d-none');

                        
                    } else {
                        /* If data not loaded then hiding the table and showing the error message. */
                        $('#review-table-main').addClass('d-none');
                        $('#review-table-loader').addClass('d-none');
                        $('#review-table-fail').removeClass('d-none');
                    }

                    //Jquery datatable for service table
                    $(document).ready( function () {
                        $('#admin-review-table').DataTable({"order":false});
                        $('.dataTables_length').addClass('bs-select');
                    } );
                })
                .catch(function (error) {
                    /* If error occured then hiding the table and showing the error message. */
                    $('#review-table-main').addClass('d-none');
                    $('#review-table-loader').addClass('d-none');
                    $('#review-table-fail').removeClass('d-none');
                });
        }

        $('#addNewReviewButton').click(function () {
            $('#addReviewModal').modal('show');
            $('#addReviewFail').addClass('d-none');

        });
        
        $('#addReviewConfirmationButton').click(function () {
            $('#addReviewFail').addClass('d-none');
            var name=$('#newReviewName').val();
            var image=$('#newReviewImage').val();
            var desc=$('#newReviewDesc').val();
           addReview(name, image, desc);
        });

        function addReview(name, image, desc){
            if(name.trim().length==0){
                toastr.error("Name should not be empty");
            }else if(image.trim().length==0){
                toastr.error("Image should not be empty");
            }else if(desc.trim().length==0){
                toastr.error("Description should not be empty");
            }else{
                //changing the save button text to loading spinner before calling api
                $('#addReviewConfirmationButton').html("<div class='spinner-border text-light' role='status'></div>");

                axios.post('/addReview', {name:name, desc:desc, image:image}).then(function(response){
                    if(response.status==200){
                        if(response.data==1){
                            toastr.success('Review Added Successfully');
                            //After saving the review data clear the form
                            $('#reviewAddForm :input').val('');
                            $('#addReviewModal').modal('hide');
                            getReviewData();

                        }else{
                            toastr.error('Porject save failed');
                            $('#addReviewFail').removeClass('d-none');

                        }

                    }else{
                        toastr.error("Review Save Failed");
                        $('#addReviewFail').removeClass('d-none');
                        setTimeout(() => {
                            $('#addReviewFail').addClass('d-none');
                        }, 5000);
                    }
                   
                    //changing the loading icon of save button to text Save
                    $('#addReviewConfirmationButton').html("Save");

                }).catch(function(error){
                    toastr.error(error.message);
                    //changing the loading icon of save button to text Save
                    $('#addReviewConfirmationButton').html("Save");
                    $('#addReviewFail').removeClass('d-none');
                    setTimeout(() => {
                            $('#addReviewFail').addClass('d-none');
                        }, 5000);

                    })
            }
        }

        
        // View Review By ID
        $(document).on('click', '.viewReview', function(){
            $('#viewReviewModal').modal('show');
            let id = $(this).data('id');
            $('#viewReviewConfimationButton').attr('data-id', id);
            $('#reviewViewForm').addClass('d-none');
            $('#viewReviewLoaderIcon').removeClass('d-none');
            $('#viewReviewFail').addClass('d-none');
            getReviewDataById(id);
        });
        function getReviewDataById(id){
            axios.post('/getReviewDataById', {id:id}).then(function(response){
                if(response.status==200){
                    review=response.data;
                    $('#viewReviewName').val(review['name']);
                    $('#viewReviewDesc').val(review['desc']);
                    $('#viewReviewImage').val(review['image']);

                    $('#reviewViewForm').removeClass('d-none');
                    $('#viewReviewLoaderIcon').addClass('d-none');
                    $('#viewReviewFail').addClass('d-none');
                }else{
                    $('#reviewViewForm').addClass('d-none');
                    $('#viewReviewLoaderIcon').addClass('d-none');
                    $('#viewReviewFail').removeClass('d-none');
                    toastr.error("Something went wrong");
                }
            }).catch(function(error){
                    $('#reviewViewForm').addClass('d-none');
                    $('#viewReviewLoaderIcon').addClass('d-none');
                    $('#viewReviewFail').removeClass('d-none');
                    toastr.error("Something went wrong");

            });
        }

        //Edit Review
        $(document).on('click', '.editReview', function(){
            var id= $(this).data('id');
            $('#editReviewConfirmationButton').attr('data-id', id);
            $('#editReviewModal').modal('show');
           //Show loading Icon when review data loading and remove the edit form
            $('#reviewEditForm').addClass('d-none');
            $('#editReviewLoaderIcon').removeClass('d-none');
            $('#editReviewFail').addClass('d-none');
            reviewDataEdit(id);

        })
        function reviewDataEdit(id){
            axios.post('/getReviewDataById', {id:id}).then(function(response){
                if(response.status==200){
                    $review=response.data;
                    $('#editReviewName').val($review['name']);
                    $('#editReviewDesc').val($review['desc']);
                    $('#editReviewImage').val($review['image']);

                   //Remove the loadig icon and show the form when data loaded
                    $('#reviewEditForm').removeClass('d-none');
                    $('#editReviewLoaderIcon').addClass('d-none');
                    $('#editReviewFail').addClass('d-none');
                }else{
                    $('#reviewEditForm').addClass('d-none');
                    $('#editReviewLoaderIcon').addClass('d-none');
                    $('#editReviewFail').removeClass('d-none');
                    toastr.error("Something went wrong");

                }
            }).catch(function(error){
                $('#reviewEditForm').addClass('d-none');
                $('#editReviewLoaderIcon').addClass('d-none');
                $('#editReviewFail').removeClass('d-none');
                toastr.error(error.message);
            })
        }

        $(document).on('click', '#editReviewConfirmationButton', function(){
            let id=$('#editReviewConfirmationButton').attr('data-id');
            let name=$('#editReviewName').val();
            let image=$('#editReviewImage').val();
            let desc=$('#editReviewDesc').val();

            // Change the button text to loading icon
            $('#editReviewConfirmationButton').html("<div class='spinner-border text-light' role='status'></div>");
            //Call the API to update review
            updateReview(id, name, desc, image);

        });
        function updateReview(id, name, desc, image){
            if(id<0){
                toastr.error('Invalid review');
            }else if(name.trim().length==0){
                toastr.error('Name should not be empty');
            }else if(image.trim().length==0){
                toastr.error('Image can not be empty');
            }else if(desc.trim().length==0){
                toastr.error('Description can not be empty');
            }else{

                    axios.post('/updateReview', {id:id, name:name, desc:desc, image:image}).then(function(response){
                    if(response.status==200){
                        if(response.data==1){
                            $('#editReviewModal').modal('hide');
                            toastr.success("Updated Successfuly");
                            getReviewData();
                        }else{
                            toastr.error('Error happend');
                        }
                        $('#editReviewConfirmationButton').html('Save');
                    }else{
                        toastr.error("Error");
                        $('#editReviewConfirmationButton').html('Save');

                    }
                })
            }
        }
        $(document).on('click', '.deleteReview', function(){
            let id= $(this).attr('data-id');
            let title=$(this).attr('data-title');
            $('#reviewDeleteModal').modal('show');
            $('#reviewDeleteTitle').html(title);
            $('#reviewDeleteConfirmation').attr('data-id', id);
        });
        $(document).on('click', '#reviewDeleteConfirmation', function(){
            //Change the Button text to loading icon while calling the api
            $('#reviewDeleteConfirmation').html("<div class='spinner-border text-light' role='status'></div>");
            let id=$(this).attr('data-id');
            deleteReview(id);
        })

        function deleteReview(idofProejct){
            let id=Number(idofProejct);
            if(typeof id=='number' && id>=0){
                axios.post('/deleteReview', {id:id}).then(function(response){
                if(response.status==200){
                    if(response.data==1){
                        toastr.success('Review Deleted Successfully');
                        $('#reviewDeleteModal').modal('hide');
                        getReviewData();
                    }else{
                        toastr.error('Cannot Delete');
                    }
                }else{
                    toastr.error('Cannot Delete');
                }
                $('#reviewDeleteConfirmation').html('Delete');

            }).catch(function(error){
                toastr.error('Cannot Delete');
                $('#reviewDeleteConfirmation').html('Delete');

            })
            }else{
                toastr.error("Invalid Review");
                $('#reviewDeleteConfirmation').html('Delete');
            }
            
        }
    </script>
@endsection