@extends('layout.app')

@section('title')
Admin | Contacts
    
@endsection

@section('content')
<div class="container">
    <div class="row">
    <div class="col-md-12 p-5">
        <h1 class="text-center">Contacts</h1>
    <table id="VisitorDt" class="table table-striped table-sm table-bordered text-center" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="th-sm">Serial</th>
          <th class="th-sm">Name</th>
          <th class="th-sm">Mobile</th>
          <th class="th-sm">Email</th>
          <th class="th-sm">message</th>
          <th class="th-sm">Sent At</th>
          <th class="th-sm">Action</th>
        </tr>
      </thead>
      <tbody>
        <p class="d-none"> {{$i = 0;}}</p>
        @foreach ($contactData as $contact)
            <tr>
            <th class="th-sm">{{++$i}}</th>
            <th class="th-sm">{{$contact->name}}</th>
            <th class="th-sm"><a href="tel:{{$contact->mobile}}">{{$contact->mobile}}</a></th>
            <th class="th-sm"><a href="mailto:{{$contact->email}}">{{$contact->email}}</a></th>
            <th class="th-sm">{{$contact->message}}</th>
            <th class="th-sm">{{$contact->created_at}}</th>
            <th class="th-sm"><a class="deleteContact" data-id="{{$contact->id}}"><i class="fa fa-trash text-danger"></i></a></th>
            </tr>
        @endforeach
      </tbody>
    </table>
    
    </div>
    </div>
    </div>
    

    <div class="modal fade" id="contactDeleteModal" tabindex="-1" role="dialog" aria-labelledby="contactDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="contactDeleteModalLabel">Are you sure to Delete?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
              <button id="contactDeleteConfirmButton" type="button" class="btn btn-danger">Delete</button>
            </div>
          </div>
        </div>
      </div>
@endsection

@section('script')
<script type="text/javascript">
    /* Display contact table after document ready */
    $(document).ready(function () {
        $('#VisitorDt').DataTable({"order":false});
        $('.dataTables_length').addClass('bs-select');
    });

     /* Display Delete Modal when click on delete icon */
    $(document).on('click', '.deleteContact', function(){
        let id= $(this).data('id');
        $('#contactDeleteConfirmButton').attr('data-id', id);
        $('#contactDeleteModal').modal('show');    
    });

    /* Call the api with id to delete contact when click delete button */
    $(document).on('click', '#contactDeleteConfirmButton', function(){
        let id = $(this).attr('data-id');
        deleteContact(id);
    })
    function deleteContact(id){
        if(id.trim().length>0){
            if( parseInt(id)>=0){
                axios.post('/deleteContactById', {id:id}).then(function(response){
                    if(response.status==200){
                        if(response.data==1){
                            $('#contactDeleteModal').modal('hide');    
                            toastr.success("Deleted Successfully!");
                            location.reload(true);
                        }else{
                            toastr.error("Can not Delete. Try Again!");
                        }
                    }else{
                        toastr.error("Can not Delete. Try Again!");
                    }
                }).catch(function(error){
                    toastr.error(error.message);
                })
            }else{
                toastr.error("Can not Delete. id Try Again!");

            }
        }else{
            toastr.error("Can not Delete. Try Again!");
        }
    }

</script>
    
@endsection