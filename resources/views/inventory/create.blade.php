@extends('layouts.app')

@section('content')
    <h1>Add Product to Inventory</h1>
    {!! Form::open(['action' => 'InventoryController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
                {{Form::label('catagory', 'Catagory')}}
                {{Form::select('catagory', array('robotics' => 'Robotics', 'games' => 'Games', 'computer' => 'Computer', 'drones' => 'Drones', 'merchandise' => 'Merchandise', 'clothing' => 'Clothing', 'tech' => 'Tech', 'books' => 'Books', 'toys' => 'Toys'), '')}}
        </div>
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('price', 'Price')}}
            {{Form::text('price', '', ['class' => 'form-control', 'placeholder' => 'Price...'])}}   
        </div>
        <div class="form-group">
            {{Form::label('cost', 'Cost')}}
            {{Form::text('cost', '', ['class' => 'form-control', 'placeholder' => 'Cost...'])}}   
            </div>
        <div class="form-group">
            {{Form::label('description', 'Description')}}
            {{Form::textarea('description', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Description Text'])}}
        </div>
        <div class="form-group">
            {{Form::label('product_info', 'Product Info')}}
            {{Form::textarea('product_info', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Product Info Text'])}}
        </div>
        <div class="form-group">
            {{Form::label('code', 'Code')}}
            {{Form::text('code', '', ['class' => 'form-control', 'placeholder' => 'Code'])}}
        </div>
        <div class="form-group">
            {{Form::file('procuct_image_main')}}
        </div>
        <div class="form-group">
            {{Form::file('procuct_image_secondary')}}
        </div>
        
        {{Form::submit('submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection