@extends('layouts.app')

@section('title', 'Product')

@section('content')
<div class="col-lg-12">
    <div class="row">
    Name: {{$product->name}}
    </div>
    <div class="row">
    Description: {{$product->description}}
    </div>
    <div class="row">
    Price: ${{$product->price}}
    </div>
    <div class="row">
    <img src="{{$product->photo}}" width="100px">
    </div>
    Attributtes:
    @foreach ($product->product_attributes as $attribute)
        <div class="row">
            {{$attribute['attribute_name']}} : {{$attribute['attribute_value']}}
        </div>
    @endforeach
@endsection