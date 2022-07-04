@extends('layout.app')

@section('title')
Admin | Visistors
    
@endsection

@section('content')
<div class="container">
    <div class="row">
    <div class="col-md-12 p-5">
    <table id="VisitorDt" class="table table-striped table-sm table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="th-sm">NO</th>
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
