@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h3>@if($article) Edit @else Create @endif Article</h3>
        <div class="col-10 offset-1">
            <form @if($article) action="{{ route('article.update',['id' => $article->id ]) }}" @else action="{{ route('article.store') }}" @endif method="post" enctype="multipart/form-data">
                @csrf
                @if($article)
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" name="title" id="title" placeholder="Enter the Article Title" @if($article) value="{{$article->title}}" @endif class="form-control">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control">
                        @if($article)
                            @foreach($categories as $category)
                                @if($article->category == $category->id)
                                    <option selected value="{{$category->id}}">{{$category->name}}</option>
                                @else
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endif
                            @endforeach
                        @else
                            <option selected disabled>Select a Category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label for="body">Article Body</label>
                    <textarea name="body" id="body" placeholder="Type the Article Here" class="form-control">
                        @if($article) {{$article->body}} @endif
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="postImage">Article Image</label>
                    <input type="file" name="postImage" id="postImage" class="form-control">
                </div>
                <button type="submit" class="btn btn-info col-4 offset-4">@if($article) Update @else Save @endif</button>
            </form>
        </div>
    </div>
</div>
@endsection