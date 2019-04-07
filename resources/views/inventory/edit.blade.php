@extends('layouts.app')

@section('content')
    <h1>Edit Product</h1>
    {!! Form::open(['action' => ['InventoryController@update', $product->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', $product->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
            @if($product->is_feature > 0)
                {{Form::label('is_feature', 'Feature')}}{{Form::checkbox('is_feature', '1', true)}}
            @else
                {{Form::label('is_feature', 'Feature')}}{{Form::checkbox('is_feature', '1', false)}}
            @endif 
        </div>
        <div class="form-group">
            {{Form::label('catagory', 'Catagory')}}
            {{Form::select('catagory', array('robotics' => 'Robotics', 'games' => 'Games', 'computer' => 'Computer', 'drones' => 'Drones', 'merchandise' => 'Merchandise', 'clothing' => 'Clothing', 'tech' => 'Tech', 'books' => 'Books', 'toys' => 'Toys'), $product->catagory)}}
        </div>
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', $product->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('price', 'Price')}}
            {{Form::text('price', $product->price, ['class' => 'form-control', 'placeholder' => 'Price...'])}}   
        </div>
        <div class="form-group">
            {{Form::label('cost', 'Cost')}}
            {{Form::text('cost', $product->cost, ['class' => 'form-control', 'placeholder' => 'Cost...'])}}   
            </div>
        <div class="form-group">
            {{Form::label('description', 'Description')}}
            {{Form::textarea('description', $product->description, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Description Text'])}}
        </div>
        <div class="form-group">
            {{Form::label('product_info', 'Product Info')}}
            {{Form::textarea('product_info', $product->product_info, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Product Info Text'])}}
        </div>
        <div class="form-group">
            {{Form::label('code', 'Code')}}
            {{Form::text('code', $product->code, ['class' => 'form-control', 'placeholder' => 'Code'])}}
        </div>
        <div class="form-group">
            {{Form::file('product_image_main')}}
        </div>
        <div class="form-group">
            {{Form::file('product_image_secondary')}}
        </div>
        
        
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('submit', ['class' => 'btn btn-primary pull-right'])}}
    {!! Form::close() !!}
@endsection