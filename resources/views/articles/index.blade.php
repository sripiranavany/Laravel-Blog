@extends('layouts.app')
<style>
    .thumb{
        width: 100%;
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h3>Article View</h3>
        <div class="row">
            @foreach($articles as $article)
                <div class="col-4">
                    <img class="thumb" src="{{ asset('images/articles/'.$article->post_image)}}" alt="">
                </div>
                <div class="col-8">
                    <h4>{{$article->title}}</h4>
                    <small><strong><span>Created By : {{ $article->User->name}} &nbsp; Created At : {{ $article->created_at}} </span></strong></small>
                    <p>{{$article->body}}</p>
                    <a class="btn btn-info" href="{{ route('article.show',['id' => $article->id])}}">Read more</a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection