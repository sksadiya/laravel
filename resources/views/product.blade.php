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
        <div class="col-md-4">
            <h1>All Products</h1>
            <form class="d-flex"method="GET" action="{{ route('product.search')  }}" >
                <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
                <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>
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
    </div>
</div>
@endsection