@extends('layout.app')

@section('title')
Admin | Services
@endsection

@section('content')

<!-- Display if data loaded successfully-->
<div id="service-table-main" class="container d-none">
    <div class="row">
        <div class="col-md-12 p-5">
            <h4 class="text-center">All Services</h4>

            <!--Button for add new service -->
            <button id="addNewServiceButton" class="btn btn-primary mb-3 ml-0">Add New</button>
            <table id="admin-service-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">Serial</th>
                        <th class="th-sm">Image</th>
                        <th class="th-sm">Name</th>
                        <th class="th-sm">Description</th>
                        <th class="th-sm">Edit</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                </thead>
                <tbody id="service-table-body">
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Display when data loading -->
<div id="service-table-loader" class="container">
    <div class="row">
        <div class="col-md-12 p-5 text-center">
            <img class="loading-icon" src="{{asset('images/loader.svg')}}" alt="">
        </div>
    </div>
</div>

<!-- Display if data not loaded -->
<div id="service-table-fail" class="container d-none">
    <div class="row">
        <div class="col-md-12 p-5 text-center">
            <h3 class="text-danger">Something went wrong</h3>
        </div>
    </div>
</div>

<!-- Modal for delete service -->
<div class="modal fade" id="serviceDeleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceDeleteModalLabel">Are you sure to delete?</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
            </div>
            <h6 class="text-left ml-3 pt-2" id="serviceDeleteTitle"></h6>
            <div class="modal-footer">
                <button  class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button id="serviceDeleteConfirmation"  data-id=""  class="btn btn-danger">Delete</button>
            </div>
      </div>
    </div>
</div> <!-- Delete Service  Modal End  -->

<!-- Modal for Edit service -->
<div class="modal fade" id="serviceEditModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceEditModalLabel">Edit the service</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="p-5 text-center">
                <form id="serviceEidtForm" class="d-none">
                    <input type="hidden" id="editServiceId" class="form-control mb-2">
                    <input type="text" id="editServiceTitle" class="form-control mb-2" placeholder="Service Title">
                    <input type="text" id="editServiceDesc" class="form-control mb-2" placeholder="Service Description">
                    <input type="text" id="editServiceImage" class="form-control mb-2" placeholder="Service Image Link">   
                </form>
                <img id='editServiceLoaderIcon' class="loading-icon" src="{{asset('images/loader.svg')}}" alt="">
                <h5 id='editServiceFail' class="text-danger d-none">Something went wrong</h5>
            </div>

            <div class="modal-footer">
                <button  class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button id="serviceEditConfirmation"  data-id=""  class="btn btn-danger">Save</button>
            </div>
      </div>
    </div>
</div> <!-- Edit Service  Modal End  -->

<!-- Modal for New service -->
<div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add New Service</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="p-5 text-center">
                <div id="serviceAddForm" >
                    <input type="text" id="newServiceTitle" class="form-control mb-2" placeholder="Service Title">
                    <input type="text" id="newServiceDesc" class="form-control mb-2" placeholder="Service Description">
                    <input type="text" id="newServiceImage" class="form-control mb-2" placeholder="Service Image Link">   
                </div>
                <h5 id='addServiceFail' class="text-danger d-none">Something went wrong</h5>
            </div>

            <div class="modal-footer">
                <button  class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button id="serviceAddConfirmation"  data-id=""  class="btn btn-danger">Save</button>
            </div>
      </div>
    </div>
</div> <!-- New Service  Modal End  -->
@endsection <!-- Content section End  -->

@section('script')
<script type="text/javascript">
// laod service data and dispaly in table to admin panel
getServiceData();



