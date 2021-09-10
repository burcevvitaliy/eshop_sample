@extends('layouts.app')

@section('title', 'Subcategories')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ url('css/box.css') }}">
<div class="row">
    <div class="col-sm-12">
        <div class="row">
            @foreach ($subcategories as $subcategory)
                <div class="col-sm-4 column productbox">
                    <img width="120px"  src="{{ $subcategory->photo }}" class="img-responsive">
                    <div class="producttitle"> <a href='/productlist/{{$subcategory->id}}'># {{ $subcategory->name }}</a><br></div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection