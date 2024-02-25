@extends('layouts.app')

@section('content')

<div class="container">
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
    <div class="row">
    @if(count($products) > 0)
        <div class="col-md-4">
        <h3>Search Results for "{{ $search }}"</h3>
        </div>
    </div>
    <div class="table-responsive">
    
        <table border='1px' class="table align-middle mt-3">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Delete</th>
                    <th scope="col">Update</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->title}}</td>
                    <td>{{$product->description}}</td>
                    <td><img height="100px" width="100px" src="{{$product->image}}" alt="product-image"
                            class="rounded float-start"></td>
                    <td><a onclick="return confirm('Are you sure to want to delete this product?')"
                            class="btn btn-danger" role="button"
                            href="{{url('delete-product',$product->id)}}">Delete</a></td>
                    </td>
                    <td><a class="btn btn-info" role="button" href="{{url('edit-product',$product->id)}}">Edit</a></td>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>No products available for the search query.</p>
        @endif
    </div>
</div>
@endsection