/**
 * It gets service data from the database and displays it in a table.
 */
 function getServiceData() {
    axios.get('/getServiceData')
        .then(function (response) {
            if (response.status == 200) {
                var services = response.data;
                $('#admin-service-table').DataTable().destroy();
                $('#service-table-body').empty();
                $.each(services, function (i, item) {
                    $('#service-table-body').append($('<tr>').html(
                        /*"+services[i].service_image+"*/
                        "<td>" + (i+1)+ "</td>" +
                        "<td><img class='table_img' src=" + services[i].service_image + "></td>" +
                        "<td>" + item.service_title + "</td>" +
                        "<td>" + item.service_desc + "</td>" +
                        "<td><a data-id=" + item.id + " data-title='" + item.service_title + "' class='editService'><i class='fas fa-edit'></i></a></td>" +
                        "<td><a data-id=" + item.id + " data-title='" + item.service_title + "' class='deleteService'><i class='fas fa-trash-alt'></i></a></td>"
                    ));
                });
                /*If data comes from database, hiding the loader and error message and showing the table. */
                $('#service-table-main').removeClass('d-none');
                $('#service-table-loader').addClass('d-none');
                $('#service-table-fail').addClass('d-none');

                
            } else {
                /* If data not loaded then hiding the table and showing the error message. */
                $('#service-table-main').addClass('d-none');
                $('#service-table-loader').addClass('d-none');
                $('#service-table-fail').removeClass('d-none');
            }
            $(document).ready( function () {
                $('#admin-service-table').DataTable();
                $('.dataTables_length').addClass('bs-select');
            } );
        })
        .catch(function (error) {
            /* If error occured then hiding the table and showing the error message. */
            $('#service-table-main').addClass('d-none');
            $('#service-table-loader').addClass('d-none');
            $('#service-table-fail').removeClass('d-none');
        });
}


// Service Delete


/* A jQuery function that is used to delete a service using modal. When click on
deleteService class, confirmation dialogue is open. */
$(document).on('click', '.deleteService', function () {
    var id = $(this).data('id');
    var title = $(this).data('title');
    $('#serviceDeleteTitle').html(title);
    $('#serviceDeleteConfirmation').attr('data-id', id);
    $('#serviceDeleteModal').modal('show');
});


/* A jQuery function that is used to delete a service using modal. When click
serviceDeleteConfirmation Id, Request sends to database using axios. */
$(document).on('click', '#serviceDeleteConfirmation', function () {
    var id = $('#serviceDeleteConfirmation').attr('data-id');
    
    //calling the api with id
    deleteSevice(id);
});




/**
 * It's a function that takes an id as a parameter, and then it makes an axios post request to the
 * server, and then delete the service with the id.
 * @param id - id
 */
function deleteSevice(id) {
    //changing the text of delete button to a loading icon
    $('#serviceDeleteConfirmation').html("<div class='spinner-border text-light' role='status'></div>");
   
    axios.post('/deleteService', { id: id }).then(function (response) {
        if(response.status==200){
            if (response.data == 1) {
            $('#serviceDeleteModal').modal('hide');
            toastr.success('Successfully deleted');
            getServiceData();
            } else {
                $('#serviceDeleteModal').modal('hide');
                toastr.error('Cannot delete.');
                getServiceData();
            }
        }else{
            $('#serviceDeleteModal').modal('hide');
            toastr.error('Something went wrong.');
        }
    }).catch(function (error) {
        $('#serviceDeleteModal').modal('hide');
        toastr.error('Something went wrong.');

    });
    
    //changing the loading icon of delete button to text Delete
    $('#serviceDeleteConfirmation').html("Delete");

}

// Service Edit

/* A jQuery function that is used to delete a service using modal. When click on
deleteService class, confirmation dialogue is open. */
$(document).on('click', '.editService', function () {
    var id = $(this).data('id');
    getServiceDataById(id);
    $('#serviceEditConfirmation').attr('data-id', id);
    $('#serviceEditModal').modal('show');
});



/**
 * It gets the service data from the database and displays it in the edit form.
 * @param id - id of the service
 */
function getServiceDataById(id) {
/* Hiding the form and showing the loader icon before loading the data. */
    $('#editServiceLoaderIcon').removeClass('d-none');
    $('#serviceEidtForm').addClass('d-none');
    $('#editServiceFail').addClass('d-none');
    axios.post('getServiceDataById', { id: id }).then(function (response) {
        if (response.status == 200) {
            $service= response.data;
           $('#editServiceTitle').val($service['service_title']);
           $('#editServiceDesc').val($service['service_desc']);
           $('#editServiceImage').val($service['service_image']);
           
           
        /* Hiding the loader icon and showing the form after loading the data. */
           $('#serviceEidtForm').removeClass('d-none');
           $('#editServiceLoaderIcon').addClass('d-none');
           $('#editServiceFail').addClass('d-none');
            
        
        } else {
            /* A toastr error message. */
            toastr.error('Something went wrong.');
            
            /* Hiding the loader icon and showing the error message if data not loaded. */
            $('#editServiceFail').removeClass('d-none');
            $('#serviceEidtForm').addClass('d-none');
            $('#editServiceLoaderIcon').addClass('d-none');

        }
    }).catch(function (error) {
        /* A toastr error message. */
        toastr.error(error.message);

        /* Hiding the loader icon and showing the error message if data not loaded. */
        $('#editServiceFail').removeClass('d-none');
        $('#serviceEidtForm').addClass('d-none');
        $('#editServiceLoaderIcon').addClass('d-none');

    });
}


