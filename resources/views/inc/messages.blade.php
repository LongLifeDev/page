<!-- check errors array -->
@if(count($errors)>0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
    @endforeach
@endif

<!-- check session success -->
@if (session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif

<!-- check session error -->
@if (session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif