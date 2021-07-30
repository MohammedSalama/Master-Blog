@extends('layouts.app')

@section('content')
<div class="col">
    <div class="container">
        <div class="row">
          <div class="col">
            <div class="jumbotron">
                <h1 class="display-4">Trashed Posts</h1>
                <a class="btn btn-primary" href="{{ route('posts')}}" role="button">All Posts</a>
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
                                <a class="text-success" href="{{ route('post.restore',['id'=> $item->id])}}"><i class="fas fa-2x fa-trash-restore"></i></a> &nbsp;
                                <a class="text-danger" href="{{ route('post.hdelete',['id'=>$item->id])}}"><i class="fas fa-2x fa-trash-alt"></i></a> 
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
            Empty Trash
        </div>
    </div>


    @endif

    </div>
</div>

@endsection
