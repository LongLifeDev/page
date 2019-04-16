@extends('layouts.app') 

@section('content')
<div class="container">
    <div class="jumbotron text-center">
        <h1 style="text-shadow: 1px 1px black;"><span class="glyphicon glyphicon-leaf" style="font-size: .85em; color:green"></span>{{$title}}</h1>
        <p>We're under development! Feel free to look around. Stay tuned for more things to come</p>
    </div>  
    <br/>
    
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12">
                <div class="text-center">
                    <img src="/storage/site_images/LLBGfreeway.jpg" class="rounded mx-auto d-block"  style="max-width: 80%;height: auto;"alt="...">
                    <br/><p style="font-size:1.65rem">This is an image from our old site Longlifedev</p><br/>
                </div>
            </div>
            
            <div class="col-lg-12 col-md-12">
                <div class="text-center">
                    <img src="/storage/site_images/kestrellabsoriginal.jpg" class="rounded mx-auto d-block"  style="max-width: 80%;height: auto;"alt="...">
                    <br/><p style="font-size:1.65rem">One of our first websites made while learning html and javascript</p><br/>
                </div>
            </div>
        </div>
    </div>
@endsection