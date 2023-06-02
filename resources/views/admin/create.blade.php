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
            <form method="post" action="{{ route('create.store') }}" enctype="multipart/form-data">
                @csrf
                <select class="dropdown" id="category_id" name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select><br>
                <input type="text" name="name" id="name" placeholder="Enter name" class="form-control"><br>
                <input type="number" name="cost" id="cost" placeholder="Enter cost" class="form-control"><br>
                <input type="text" name="size" id="size" placeholder="Enter size" class="form-control"><br>
                <input type="file" name="cover" id="cover" placeholder="Load cover"  class="form-control"><br>
                <input type="file" name="images[]" id="images" placeholder="Load images" class="form-control" multiple><br>
                <textarea type="text" name="description" id="description" placeholder="Enter description" class="form-control"></textarea><br>
                <button type="submit" class="btn btn-outline-light me-2">Submit</button>
            </form>
        </div>
@endsection