/* A jQuery function that is used to delete a service using modal. When click
serviceDeleteConfirmation Id, Request sends to database using axios. */
$(document).on('click', '#serviceEditConfirmation', function (event) {
    event.preventDefault();
    var id = $('#serviceEditConfirmation').attr('data-id');
    var title = $('#editServiceTitle').val();
    var desc = $('#editServiceDesc').val();
    var image = $('#editServiceImage').val();
    updateService(id, title, desc, image);

});

/**
 * It updates the service in the database.
 * @param id - id of the service,
 * @param title - The title of the service.
 * @param desc - The description of the service,
 * @param image - The image link of the of the service
 */
function updateService(id, title, desc, image) {

    if(title.trim().length==0){
        toastr.error("Title should not be empty");
    }else if(desc.trim().length==0){
        toastr.error("Description should not be empty");
    }else if(image.trim().length < 10){
        toastr.error("Image Link error");
    }else{
         //changing the text of Edit button to a loading icon
         $('#serviceEditConfirmation').html("<div class='spinner-border text-light' role='status'></div>");

        axios.post('/updateService', { id: id, title: title, desc: desc, image: image }).then(function (response) {
            if(response.status==200){
                $('#serviceEditModal').modal('hide');

                if (response.data == 1) {
                
                    /* A toastr message. */
                    toastr.success('Service Successfully Upadted');
                   
                    /* A function that is used to get all the services from database and show them in the table. */
                    getServiceData();
                } else {
                    
                    /* A toastr message. */
                    toastr.error('Service Update Fail.');
                    /* A function that is used to get all the services from database and show them in the table. */
                    getServiceData();
                }
            }else{
                $('#serviceEditModal').modal('hide');

                /* A toastr message. */
                toastr.error('Service Update Fail.');
            }
        }).catch(function (error) {
            $('#serviceEditModal').modal('hide');

            toastr.error('Something went wrong.');
    
        });

        //changing the loading icon of Edit button to text Save
        $('#serviceEditConfirmation').html("Save");
    
    }
}




//New Service add

$(document).on('click', '#addNewServiceButton', function () {
    $('#addServiceModal').modal('show');
});

$(document).on('click', '#serviceAddConfirmation', function (event) {
    var title = $('#newServiceTitle').val();
    var desc = $('#newServiceDesc').val();
    var image = $('#newServiceImage').val();
    addService(title, desc, image);

});

function addService( title, desc, image) {
    if(title.trim().length==0){
        toastr.error("Title should not be empty");
    }else if(desc.trim().length==0){
        toastr.error("Description should not be empty");
    }else if(image.trim().length < 10){
        toastr.error("Image Link error");
    }else{
         //changing the text of Edit button to a loading icon
        $('#serviceAddConfirmation').html("<div class='spinner-border text-light' role='status'></div>");
  
        axios.post('/addService', {title: title, desc: desc, image: image }).then(function (response) {
            if(response.status==200){
                if (response.data == 1) {
                    $('#serviceAddForm :input').val('');

                    $('#addServiceModal').modal('hide');

                    /* A toastr message. */
                    toastr.success('Service Added Successfully');
                   
                    /* A function that is used to get all the services from database and show them in the table. */
                    getServiceData();
                } else {
                    $('#addServiceModal').modal('hide');

                    /* A toastr message. */
                    toastr.error('Service Add Fail.');
                    /* A function that is used to get all the services from database and show them in the table. */
                    getServiceData();
                }
            }else{
                $('#addServiceModal').modal('hide');

                /* A toastr message. */
                toastr.error('Service Add Fail.');
            }
        }).catch(function (error) {
            $('#addServiceModal').modal('hide');

            toastr.error('Something went wrong.');
    
        });

        //changing the loading icon of Edit button to text Save
        $('#serviceAddConfirmation').html("Save");
    }
    
}

</script>
@endsection