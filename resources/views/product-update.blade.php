@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">


        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success! </strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif


        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Oops! </strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Error! </strong> Please fix the following issues:
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
        @endif

        <h1>Update Products</h1>
        <form action="{{url('update-product',$product->id)}}" method="POST" enctype="multipart/form-data">
            @csrf <!-- Include the CSRF token field -->
            <div class="col-md-8">
                <div class="mb-3">
                    <label for="title" class="form-label">Product Title</label>
                    <input type="text" class="form-control" name="title" value="{{$product->title}}" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="summernote" name="description" rows="3"
                        required>{{$product->description}}</textarea>
                </div>

                <div class="mb-3">
                    <label for="current-image" class="form-label">Current Image</label>
                    @if ($product->image)
                    <img src="{{ asset($product->image) }}" height="200px" width="200px" alt="current-image">
                    @else
                    <p>No image available</p>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Change Image</label>
                    <input type="file" class="form-control" name="image">
                </div>
                <button type="submit" class="btn btn-primary me-2" id="popup">Submit</button>
            </div>
        </form>

    </div>
</div>
@endsection