@extends('layouts.app')

@section('content')
<div class="col">
    <div class="container">
        <div class="row">
          <div class="col">
            <div class="jumbotron">
                <h1 class="display-4">All Tags</h1>
                <a class="btn btn-primary" href="{{ route('tag.create')}}" role="button">Create Tag</a>

            </div>
          </div>
        </div>
    </div>
</div>

<div class="row">
    @if ($tags->count() > 0)
    <div class="container">
        <div class="col">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $i =1;
                        
                    @endphp
                    @foreach ($tags as $item )
                        <tr>
                            <th scope="row">{{$i++}}</th>
                            <td>{{ $item->tag}}</td>
                            
                            <td>
                                <a href="{{ route('tag.edit',['id'=>$item->id])}}"><i class="fas fa-2x fa-edit"></i></a> &nbsp;
                                <a class="text-danger" href="{{ route('tag.destroy',['id'=>$item->id])}}"><i class="fas fa-2x fa-trash-alt"></i></a> 
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
            No Tags , Please Create A Tag
        </div>
    </div>


    @endif

    </div>
</div>

@endsection
