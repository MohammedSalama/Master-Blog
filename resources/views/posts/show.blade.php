@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
      <div class="col">
        {{-- <div class="jumbotron">
            <h1 class="display-4">Edit Post</h1>
            <a class="btn btn-primary btn-lg" href="{{ route('posts')}}" role="button">All Posts</a>
            <a class="btn btn-primary btn-lg" href="{{ route('post.create')}}" role="button">Create Posts</a>

        </div> --}}
      </div>

    </div>
    <div class="row">

      <div class="col">

            <div class="card">
                <img src="{{ URL::asset($post->photo)}}" class="card-img-top" alt="{{ $post->photo}}">

                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text"> {{ $post->content}}</p>
                @foreach ($tags as $item)
                    <label for="">{{ $item->tag}}</label> <br>
                @endforeach
                    <p> Created at: {{ $post->created_at->diffForhumans() }}</p>
                    <p> Updated at: {{ $post->updated_at->diffForhumans() }}</p>



                    <br>

                    <a class="btn btn-primary btn-lg" href="{{ route('posts')}}" role="button">All Posts</a>
                </div>
            </div>



      </div>
    </div>
  </div>

@endsection
