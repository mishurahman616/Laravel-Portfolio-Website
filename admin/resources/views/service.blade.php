@extends('layout.app')

@section('title')
Admin | Services
@endsection

@section('content')
<!-- Display if data loaded successfully-->
<div id="service-table-main" class="container d-none">
    <div class="row">
        <div class="col-md-12 p-5">
            <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Are you sure to delete?</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
        </div>
        <h6 class="text-left ml-3 pt-2" id="deleteTitle"></h6>
        <div class="modal-footer">
          <button  class="btn btn-primary" data-dismiss="modal">Cancel</button>
          <button id="serviceDeleteConfirmation"  data-id=""  class="btn btn-danger">Delete</button>
        </div>
      </div>
    </div>
  </div>

@endsection

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
                $('#service-table-body').empty();
                $.each(services, function (i, item) {
                    $('#service-table-body').append($('<tr>').html(
                        /*"+services[i].service_image+"*/
                        "<td>" + i + "</td>" +
                        "<td><img class='table_img' src=" + services[i].service_image + "></td>" +
                        "<td>" + item.service_title + "</td>" +
                        "<td>" + item.service_desc + "</td>" +
                        "<td><a ><i class='fas fa-edit'></i></a></td>" +
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

        })
        .catch(function (error) {
            /* If error occured then hiding the table and showing the error message. */
            $('#service-table-main').addClass('d-none');
            $('#service-table-loader').addClass('d-none');
            $('#service-table-fail').removeClass('d-none');
        });
}

/* A jQuery function that is used to delete a service using modal. When click on
deleteService class, confirmation dialogue is open. */
$(document).on('click', '.deleteService', function () {
    var id = $(this).data('id');
    var title = $(this).data('title');
    $('#deleteTitle').html(title);
    $('#serviceDeleteConfirmation').attr('data-id', id);
    $('#deleteModal').modal('show');
});


/* A jQuery function that is used to delete a service using modal. When click
serviceDeleteConfirmation Id, Request sends to database using axios. */
$(document).on('click', '#serviceDeleteConfirmation', function () {
    var id = $('#serviceDeleteConfirmation').attr('data-id');
    $('#deleteModal').modal('hide');
    
    //calling the api with id
    deleteSevice(id);
});




/**
 * It's a function that takes an id as a parameter, and then it makes an axios post request to the
 * server, and then delete the service with the id.
 * @param id - id
 */
function deleteSevice(id) {
    axios.post('/deleteService', { id: id }).then(function (response) {
        if (response.data == 1) {
            toastr.info('Successfully deleted');
            getServiceData();
        } else {
            toastr.error('Cannot delete.');
            getServiceData();
        }
    }).catch(function (error) {
        console.log(error.message.data);

    });
}


</script>
@endsection