@extends('admin.main.admin_dashboard_layout')

@section('head')
    <title>Admin Dashboard</title>
@stop
@section('body')

    <style>
        div li button {
            margin-top: 5px;
        }
    </style>
    <div class="container">
        <ul class="list-group">
            <br>
            <a href="{{ route('showCreateRestaurantForm') }}">
                <button class="btn btn-primary form-control" type="button">Add a restaurant</button>
            </a>
            <br><br>
            @if(count($rest) == 0)
                <h1>No restaurants in database</h1>
            @else
                @foreach($rest as $r)
                    <li class="list-group-item">
                        <div class="row">
                            <img height="100"
                                 src="{{ $r->image_url }}"
                                 alt="Restaurant Image">
                            {{ $r->name }}
                        </div>
                        <div class="row">
                            <a href="{{ route('showRestaurantUpdateForm', ['id' => $r->id]) }}">
                                <button class="btn btn-primary" type="button">Update Restaurant Info</button>
                            </a>
                            <a href="{{ route('adminShowMenu',['id' => $r->id]) }}">
                                <button class="btn btn-info" type="button">View restaurant menu</button>
                            </a>
                            <!-- TODO: make a js alert box that asks admin if he/she is sure that he/she wants to delete
                                       the restaurant
                            -->
                            <form action="{{ url()->to(parse_url(route('deleteRestaurant',['id' => $r->id]),PHP_URL_PATH),[],env('APP_ENV') !== 'local') }}"
                                  method="post">
                                {{ csrf_field() }}

                                <button class="btn btn-danger" type="submit">Delete restaurant</button>
                            </form>
                            {{--<form action="{{ route('deleteRestaurant', ['id' => $r->id]) }}" method="post"> --}}
                        </div>
                    </li>
                    <br>
                @endforeach
            @endif
        </ul>
    </div>
@stop