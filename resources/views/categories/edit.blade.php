@extends('layouts.app')
@section('title', '- Edit Product')

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

        <form method="post" action="{{ route('categories.update', $category->id) }}">
            @method('PATCH')
            @csrf
            <div class="form-group">
                <label for="name">Category Name:</label>
                <input type="text" class="form-control" name="category_name" value="{{ $category->name }}" />
            </div>
            <div class="form-group">
                <label for="price">Parent:</label>
                <select name="parent_id" class="form-control">
                    <option value="0" <?=($category->parent_id==0)?"selected":""?>>Not Applicable</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" <?=($category->parent_id===$cat->parent_id)?"selected":""?>>{{ $cat->name }}</option>
                @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Category</button>
        </form>
        </div>
    </div>
@endsection


@section('footer')

@endsection