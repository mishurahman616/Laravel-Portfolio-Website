@extends('layout.app')

@section('title')
Project
@endsection


@section('content')

<div class="container-fluid jumbotron mt-5 ">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6  text-center">
            <img class=" page-top-img fadeIn" src="images/code.svg">
            <h1 class="page-top-title mt-3">- প্রজেক্টস সমূহ -</h1>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        @foreach($projectData as $project)
            <div class="col-md-3 p-1 text-center">
                <div class=" m-1 card">
                    <div class="text-center">
                        <img class="w-100" src="{{$project->project_image}}" alt="Card image cap">
                        <h5 class="service-card-title mt-4">{{$project->project_title}} </h5>
                        <h6 class="service-card-subTitle px-1 m-0 overflow-hidden">{{$project->project_desc}} </h6>
                        <a href="{{$project->project_link}}" class="normal-btn mt-2 mb-4 btn">বিস্তারিত</a>
                    </div>
                </div>
            </div>
        @endforeach
        

    </div>
</div>
<!--Content Section End-->
@endsection