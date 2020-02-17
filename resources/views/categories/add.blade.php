@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h3>Create Category</h3>
        <div class="col-10 offset-1">
            <form action="{{ route('category.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter the Category Name" class="form-control">
                </div>
                <button type="submit" class="btn btn-info col-4 offset-4">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection