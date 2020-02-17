@extends('layouts.app')

@section('content')
<div class="container">
    @if($categories)
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Category</th>
                <th scope="col">Created By</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr class="table-active">
                <th>{{$category->name}}</th>
                <td>{{$category->User->name}}</td>
                <td>
                    @guest
                        <a href="{{ route('category.show',['id' => $category->id]) }}" class="btn btn-warning">View</a>
                    @else
                        <a href="{{ route('category.show',['id' => $category->id]) }}" class="btn btn-warning">View</a>
                        <form action="{{ route('category.destroy',['id' => $category->id]) }}" method="post" class="float-left">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @endguest
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <div>
            <h5>There are no categories to display</h5>
        </div>
    @endif
</div>
@endsection