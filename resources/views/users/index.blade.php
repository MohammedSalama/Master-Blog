@extends('layouts.app')

@section('content')
<div class="col">
    <div class="container">
        <div class="row">
          <div class="col">
            <div class="jumbotron">
                <h1 class="display-4">All Users</h1>
                <a class="btn btn-primary" href="{{ route('user.create')}}" role="button">Create User</a>

            </div>
          </div>
        </div>
    </div>
</div>

<div class="row">
    @if ($users->count() > 0)
    <div class="container">
        <div class="col">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>

                </tr>
                </thead>
                <tbody>
                    @php
                        $i =1;
                        
                    @endphp
                    @foreach ($users as $item )
                        <tr>
                            <th scope="row">{{$i++}}</th>
                            <td>{{ $item->name}}</td>
                            <td>{{ $item->email}}</td>

                            
                            <td>
                                <a class="text-danger" href="{{ route('user.destroy',['id'=>$item->id])}}"><i class="fas fa-2x fa-trash-alt"></i></a> 
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
