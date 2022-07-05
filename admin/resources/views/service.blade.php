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
<script type="text/javascript">getServiceData()</script>
@endsection