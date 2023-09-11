@extends('layouts.app')

@section('title', 'Add New Project')

@section('content')
    @include('includes.generics.projectForm')
@endsection

@section('scripts')
    @vite('resources/js/imagePreview.js')
@endsection
