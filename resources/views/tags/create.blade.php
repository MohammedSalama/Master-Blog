@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
      <div class="col">
        <div class="jumbotron">
            <h1 class="display-4">Create Tag</h1>
            <a class="btn btn-success btn-lg" href="{{ route('tags')}}" role="button">All Tags</a>
            <a class="btn btn-primary btn-lg" href="{{ route('posts')}}" role="button">All Posts</a>
        </div>
      </div>

    </div>
    <div class="row">
        @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $item)
                <li>
                    {{ $item }}
                </li>
            @endforeach

        </ul>

        @endif
      <div class="col">
        <form method="POST" action="{{ route('tag.store')}}">
            @csrf
            <div class="form-group">
              <label for="exampleFormControlInput1">Name</label>
              <input type="text" name="tag" class="form-control">
            </div>
            

            <div class="form-group">
                <button class="btn btn-success" type="submit">Create</button>
            </div>

          </form>
      </div>
    </div>
  </div>

@endsection
