@extends('layouts.app')

@section('content')
<div class="col">
    <div class="container">
        <div class="row">
          <div class="col">
            <div class="jumbotron">
                <h1 class="display-4">All Posts</h1>
                <a class="btn btn-primary" href="{{ route('post.create')}}" role="button">Create Post</a>
                <a class="btn btn-success" href="{{ route('tags')}}" role="button">All Tags</a>
                <a class="btn btn-danger " href="{{ route('posts.trashed')}}" role="button">Trash <i class="fas fa-trash"></i></a>
            </div>
          </div>
        </div>
    </div>
</div>

<div class="row">
    @if ($posts->count() > 0)
    <div class="container">
        <div class="col">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Date</th>
                    <th scope="col">User</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Actions</th>

                </tr>
                </thead>
                <tbody>
                    @php
                        $i =1;

                    @endphp
                    @foreach ($posts as $item )
                        <tr>
                            <th scope="row">{{$i++}}</th>
                            <td>{{ $item->title}}</td>
                            <td>{{ $item->created_at->diffForhumans() }}</td>
                            <td>{{ $item->user->name}}</td>
                            <td>
                                <img src="{{ URL::asset($item->photo)}}"
                                alt="{{ $item->photo}}" class="img-thumbnail"
                                width="100" height="100">
                                {{-- width 100 height 100 --}}
                            </td>
                            <td>
                                <a class="text-success" href="{{ route('post.show',['slug'=>$item->slug])}}"><i class="fas fa-2x fa-eye"></i></a>
                                @if ($item->user_id == Auth::id())
                                &nbsp;
                                    <a href="{{ route('post.edit',['id'=>$item->id])}}"><i class="fas fa-2x fa-edit"></i></a> &nbsp;
                                    <a class="text-danger" href="{{ route('post.destroy',['id'=>$item->id])}}"><i class="fas fa-2x fa-trash-alt"></i></a>

                                @endif


                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    @else
    <div class="container">
        <div class="alert alert-danger" role="alert" align="center">
            No Posts , Please Create A Post
        </div>
    </div>


    @endif

    </div>
</div>

@endsection
