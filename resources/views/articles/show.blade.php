@extends('layouts.app')
<style>
    .img-responsive{
        padding: 0 30% 0 30%;
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card mb-3 text-center">
            <h4 class="card-header">{{ $article->title }}</h4>
            <img class="center-block img-responsive" alt="Card image" src="{{ asset('images/articles/'.$article->post_image)}}">
            <div class="card-body">
                <p class="card-text">{{ $article->body }}</p>
            </div>
            @guest
            <div class="card-footer text-muted">
                <span class="float-left"> Author : {{ $article->User->name }}</span>                    
                <span class="float-right"> Category: {{$article->Category->name}}</span>
            </div>
            </div>
            @else
                <div class="card-footer text-muted">
                    <span class="float-left"> Author : {{ $article->User->name }}</span><span class="float-right">
                        <a href="{{ route('article.edit',['id' => $article->id]) }}" class="btn btn-warning">Edit</a>
                        </span>
                        <span>
                        <form action="{{ route('article.destroy',['id' => $article->id ])}}" method="post" class="float-right">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </span> 
                    <span class="float-none"> Category: {{$article->Category->name}}</span>
                </div>
            </div>  
            <div class="card mt-2 col-12">
                <h5 class="card-header">
                    Comments
                </h5>
                <form action="{{ route('article.comment') }}" method="post">
                    @csrf
                    <input type="hidden" name="article" value="{{ $article->id }}">
                    <div class="form-group">
                        <textarea name="comment" id="comment" placeholder="Type Here..." class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-info">Submit</button>
                </form>
            </div>
            @endguest
        
        @if($comments)
            @foreach($comments as $comment)
                <div class="card col-12 mt-1">
                    <h6 class="card-header">{{$comment->User->name}} <small><strong> At {{$comment->created_at}}</strong></small></h6>
                    <div class="card-body">
                        <p>{{$comment->body}}</p>
                    </div>
                </div>
            @endforeach
        @else
            <h5>No Comments to Display</h5>
        @endif
    </div>
</div>
@endsection