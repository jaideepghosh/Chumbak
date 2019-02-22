@extends('layouts.app')
@section('title', '- Create Product')

@section('content')
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
            @endif
            <form method="post" action="{{ route('products.store') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Product Name:</label>
                    <input type="text" class="form-control" name="product_name" required/>
                </div>
                <div class="form-group">
                    <label for="quantity">Category:</label>
                    <select name="category" class="form-control">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Price:</label>
                            <input type="number" class="form-control" name="price" min="0" step=".01" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Special Price:</label>
                            <input type="number" class="form-control" name="special_price" min="0" step=".01">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">On Sale:</label>
                            <select class="form-control" name="is_on_sale">
                            <option value="1">Yes</option>
                            <option value="0" selected>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Image Aspect Ration:</label>
                            <input type="number" class="form-control" name="image_aspect_ratio" min="0" step="any">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Add Product</button>
            </form>
        </div>
    </div>
@endsection


@section('footer')

@endsection