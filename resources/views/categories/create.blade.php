@extends('layouts.app')
@section('title', '- Create Category')

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
            <form method="post" action="{{ route('categories.store') }}">
                <div class="form-group">
                    @csrf
                    <label for="name">Category Name:</label>
                    <input type="text" class="form-control" name="category_name"/>
                </div>
                <div class="form-group">
                    <label for="quantity">Parent:</label>
                    <select name="parent_id" class="form-control">
                        <option value="0">Not Applicable</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Add Category</button>
            </form>
        </div>
    </div>
@endsection


@section('footer')

@endsection