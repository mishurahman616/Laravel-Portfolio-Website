@extends('layout.app')

@section('title')
Admin | Visistors
    
@endsection

@section('content')
<h3 class="text-center py-3 bg-light m-3 rounded"> Visitors Information</h3> 

<div class="container">
    <div class="row">
    <div class="col-md-12 px-5 pt-0">
    <table id="VisitorDt" class="table table-striped table-sm table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="th-sm">Serial</th>
          <th class="th-sm">IP</th>
          <th class="th-sm">Date & Time</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($visitorsData as $visitor)
            <tr>
            <th class="th-sm">{{$visitor->id}}</th>
            <th class="th-sm">{{$visitor->ip_address}}</th>
            <th class="th-sm">{{$visitor->visiting_time}}</th>
            </tr>
        @endforeach
      </tbody>
    </table>
    
    </div>
    </div>
    </div>
    
@endsection

@section('script')
<script type="text/javascript">
    /* Display visitor table after document ready */
$(document).ready(function () {
    $('#VisitorDt').DataTable({"order":false});
    $('.dataTables_length').addClass('bs-select');
});

</script>
    
@endsection