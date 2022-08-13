@extends('layout.app')
<!-- Title section -->
@section('title')
Home
@endsection

<!-- Main content section -->
@section('content')
@include('component.homeBanner')
@include('component.homeServices')
@include('component.homeCourses')
@include('component.homeProjects')
@endsection

