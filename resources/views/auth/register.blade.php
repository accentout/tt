@extends('layouts.app')

@section('content')
    <div class="py-5 container text-white">
        @if ($errors->all())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <form method="post" action="{{ route('register.store') }}">
            @csrf
            <input type="text" name="name" id="name" placeholder="Enter name" class="form-control"><br>
            <input type="email" name="email" id="email" placeholder="Enter email" class="form-control"><br>
            <input type="password" name="password" id="password" placeholder="Enter password" class="form-control"><br>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Enter password"
                   class="form-control"><br>
            <button type="submit" class="btn btn-outline-light me-2">Submit</button>
        </form>
    </div>
@endsection
