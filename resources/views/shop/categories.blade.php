@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ url('css/box.css') }}">
<div class="row">
    <div class="col-sm-12">
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-sm-4 column productbox">
                    <img width="120px"  src="{{ $category->photo }}" class="img-responsive">
                    <div class="producttitle"><a href='/subcategory/{{$category->id}}'># {{ $category->name }}</a></div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection